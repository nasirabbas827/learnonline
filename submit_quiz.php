<?php
include('config.php');

session_start();

// Check if user is logged in, if not, redirect to login page
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    header("location: index.php");
    exit;
}

// Check if the lesson_id is set
if (!isset($_POST['lesson_id'])) {
    header("location: homepage.php");
    exit;
}

$user_id = $_SESSION["id"];
$lesson_id = $_POST['lesson_id'];

// Fetch exercises for the lesson
$exercises_result = $conn->query("SELECT * FROM exercises WHERE lesson_id = $lesson_id ORDER BY created_at DESC");

$total_questions = 0;
$correct_answers = 0;

while ($exercise = $exercises_result->fetch_assoc()) {
    $total_questions++;
    $exercise_id = $exercise['exercise_id'];
    $correct_option = $exercise['correct_option'];

    if (isset($_POST["answer_$exercise_id"]) && $_POST["answer_$exercise_id"] == $correct_option) {
        $correct_answers++;
    }
}

$score = ($correct_answers / $total_questions) * 100;

// Insert quiz results into the database
$stmt = $conn->prepare("INSERT INTO quiz_results (user_id, lesson_id, total_questions, correct_answers, score) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iiiii", $user_id, $lesson_id, $total_questions, $correct_answers, $score);
$stmt->execute();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php include('navbar.php'); ?>

<div class="container mt-5">
    <h2>Quiz Result</h2>
    <p>Your score: <?php echo round($score, 2); ?>%</p>
    <p>Total Marks: <?php echo $total_questions; ?></p>
    <p>Marks Gained: <?php echo $correct_answers; ?></p>
    <a href="home.php" class="btn btn-primary">Back to Homepage</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
