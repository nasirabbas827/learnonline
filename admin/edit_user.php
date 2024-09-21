<?php
session_start();
include('config.php');

// Check if the user is logged in as an admin
if (!isset($_SESSION["usertype"]) || $_SESSION["usertype"] !== "admin") {
    header("Location: admin_login.php");
    exit;
}

// Define variables and initialize with empty values
$username = $email = $phone = $age = "";
$username_err = $email_err = $phone_err = $age_err = "";

// Get user id
$id = $_GET['id'];

// Fetch user data
$sql = "SELECT username, email, phone, age FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $username, $email, $phone, $age);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and update user data
    // (similar validation as in registration script)
    
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email address.";
    } else {
        $email = trim($_POST["email"]);
    }
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter a phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }
    if (empty(trim($_POST["age"]))) {
        $age_err = "Please enter your age.";
    } elseif (!is_numeric($_POST["age"])) {
        $age_err = "Age must be a number.";
    } else {
        $age = trim($_POST["age"]);
    }

    if (empty($username_err) && empty($email_err) && empty($phone_err) && empty($age_err)) {
        $sql = "UPDATE users SET username=?, email=?, phone=?, age=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssii", $username, $email, $phone, $age, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: view_users.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include('admin_navbar.php'); ?>
    <div class="container mt-5">
        <h2 class="text-center">Edit User</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                <span class="invalid-feedback"><?php echo $phone_err; ?></span>
            </div>
            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" class="form-control <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $age; ?>">
                <span class="invalid-feedback"><?php echo $age_err; ?></span>
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary" value="Update">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
