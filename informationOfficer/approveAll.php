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

$sql="UPDATE events SET approvalStatus='1' WHERE approvalStatus IS NULL";
if(mysqli_query($conn, $sql)){
    echo "<script type=\"text/javascript\">
        alert('All the events are approved!');
        window.location='home.php';
        </script>";
}else{
    echo "<script type=\"text/javascript\">
        alert('Sorry, something went wrong!');
        window.location='home.php';
        </script>";
}




mysqli_close($conn);
?>