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

$archive=$_GET['archive'];

$sql="UPDATE events SET archive=NULL WHERE archive='$archive'";
if(mysqli_query($conn, $sql)){
    echo "<script type=\"text/javascript\">
            alert('Events have been unarchived!');
            window.location='../archives.php';
          </script>";
}else{
    echo "Error".$sql."<br>".$conn->error;
}

mysqli_close($conn);
?>