<?php
include('config.php');

session_start();

// Check if user is logged in as admin, if not, redirect to login page
if (!isset($_SESSION["usertype"]) || $_SESSION["usertype"] !== "admin") {
    header("Location: admin_login.php");
    exit;
}

// Fetch all users' quiz results including lesson names
$result = $conn->query("SELECT users.username, lessons.title AS lesson_name, quiz_results.total_questions, quiz_results.correct_answers, quiz_results.score FROM users INNER JOIN quiz_results ON users.id = quiz_results.user_id INNER JOIN lessons ON quiz_results.lesson_id = lessons.lesson_id ORDER BY quiz_results.score DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Results</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include('admin_navbar.php'); ?>

<div class="container mt-5">
    <h2>Users' Quiz Results</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Username</th>
                <th>Lesson</th>
                <th>Total Questions</th>
                <th>Correct Answers</th>
                <th>Score (%)</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr <?php echo $row['score'] == 100 ? 'class="table-success"' : ''; ?>>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['lesson_name']); ?></td>
                    <td><?php echo $row['total_questions']; ?></td>
                    <td><?php echo $row['correct_answers']; ?></td>
                    <td><?php echo round($row['score'], 2); ?>%</td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
