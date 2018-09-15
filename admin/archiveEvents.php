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

$name=$_POST['name'];
$from=$_POST['from'];
$to=$_POST['to'];

$sql="UPDATE events SET archive='$name' WHERE date>='$from' AND date<='$to' and approvalStatus='1'";
$result=mysqli_query($conn, $sql);

if(mysqli_affected_rows($conn)){
    echo "<script type=\"text/javascript\">
            alert('Events have been archived!');
            window.location='archives.php';
          </script>";
}else{
     echo "<script type=\"text/javascript\">
            alert('No valid event was found within the provided timeframe!');
            window.location='archives.php';
          </script>";
}

mysqli_close($conn);
?>