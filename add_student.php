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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $department = $_POST['department'];
    $username = $_POST['username'];

    $sql = "INSERT INTO students(name,email,phone,age,department,username)
            VALUES('$name','$email','$phone','$age','$department','$username')";

    if(mysqli_query($conn,$sql))
    {
        header("Location: students.php");
        exit();
    }
    else
    {
        echo "Error";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Add Student</title>

    <link rel="stylesheet" href="style.css">

</head>

<body class="students-page">

<h1>Add Student</h1>

<form method="POST">

<label>Name</label><br>
<input type="text" name="name" required><br><br>

<label>Email</label><br>
<input type="email" name="email" required><br><br>

<label>Phone</label><br>
<input type="text" name="phone" required><br><br>

<label>Age</label><br>
<input type="number" name="age" required><br><br>

<label>Department</label><br>
<input type="text" name="department" required><br><br>

<label>Username</label><br>
<input type="text" name="username" required><br><br>

<input type="submit" name="submit" value="Add Student">

</form>

<br>

<a href="students.php">Back</a>

</body>

</html>