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

$result = mysqli_query($conn,"SELECT * FROM courses WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $course_name = $_POST['course_name'];
    $price = $_POST['price'];
    $package = $_POST['package'];

    if($_FILES['image']['name'] != "")
    {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp,"images/".$image);
    }
    else
    {
        $image = $row['image'];
    }

    $sql = "UPDATE courses SET
            course_name='$course_name',
            price='$price',
            package='$package',
            image='$image'
            WHERE id='$id'";

    if(mysqli_query($conn,$sql))
    {
        header("Location: courses.php");
        exit();
    }
    else
    {
        echo "Error : ".mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Course</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="students-page">

<h1>Edit Course</h1>

<form method="POST" enctype="multipart/form-data">

<label>Course Name</label><br>
<input type="text" name="course_name"
value="<?php echo $row['course_name']; ?>" required><br><br>

<label>Price</label><br>
<input type="number" name="price"
value="<?php echo $row['price']; ?>" required><br><br>

<label>Package</label><br>
<input type="text" name="package"
value="<?php echo $row['package']; ?>" required><br><br>

<label>Current Image</label><br>

<img src="images/<?php echo $row['image']; ?>"
width="150"
height="100">

<br><br>

<label>Choose New Image</label><br>
<input type="file" name="image" accept="image/*">

<br><br>

<input type="submit" name="update" value="Update Course">

</form>

<br>

<a href="courses.php">Back To Courses</a>

</body>

</html>