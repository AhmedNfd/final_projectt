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

if(isset($_POST['submit']))
{
    $course_name = $_POST['course_name'];
    $price = $_POST['price'];
    $package = $_POST['package'];

    $sql = "INSERT INTO courses(course_name,price,package)
            VALUES('$course_name','$price','$package')";

    if(mysqli_query($conn,$sql))
    {
        header("Location: courses.php");
        exit();
    }
    else
    {
        echo "Error : ".mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Add Course</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="students-page">

<h1>Add New Course</h1>

<form method="POST">

<label>Course Name</label><br>
<input type="text" name="course_name" required><br><br>

<label>Price</label><br>
<input type="number" name="price" required><br><br>

<label>Package</label><br>
<input type="text" name="package" required><br><br>

<input type="submit" name="submit" value="Add Course">

</form>

<br>

<a href="courses.php">Back To Courses</a>

</body>

</html>