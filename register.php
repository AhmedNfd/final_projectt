<?php

session_start();
include("db.php");

if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if($password == $confirm)
    {
        $check = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $check);

        if(mysqli_num_rows($result) > 0)
        {
            echo "<script>alert('Username already exists');</script>";
        }
        else
        {
            $sql = "INSERT INTO users(username,password)
                    VALUES('$username','$password')";

            if(mysqli_query($conn, $sql))
            {
                header("Location: login.php");
                exit();
            }
            else
            {
                echo "<script>alert('Registration Failed');</script>";
            }
        }
    }
    else
    {
        echo "<script>alert('Passwords do not match');</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Register</title>

    <link rel="stylesheet" href="style.css">

</head>

<body class="login-page">

<h1>Register</h1>

<form method="POST">

<label>Username</label>
<input type="text" name="username" required>

<label>Password</label>
<input type="password" name="password" required>

<label>Confirm Password</label>
<input type="password" name="confirm" required>

<input type="submit" name="register" value="Register">

</form>

<br>

<center>

<a href="login.php">Back to Login</a>

</center>

</body>

</html>