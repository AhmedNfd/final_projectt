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

$result = mysqli_query($conn,"SELECT * FROM students WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $department = $_POST['department'];
    $username = $_POST['username'];

    $sql = "UPDATE students SET
            name='$name',
            email='$email',
            phone='$phone',
            age='$age',
            department='$department',
            username='$username'
            WHERE id='$id'";

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

    <title>Edit Student</title>

    <link rel="stylesheet" href="style.css">

</head>

<body class="students-page">

<h1>Edit Student</h1>

<form method="POST">

<label>Name</label><br>
<input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>

<label>Email</label><br>
<input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

<label>Phone</label><br>
<input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br><br>

<label>Age</label><br>
<input type="number" name="age" value="<?php echo $row['age']; ?>" required><br><br>

<label>Department</label><br>
<input type="text" name="department" value="<?php echo $row['department']; ?>" required><br><br>

<label>Username</label><br>
<input type="text" name="username" value="<?php echo $row['username']; ?>" required><br><br>

<input type="submit" name="update" value="Update Student">

</form>

<br>

<a href="students.php">Back</a>

</body>

</html>