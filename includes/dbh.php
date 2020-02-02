<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "#";

$conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    echo "Connection failed " . $conn->connect_error;
}