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

$id = $_GET['ID'];

$sql="DELETE FROM `tbl_students` WHERE id = '$id'";
$student = $con->query($sql) or die ($con->error);

header("Location: view.php");
exit();

?>