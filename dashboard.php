<?php 

if (!isset($_SESSION)) {
    session_start();
}

include_once("connection/connection.php");

$con = connection();

    $_SESSION['UserLogin'];
    $_SESSION['Access'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grading System</title>
</head>
<body>


<?php if (isset($_SESSION['UserLogin']) && $_SESSION['Access'] == 'administrator') { ?>
    <a href="logout.php">Logout</a><br>
    <a href="add.php">Add Student</a>
<?php } else { ?>
    <a href="logout.php">Logout</a><br>
<?php } ?>

<a href="view.php">View Student List</a>


</body>
</html>