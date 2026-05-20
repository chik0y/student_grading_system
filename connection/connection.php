<?php

function connection() {

$host = "localhost";
$username = "root";
$password = "123456";
$database = "db_sgsystem";

$con = new mysqli($host, $username, $password, $database);

return $con;

}

?>