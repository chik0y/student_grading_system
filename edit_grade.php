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

if (!isset($_POST['select'])) {
    $subj = ' ';
}

if (isset($_POST['select'])) {
    $_SESSION['Stud_Sub'] = $_POST['subject'];
    $subj =  $_POST['subject'];

   if ($subj == 'English') {
    
    $sql = "SELECT * FROM `tbl_english` WHERE student_id='$id'";
    $table_english = $con->query($sql) or die ($con->error);
    $english_table_row = $table_english->fetch_assoc();


   }
   if ($subj == 'Math') {
    
    $sql = "SELECT * FROM `tbl_math` WHERE student_id='$id'";
    $table_math = $con->query($sql) or die ($con->error);
    $math_table_row = $table_math->fetch_assoc();
    
   }

}

if (isset($_POST['update'])) {
    
    $stud_sub = $_SESSION['Stud_Sub'];
    $prelim = $_POST['prelim'];
    $midterm = $_POST['midterm'];
    $finals = $_POST['finals'];
    
    if ($stud_sub == 'English') {
        
        $sql = "UPDATE `tbl_english` SET `prelim`='$prelim',`midterm`='$midterm',`finals`='$finals' WHERE student_id ='$id'";
        $con->query($sql) or die ($con->error);

        echo "Updated succesfully.";

    } 
    if ($stud_sub == 'Math') {

        $sql = "UPDATE `tbl_math` SET `prelim`='$prelim',`midterm`='$midterm',`finals`='$finals' WHERE student_id ='$id'";
        $con->query($sql) or die ($con->error);

        echo "Updated succesfully.";
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
        <option value="English" <?php echo $subj == 'English' ? 'selected' : '';?>>English</option>   
        <option value="Math" <?php echo $subj == 'Math' ? 'selected' : '';?>>Math</option>
    </select>
    <input type="submit" name="select" value="Select">
</form>

<form action="" method="post">
    <label>Prelim</label>
    <input type="text" name="prelim" id="prelim" value="<?php echo ($subj == 'English') ? $english_table_row['prelim'] : (($subj == 'Math') ? $math_table_row['prelim'] : ''); ?>"><br>
    <label>Midterm</label>
    <input type="text" name="midterm" id="midterm" value="<?php echo ($subj == 'English') ? $english_table_row['midterm'] : (($subj == 'Math') ? $math_table_row['midterm'] : '')?>"><br>
    <label>Finals</label>
    <input type="text" name="finals" id="finals" value="<?php echo ($subj == 'English') ? $english_table_row['finals'] : (($subj == 'Math') ? $math_table_row['finals'] : '')?>"><br>
    <input type="submit" name="update" value="Update">
</form>





</body>
</html>