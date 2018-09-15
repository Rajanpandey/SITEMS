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

$eventId = $_POST["eventId"]; 
$sql="UPDATE events SET approvalStatus='1' WHERE eventId='$eventId'";
$result=mysqli_query($conn, $sql);

$sql2="SELECT * FROM events WHERE eventId='$eventId'";
$result2=mysqli_query($conn, $sql2);
$array = array();
while($row=mysqli_fetch_assoc($result2)){
    $array[]=$row;
}

$str=$array[0]['media'];
$files=explode(",",$str);
$noOfFiles=count($files);

$date=$array[0]['date'];
$newDate = date("Y-d-F", strtotime($date));
$department=$array[0]['department'];
$category=$array[0]['category'];
$name=$array[0]['name'];
$target_dir = '../Media/'.substr($newDate, 0, 4).'/'.str_replace(' ', '', $department).'/'.substr($newDate, 8).' - '.str_replace(' ', '', $category).'/'.$name;
if(!is_dir($target_dir)){
    mkdir($target_dir, 0777, true);
}

for($i=0; $i<$noOfFiles; $i=$i+1){
    rename("../TempMedia/$files[$i]", "../Media/$files[$i]");
}

removeEmptySubFolders("../TempMedia");

mysqli_close($conn);

function removeEmptySubFolders($path)
{
  $empty=true;
  foreach (glob($path.DIRECTORY_SEPARATOR."*") as $file)
  {
     $empty &= is_dir($file) && RemoveEmptySubFolders($file);
  }
  return $empty && rmdir($path);
}
?>