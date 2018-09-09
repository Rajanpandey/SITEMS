<?php
include('../session.php');
if(!isset($_SESSION['login_user'])){
    header("location: ../index.php");
}
?>

<?php
$conn=mysqli_connect("localhost", "root", "", "sitems");

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$userId=$_POST['userId'];
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$type=$_POST['type'];

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