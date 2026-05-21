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
$english_student_row = $student_english->fetch_assoc();
$total = $student_english->num_rows;

if ($total > 0) {
    $total = $english_student_row['prelim'] + $english_student_row['midterm'] + $english_student_row['finals'];
    $eng_ave = $total / 3;


} else {
    echo '';
}


$sql="SELECT * FROM `tbl_math` WHERE student_id ='$id'";
$student_math = $con->query($sql) or die ($con->error);
$math_student_row = $student_math->fetch_assoc();
$total = $student_math->num_rows;

if ($total > 0) {
    $total = $math_student_row['prelim'] + $math_student_row['midterm'] + $math_student_row['finals'];
    $math_ave = $total / 3;

} else {
    echo '';
}






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
        <td><?php echo (!empty($english_student_row['prelim']) ? $english_student_row['prelim'] : 'No data');?></td>
        <td><?php echo (!empty($english_student_row['midterm']) ? $english_student_row['midterm'] : 'No data');?></td>
        <td><?php echo (!empty($english_student_row['finals']) ? $english_student_row['finals'] : 'No data');?></td>
        <td><?php echo (empty($eng_ave) ? 'No data' : ($eng_ave >= 75 ? 'PASSED' : 'FAILED'))?></td>
        
    </tr>
</table>

<table>
    <h2>Math</h2>
    <tr>
        <th>Prelim</th>
        <th>Midterm</th>
        <th>Finals</th>
        <th>Remarks</th>
    </tr>

    <tr>
        <td><?php echo (!empty($math_student_row['prelim']) ? $math_student_row['prelim'] : 'No data');?></td>
        <td><?php echo (!empty($math_student_row['midterm']) ? $math_student_row['midterm'] : 'No data');?></td>
        <td><?php echo (!empty($math_student_row['finals']) ? $math_student_row['finals'] : 'No data');?></td>
        <td><?php echo (empty($math_ave) ? 'No data' : ($math_ave >= 75 ? 'PASSED' : 'FAILED'))?></td>

    </tr>
</table>






</body>
</html>