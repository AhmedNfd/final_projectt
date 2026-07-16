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

$students = mysqli_query($conn,"SELECT username,name FROM students");
$courses = mysqli_query($conn,"SELECT id,course_name FROM courses");

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $course = $_POST['course'];

    $check = mysqli_query($conn,
    "SELECT * FROM student_courses
    WHERE username='$username'
    AND course_id='$course'");

    if(mysqli_num_rows($check)==0)
    {
        mysqli_query($conn,
        "INSERT INTO student_courses(username,course_id)
        VALUES('$username','$course')");

        echo "<script>alert('Student enrolled successfully');</script>";
    }
    else
    {
        echo "<script>alert('Student already enrolled');</script>";
    }
}

?>

<!DOCTYPE html>

<html>

<head>

<title>Enroll Student</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="students-page">

<h1>Enroll Student In Course</h1>

<form method="POST">

<label>Select Student</label>

<select name="username">

<?php

while($student=mysqli_fetch_assoc($students))
{

?>

<option value="<?php echo $student['username']; ?>">

<?php echo $student['name']; ?>

</option>

<?php

}

?>

</select>

<br><br>

<label>Select Course</label>

<select name="course">

<?php

while($course=mysqli_fetch_assoc($courses))
{

?>

<option value="<?php echo $course['id']; ?>">

<?php echo $course['course_name']; ?>

</option>

<?php

}

?>

</select>

<br><br>

<input type="submit" name="submit" value="Enroll">

</form>

<br>

<a href="courses.php">Back To Courses</a>

</body>

</html>