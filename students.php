<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

include("db.php");

if($_SESSION['role']=="admin")
{
    if(isset($_GET['search']))
    {
        $search = $_GET['search'];

        $sql = "SELECT * FROM students
                WHERE name LIKE '%$search%'";
    }
    else
    {
        $sql = "SELECT * FROM students";
    }
}
else
{
    $user = $_SESSION['user'];

    $sql = "SELECT * FROM students
            WHERE username='$user'";
}

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>Students</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="students-page">

<h1>Student Management System</h1>

<p>

Welcome :
<?php echo $_SESSION['user']; ?>

</p>

<a href="students.php">Students</a> |

<a href="courses.php">Courses</a> |

<a href="logout.php">Logout</a>

<br><br>

<?php
if($_SESSION['role']=="admin")
{
?>

<a href="add_student.php">Add Student</a>

<?php
}
?>

<br><br>

<?php
if($_SESSION['role']=="admin")
{
?>

<form method="GET">

<input
type="text"
name="search"
placeholder="Search Student">

<input
type="submit"
value="Search">

</form>

<br>

<?php
}
?>

<table border="1">

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Age</th>
<th>Department</th>

<?php
if($_SESSION['role']=="admin")
{
?>

<th>Username</th>

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

<td><?php echo $row['name']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['age']; ?></td>

<td><?php echo $row['department']; ?></td>

<?php
if($_SESSION['role']=="admin")
{
?>

<td><?php echo $row['username']; ?></td>

<td>
<a href="edit_students.php?id=<?php echo $row['id']; ?>">Edit</a>

|

<a href="delete_students.php?id=<?php echo $row['id']; ?>"
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