<?php
include('session.php');
if(!isset($_SESSION['login_user'])){
    header("location: index.php");
}
?>

<?php
require('connect.php');

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$password=$_POST['password'];
echo $password;

$sql="UPDATE users SET password='$password' WHERE email='$login_session'";
if(mysqli_query($conn, $sql)){
    echo "<script type=\"text/javascript\">
            alert('Password has been changed!');
            window.location='index.php';
          </script>";
}else{
    echo "Error".$sql."<br>".$conn->error;
}

mysqli_close($conn);
?>