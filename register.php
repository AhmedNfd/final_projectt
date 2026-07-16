<?php
session_start();
include('db.php');

if(isset($_POST['register']))
{
    $name       = trim($_POST['name']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);
    $age        = trim($_POST['age']);
    $department = trim($_POST['department']);
    $username   = trim($_POST['username']);
    $password   = trim($_POST['password']);
    $confirm    = trim($_POST['confirm']);

    if($password == $confirm)
    {
        $check = mysqli_query($conn,
            "SELECT * FROM users WHERE username='$username'"
        );

        if(mysqli_num_rows($check) > 0)
        {
            echo "<script>alert('Username already exists');</script>";
        }
        else
        {
            // إنشاء الحساب
            $sql = "INSERT INTO users(username,password,role)
                    VALUES('$username','$password','user')";

            if(mysqli_query($conn, $sql))
            {
                // حفظ بيانات الطالب
                $sql2 = "INSERT INTO students
                        (name,email,phone,age,department,username)
                        VALUES
                        ('$name','$email','$phone','$age','$department','$username')";

                if(mysqli_query($conn, $sql2))
                {
                    echo "<script>alert('Registration Successful');</script>";
                    header('Location: login.php');
                    exit();
                }
                else
                {
                    echo 'Error: ' . mysqli_error($conn);
                }
            }
            else
            {
                echo 'Error: ' . mysqli_error($conn);
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
    <link rel='stylesheet' href='style.css'>
</head>

<body class='login-page'>

<h1>Register</h1>

<form method='POST'>

<label>Name</label>
<input type='text' name='name' required>

<label>Email</label>
<input type='email' name='email' required>

<label>Phone</label>
<input type='text' name='phone' required>

<label>Age</label>
<input type='number' name='age' min='1' required>

<label>Department</label>
<input type='text' name='department' required>

<label>Username</label>
<input type='text' name='username' required>

<label>Password</label>
<input type='password' name='password' required>

<label>Confirm Password</label>
<input type='password' name='confirm' required>

<input type='submit' name='register' value='Register'>

</form>

<br>

<center>
    <a href='login.php'>Back to Login</a>
</center>

</body>
</html>