<?php 

if (!isset($_SESSION)) {
    session_start();
}

include_once("connection/connection.php");

$con = connection();

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        echo "Please fill in the blank.";
    }

    $sql = "SELECT * FROM `tbl_users` WHERE username = '$username' AND password = '$password'";
    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    
    if ($total > 0) {

        $_SESSION['UserLogin'] = $row['username']; //admin
        $_SESSION['Access'] = $row['access'];//administrator
        header("Location: dashboard.php");
        exit();
    } else {
        echo "No User found.";
    }
    
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grading System</title>
</head>
<body>
<h2>Login here:</h2>
<form action="" method="post">

<label>Username</label>
<input type="text" name="username" id="username"><br>
<label>Password</label>
<input type="password" name="password" id="password"><br>
<input type="submit" name="login" Value="Login">

</form>

</body>
</html>