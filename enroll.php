<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

include("db.php");

$username = $_SESSION['user'];
$course_id = $_GET['id'];

$check = mysqli_query($conn,
"SELECT * FROM student_courses
WHERE username='$username'
AND course_id='$course_id'");

if(mysqli_num_rows($check)==0)
{
    mysqli_query($conn,
    "INSERT INTO student_courses(username,course_id)
    VALUES('$username','$course_id')");
}

header("Location: my_courses.php");
exit();

?>