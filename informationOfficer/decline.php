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

$eventId = $_POST["eventId"]; 
$sql="DELETE FROM events WHERE eventId='$eventId'";
$result=mysqli_query($conn, $sql);

mysqli_close($conn);
?>