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

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "DELETE FROM students WHERE id='$id'";

    if(mysqli_query($conn, $sql))
    {
        header("Location: students.php");
        exit();
    }
    else
    {
        echo "Error";
    }
}
else
{
    header("Location: students.php");
    exit();
}

?>