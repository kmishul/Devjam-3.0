<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE testdb";

$dbname = "testdb";

mysqli_query($conn, $sql);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql1 = "CREATE TABLE info (
username VARCHAR(30),
psw VARCHAR(30),
email VARCHAR(30),
fname VARCHAR(30),
lname VARCHAR(30),
bday date,
gnames VARCHAR(255)

)";

mysqli_query($conn, $sql1);

$sql2 = "CREATE TABLE mastergrp (
username VARCHAR(30),
gname VARCHAR(30),
member VARCHAR(255)

)";

mysqli_query($conn, $sql2);



?>