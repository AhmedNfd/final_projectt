<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

if($_SESSION['role'] != "admin")
{
    die("Access Denied");
}

include("db.php");

$id = $_GET['id'];

$sql = "DELETE FROM courses WHERE id='$id'";

if(mysqli_query($conn,$sql))
{
    header("Location: courses.php");
    exit();
}

?>