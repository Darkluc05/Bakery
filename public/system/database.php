<?php
$servername = "mariadb";
$username = "root";
$password = "4dy5qwtrsag#!sad";
$database = "bakkerij";

$conn = new mysqli($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}