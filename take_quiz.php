<?php
include('config.php');

session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    header("location: index.php");
    exit;
}

// Check if lesson_id is set in the URL
if (!isset($_GET['lesson_id'])) {
    header("location: homepage.php");
    exit;
}

$lesson_id = $_GET['lesson_id'];

// Fetch lesson details
$stmt = $conn->prepare("SELECT title FROM lessons WHERE lesson_id = ?");
$stmt->bind_param("i", $lesson_id);
$stmt->execute();
$result = $stmt->get_result();
$lesson = $result->fetch_assoc();

if (!$lesson) {
    echo "Lesson not found.";
    exit;
}

// Fetch exercises for the lesson
$exercises_result = $conn->query("SELECT * FROM exercises WHERE lesson_id = $lesson_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($lesson['title']); ?> - Quiz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php include('navbar.php'); ?>

<div class="container mt-5 mb-5">
    <h2>Quiz for: <?php echo htmlspecialchars($lesson['title']); ?></h2>

    <form action="submit_quiz.php" method="POST">
        <input type="hidden" name="lesson_id" value="<?php echo $lesson_id; ?>">
        <?php while ($exercise = $exercises_result->fetch_assoc()): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($exercise['question_text']); ?></h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer_<?php echo $exercise['exercise_id']; ?>" value="1" required>
                        <label class="form-check-label"><?php echo htmlspecialchars($exercise['option_one']); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer_<?php echo $exercise['exercise_id']; ?>" value="2" required>
                        <label class="form-check-label"><?php echo htmlspecialchars($exercise['option_two']); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer_<?php echo $exercise['exercise_id']; ?>" value="3" required>
                        <label class="form-check-label"><?php echo htmlspecialchars($exercise['option_three']); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer_<?php echo $exercise['exercise_id']; ?>" value="4" required>
                        <label class="form-check-label"><?php echo htmlspecialchars($exercise['option_four']); ?></label>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <button type="submit" class="btn btn-primary">Submit Quiz</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
