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

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
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