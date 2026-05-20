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




// $sql ="UPDATE `tbl_english` SET `student_id`='$id',`prelim`='[value-3]',`midterm`='[value-4]',`finals`='[value-5]' WHERE 1";

if (isset($_POST['submit'])) {

    $subj = $_POST['subject'];

    if ($subj == 'English') {
        
        $prelim = $_POST['prelim'];
        $midterm = $_POST['midterm'];
        $finals = $_POST['finals'];

        $sql ="UPDATE `tbl_english` SET `prelim`='$prelim',`midterm`='$midterm',`finals`='$finals' WHERE student_id = '$id'";
        $student_grade_update = $con->query($sql) or die ($con->error);
        
        header("Location: view.php");
        exit();
    }
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

<form action="" method="post">
    <label>Select Subject</label>
    <select name="subject" id="subject">
        <option value="English">English</option>   
        <option value="Math">Math</option>
    </select><br>
    <label>Prelim</label>
    <input type="text" name="prelim" id="prelim" value="<?php echo $english_row['prelim']?>"><br>
    <label>Midterm</label>
    <input type="text" name="midterm" id="midterm" value="<?php echo $english_row['midterm']?>"><br>
    <label>Finals</label>
    <input type="text" name="finals" id="finals" value="<?php echo $english_row['finals']?>"><br>
    <input type="submit" name="submit" value="Submit">
</form>





</body>
</html>