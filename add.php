<?php 

if (!isset($_SESSION)) {
    session_start();
}

include_once("connection/connection.php");

$con = connection();

if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gndr = $_POST['gender'];
    $studNum = $_POST['student_number'];

    $sql = "INSERT INTO `tbl_students`(`first_name`, `last_name`, `gender`,  `student_number`) VALUES ('$fname','$lname', '$gndr','$studNum')";
    $studList = $con->query($sql) or die ($con->error);
    
    header("Location: dashboard.php");
    exit();
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
<h2>Add Student</h2>

<form action="" method="post">

<label>Firstname</label>
<input type="text" name="firstname" id="firstname"><br>
<label>Lastname</label>
<input type="text" name="lastname" id="lastname"><br>
<label>Gender</label>
<select name="gender" id="gender">
    <option value="Male">Male</option>
    <option value="Female">Female</option>
</select><br>
<label>Student Number</label>
<input type="text" name="student_number" id="student_number"><br>
<input type="submit" name="submit" Value="Submit">

</form>

</body>
</html>