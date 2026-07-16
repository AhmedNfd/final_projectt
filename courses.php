<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

include("db.php");

$sql = "SELECT * FROM courses";
$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<title>Courses</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="students-page">

<h1>Courses Management System</h1>

<p>Welcome <?php echo $_SESSION['user']; ?></p>

<a href="students.php">Students</a> |

<a href="courses.php">Courses</a> |

<a href="my_courses.php">My Courses</a> |

<a href="logout.php">Logout</a>

<br><br>

<?php
if($_SESSION['role']=="admin")
{
?>

<a href="add_course.php">Add New Course</a> |

<a href="enroll_course.php">Enroll Student</a>

<br><br>

<?php
}
?>

<table border="1" cellpadding="10">

<tr>

<th>ID</th>

<th>Course Image</th>

<th>Course Name</th>

<th>Price</th>

<th>Package</th>

<?php
if($_SESSION['role']=="user")
{
?>

<th>Enroll</th>

<?php
}
?>

<?php
if($_SESSION['role']=="admin")
{
?>

<th>Action</th>

<?php
}
?>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>

<img
src="images/<?php echo $row['image']; ?>"
width="120"
height="80"
style="border-radius:10px;">

</td>

<td><?php echo $row['course_name']; ?></td>

<td><?php echo $row['price']; ?></td>

<td><?php echo $row['package']; ?></td>

<?php
if($_SESSION['role']=="user")
{
?>

<td>

<a href="enroll.php?id=<?php echo $row['id']; ?>">

Enroll

</a>

</td>

<?php
}
?>

<?php
if($_SESSION['role']=="admin")
{
?>

<td>

<a href="edit_course.php?id=<?php echo $row['id']; ?>">

Edit

</a>

|

<a href="delete_course.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure?');">

Delete

</a>

</td>

<?php
}
?>

</tr>

<?php

}

?>

</table>

</body>

</html>