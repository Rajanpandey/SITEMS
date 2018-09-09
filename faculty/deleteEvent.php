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

$url=$_GET["url"]; 

$sql="SELECT * FROM events WHERE url='$url'";
$result=mysqli_query($conn, $sql);
if($result!=NULL){
    $array = array();
    while($row=mysqli_fetch_assoc($result)){
         $array[]=$row;
    }
}

$date=$array[0]['date'];
$newDate=date("Y-d-F", strtotime($date));    
$target_dir = '../TempMedia/'.substr($array[0]['date'], 0, 4).'/'.str_replace(' ', '', $array[0]['department']).'/'.substr($newDate, 8).' - '.str_replace(' ', '', $array[0]['category']).'/'.$array[0]['name'].'/*';
$files = glob($target_dir); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}

$sql="DELETE FROM events WHERE url='$url'";
if(mysqli_query($conn, $sql)){
    echo "<script type=\"text/javascript\">
           alert('The event has been permanently deleted!');
           window.location='rejectedEvents.php';
          </script>";
}else{
    echo "Error".$sql."<br>".$conn->error;
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
