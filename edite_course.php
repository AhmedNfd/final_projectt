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

$result = mysqli_query($conn,"SELECT * FROM courses WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $course_name = $_POST['course_name'];
    $price = $_POST['price'];
    $package = $_POST['package'];

    $sql = "UPDATE courses SET
            course_name='$course_name',
            price='$price',
            package='$package'
            WHERE id='$id'";

    if(mysqli_query($conn,$sql))
    {
        header("Location: courses.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Course</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="students-page">

<h1>Edit Course</h1>

<form method="POST">

<label>Course Name</label>
<input type="text" name="course_name" value="<?php echo $row['course_name']; ?>" required>

<label>Price</label>
<input type="number" name="price" value="<?php echo $row['price']; ?>" required>

<label>Package</label>
<input type="text" name="package" value="<?php echo $row['package']; ?>" required>

<input type="submit" name="update" value="Update">

</form>

<br>

<center>

<a href="courses.php">Back to Courses</a>

</center>

</body>

</html>