<?php
include('config.php');

session_start();


// Fetch all lessons
$result = $conn->query("SELECT * FROM lessons ORDER BY created_at DESC");
?><!DOCTYPE html>
<html>
<head>
    <title>Learn Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
 <style>
.jumbotron {
            height: 500px;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('./images/hotel.jpg');
            background-size: cover;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .jumbotron h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .jumbotron p {
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<?php
include('navbar.php');
?>

<div class="jumbotron text-center">
    <h1>Welcome to Learn Online</h1>
    <p>Explore and Enhance Your Knowledge with Us</p>
    <a href="login.php" class="btn btn-primary btn-lg">Login to Start Learning</a>
</div>

<div class="container mt-5">
<h1>Our Lessons</h1>

    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                        <a href="view_lesson.php?lesson_id=<?php echo $row['lesson_id']; ?>" class="btn btn-primary">View Lesson File</a>
                        <a href="take_quiz.php?lesson_id=<?php echo $row['lesson_id']; ?>" class="btn btn-secondary">Take Quiz</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<footer class="mt-5 py-3 bg-light">
    <div class="container text-center">
        <p>&copy; 2024 Learn Online. All rights reserved.</p>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
