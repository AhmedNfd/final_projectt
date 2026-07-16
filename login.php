<?php

session_start();
include("db.php");

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
        $_SESSION['user']=$username;
        header("Location: students.php");
    }
    else
    {
        echo "Wrong Username or Password";
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

<h1>Login</h1>

<form method="POST">

<label>Username</label>

<input type="text" name="username" required>

<br><br>

<label>Password</label>

<input type="password" name="password" required>

<br><br>

<input type="submit" name="login" value="Login">

</form>

</body>

</html>