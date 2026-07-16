<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

include("db.php");

$user = $_SESSION['user'];

$sql = "SELECT courses.*
FROM courses
INNER JOIN student_courses
ON courses.id=student_courses.course_id
WHERE student_courses.username='$user'";

$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<title>My Courses</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="students-page">

<h1>My Courses</h1>

<a href="courses.php">All Courses</a>

<br><br>

<table border="1">

<tr>

<th>Course</th>
<th>Price</th>
<th>Package</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['course_name']; ?></td>

<td><?php echo $row['price']; ?></td>

<td><?php echo $row['package']; ?></td>

</tr>

<?php

}

?>

</table>

</body>

</html>