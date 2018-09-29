<?php
include('../session.php');
if(!isset($_SESSION['login_user'])){
    header("location: ../index.php");
}
?>

<?php
require('../connect.php');

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$userId=mysqli_real_escape_string($conn,trim($_POST['userId']));
$name=mysqli_real_escape_string($conn,trim($_POST['name']));
$eventId=mysqli_real_escape_string($conn,trim($_POST['email']));
$email=mysqli_real_escape_string($conn,trim($_POST['password']));
$type=mysqli_real_escape_string($conn,trim($_POST['type']));

$sql="UPDATE users SET name='$name', email='$email', password='$password', type='$type' WHERE userId='$userId'";
if(mysqli_query($conn, $sql)){
    echo "<script type=\"text/javascript\">
            alert('The changes are implemented!');
            window.location='allUsers.php';
          </script>";
}else{
    echo "Error".$sql."<br>".$conn->error;
}

mysqli_close($conn);
?>