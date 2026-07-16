<?php

session_start();
include("db.php");

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE username='$username'
            AND password='$password'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['user'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        header("Location: students.php");
        exit();
    }
    else
    {
        echo "<script>alert('Wrong Username or Password');</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

    <link rel="stylesheet" href="style.css">

</head>

<body class="login-page">

<h1>Student Management System</h1>

<form method="POST">

<label>Username</label><br>
<input type="text" name="username" required><br><br>

<label>Password</label><br>
<input type="password" name="password" required><br><br>

<input type="submit" name="login" value="Login">

<br><br>

<center>
<a href="register.php">Create New Account</a>
</center>

</form>

</body>

</html>