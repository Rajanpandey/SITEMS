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

$name=mysqli_real_escape_string($conn,trim($_POST['name']));
$email=mysqli_real_escape_string($conn,trim($_POST['email']));
$password=mysqli_real_escape_string($conn,trim($_POST['password']));
$type=$_POST['type'];

$noOfAdds=sizeof($name);

for($i=0; $i<$noOfAdds; $i++){
    $sql="INSERT INTO users (name, email, password, type) VALUES ('$name[$i]', '$email[$i]', '$password[$i]', '$type[$i]')";
    $result=mysqli_query($conn, $sql);
}
  
echo "<script type=\"text/javascript\">
        alert('The user(s) has/have been added to the Database!');
        window.location='allUsers.php';
      </script>";

mysqli_close($conn);
?>