<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

include("db.php");

?>
<?php
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="students-page">

<body>

<h1>Student Management System</h1>
<p>Welcome <?php echo $_SESSION['user']; ?></p>

<a href="logout.php">Logout</a>

<br><br>

<form method="GET">

<input type="text" name="search" placeholder="Search by Name">

<input type="submit" value="Search">

</form>

<br>

<a href="add_student.php">Add New Student</a>

<br><br>

<table>

<a href="add_student.php">Add New Student</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Age</th>
        <th>Department</th>
        <th>Action</th>
    </tr>

<?php

if(isset($_GET['search']))
{
    $search = $_GET['search'];
    $sql = "SELECT * FROM students WHERE name LIKE '%$search%'";
}
else
{
    $sql = "SELECT * FROM students";
}
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['phone']; ?></td>
<td><?php echo $row['age']; ?></td>
<td><?php echo $row['department']; ?></td>

<td>

<a href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a>

|

<a href="delete_student.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure you want to delete this student?');">
Delete
</a>

</td>

</tr>

<?php
}
?>

</table>

</body>
</html>