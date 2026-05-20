<?php 

if (!isset($_SESSION)) {
    session_start();
}

include_once("connection/connection.php");

$con = connection();

$_SESSION['UserLogin'];
$_SESSION['Access'];

$sql="SELECT * FROM `tbl_students` ORDER BY id DESC";
$students = $con->query($sql) or die ($con->error);
$row = $students->fetch_assoc();


// do {
//     echo $row['first_name'];
// } while ($row = $students->fetch_assoc());

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

<a href="dashboard.php">Dashboard</a>

<h2>Registered Students</h2>
<table>
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Gender</th>
        <th>Student Number</th>
        <th>Grades</th>
        <th>Report Card</th>
        <th>Delete Student</th>
    </tr>
    <?php do { ?>
    <tr>
        <td><?php echo $row['first_name'];?></td>
        <td><?php echo $row['last_name'];?></td>
        <td><?php echo $row['gender'];?></td>
        <td><?php echo $row['student_number'];?></td>
        <td><a href="add_grade.php?ID=<?php echo $row['id'];?>">Add</a>  |  <a href="edit_grade.php?ID=<?php echo $row['id'];?>">Edit</a></td>
        <td><a href="report_card.php?ID=<?php echo $row['id'];?>">View</a></td>
        <td>
            <form action="delete.php?ID=<?php echo $row['id'];?>" method="post"><button name="delete">Delete</button></form>
        </td>
        
    </tr>
    <?php } while ($row = $students->fetch_assoc());?>

</table>



</body>
</html>