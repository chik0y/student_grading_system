<?php 

if (!isset($_SESSION)) {
    session_start();
}

include_once("connection/connection.php");

$con = connection();

if (isset($_SESSION['UserLogin']) && $_SESSION['Access'] != 'administrator') {
    header("Location: view.php");
    exit();
}

$_SESSION['UserLogin'];
$_SESSION['Access'];

$id = $_GET['ID'];

$sql="SELECT * FROM `tbl_students` WHERE id = '$id'";
$student = $con->query($sql) or die ($con->error);
$row = $student->fetch_assoc();



$sql="SELECT * FROM `tbl_english` WHERE student_id = '$id'";
$table_english = $con->query($sql) or die ($con->error);
$english_row = $table_english->fetch_assoc();


$sql="SELECT * FROM `tbl_math` WHERE student_id = '$id'";
$table_math = $con->query($sql) or die ($con->error);
$math_row = $table_math->fetch_assoc();

echo $_SESSION['Subject'];

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

<!-- <form action="" method="post">
    
    
    <label>Prelim</label>
    <input type="text" name="prelim" id="prelim" value="
    <?php
        
        if ($subj =='English') {
            echo $english_row['prelim'];
        }
        elseif ($subj =='Math') {
            echo $math_row['prelim'];
        }
    
    ?>

    "><br>
    <label>Midterm</label>
    <input type="text" name="midterm" id="midterm" value="
    
    <?php
        
        if ($subj =='English') {
            echo $english_row['midterm'];
        }
        elseif ($subj =='Math') {
            echo $math_row['midterm'];
        }
    
    ?>
    
    "><br>
    <label>Finals</label>
    <input type="text" name="finals" id="finals" value="
    
    <?php
        
        if ($subj =='English') {
            echo $english_row['finals'];
        }
        elseif ($subj =='Math') {
            echo $math_row['finals'];
        }
    
    ?>
    
    "><br>
     <input type="submit" name="update" value="Update">


</form> -->





</body>
</html>