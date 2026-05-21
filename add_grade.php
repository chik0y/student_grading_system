<?php 

if (!isset($_SESSION)) {
    session_start();
}

include_once("connection/connection.php");

$con = connection();

$_SESSION['UserLogin'];
$_SESSION['Access'];

if (isset($_SESSION['UserLogin']) && $_SESSION['Access'] != 'administrator') {
    header("Location: view.php");
    exit();
}

$id = $_GET['ID'];

$sql="SELECT * FROM `tbl_students` WHERE id = '$id'";
$student = $con->query($sql) or die ($con->error);
$row = $student->fetch_assoc();


$sql="SELECT * FROM `tbl_english`";
$table_english = $con->query($sql) or die ($con->error);


if (isset($_POST['submit'])) {

    $subj = $_POST['subject'];

    if ($subj == 'English') {
        
        $prelim = $_POST['prelim'];
        $midterm = $_POST['midterm'];
        $finals = $_POST['finals'];


        $sql="SELECT * FROM `tbl_english` WHERE student_id = '$id'";
        $student = $con->query($sql) or die ($con->error);
        $rowStud = $student->fetch_assoc();
        $total = $student->num_rows;

        if ($total > 0) {
            echo "Cannot add new grade.";
        } else {
            $sql="INSERT INTO `tbl_english`(`student_id`, `prelim`, `midterm`, `finals`) VALUES ('$id','$prelim','$midterm','$finals')";
            $student_english_grade = $con->query($sql) or die ($con->error);
            echo "New inserted.";
        }
        
    } elseif ($subj == 'Math') {
        
        $prelim = $_POST['prelim'];
        $midterm = $_POST['midterm'];
        $finals = $_POST['finals'];

        $sql="SELECT * FROM `tbl_math` WHERE student_id = '$id'";
        $student = $con->query($sql) or die ($con->error);
        $rowStud = $student->fetch_assoc();
        $total = $student->num_rows;

        if ($total > 0) {
            echo "Cannot add new grade.";
        } else {
            $sql="INSERT INTO `tbl_math`(`student_id`, `prelim`, `midterm`, `finals`) VALUES ('$id','$prelim','$midterm','$finals')";
            $student_math_grade = $con->query($sql) or die ($con->error);
            echo "New inserted.";
        }

    } else {
        echo "";
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
    <input type="text" name="prelim" id="prelim"><br>
    <label>Midterm</label>
    <input type="text" name="midterm" id="midterm"><br>
    <label>Finals</label>
    <input type="text" name="finals" id="finals"><br>
    <input type="submit" name="submit" value="Submit">
</form>





</body>
</html>