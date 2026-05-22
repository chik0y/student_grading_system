<?php 

if (!isset($_SESSION)) {
    session_start();
}

include_once("connection/connection.php");

$con = connection();

if (isset($_POST['login'])) {

    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $email = $_POST['email'];
    $errors = [];

    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    } else {
        if (strlen($password) < 6) {
            $errors[] = "Password must be 6 characters.";
        }
    }
    if ($password !== $confirm_password) {
        $errors[] = "Password do not match.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email.";
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error.'</br>';
        }
    }

    if (empty($errors)) {
        
        // $sql = "SELECT * FROM `tbl_users` WHERE username = '$username' AND password = '$password'";
        // $user = $con->query($sql) or die ($con->error);
        // $row = $user->fetch_assoc();
        // $total = $user->num_rows;

        
        // if ($total > 0) {

        //     $_SESSION['UserLogin'] = $row['username']; //admin
        //     $_SESSION['Access'] = $row['access'];//administrator
        //     header("Location: dashboard.php");
        //     exit();
        // } 

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
<label>Confirm Password</label>
<input type="password" name="confirm_password" id="confirm_password"><br>
<label>Email</label>
<input type="text" name="email" id="email"><br>
<input type="submit" name="login" Value="Login">

</form>

</body>
</html>