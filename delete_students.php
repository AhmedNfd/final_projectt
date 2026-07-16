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

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id='$id'";

if(mysqli_query($conn,$sql))
{
    header("Location: students.php");
}
else
{
    echo "Error";
}

?>