<?php 

if (!isset($_SESSION)) {
    session_start();
}

include_once("connection/connection.php");

$con = connection();

$_SESSION['UserLogin'];
$_SESSION['Access'];

$id = $_GET['ID'];

$sql="SELECT * FROM `tbl_students` WHERE id = '$id'";
$student = $con->query($sql) or die ($con->error);
$row = $student->fetch_assoc();





$sql="SELECT * FROM `tbl_english` WHERE student_id ='$id'";
$student_english = $con->query($sql) or die ($con->error);
$student_row = $student_english->fetch_assoc();


$total = $student_row['prelim'] + $student_row['midterm'] + $student_row['finals'];
$ave = $total / 3;




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grading System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="view.php">Student Lists</a>

<h2><?php echo $row['first_name']. " " . $row['last_name'];; ?></h2>

<table>
    <h2>English</h2>
    <tr>
        <th>Prelim</th>
        <th>Midterm</th>
        <th>Finals</th>
        <th>Remarks</th>
    </tr>

    <tr>
        <td><?php echo $student_row['prelim'];?></td>
        <td><?php echo $student_row['midterm'];?></td>
        <td><?php echo $student_row['finals'];?></td>
        <td><?php echo ($ave > 75) ? 'PASSED' : 'FAILED';?></td>
    </tr>
</table>





</body>
</html>