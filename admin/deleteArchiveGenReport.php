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

$sql="SELECT * FROM events WHERE archive='$archive'";
$result=mysqli_query($conn, $sql);
$array = array();
while($row=mysqli_fetch_assoc($result)){
    $array[]=$row;
}
$noOfEvents=mysqli_num_rows($result);

for($i=0; $i<$noOfEvents; $i=$i+1){    
    $str=$array[$i]['media'];
    $files=explode(",",$str);
    $noOfFiles=count($files);

    $date=$array[$i]['date'];
    $newDate = date("Y-d-F", strtotime($date));
    $department=$array[$i]['department'];
    $category=$array[$i]['category'];
    $name=$array[$i]['name'];
    
    $target_dir = '../ArchivedMedia/'.$archive.'/'.substr($newDate, 0, 4).'/'.str_replace(' ', '', $department).'/'.substr($newDate, 8).' - '.str_replace(' ', '', $category).'/'.$name;
    if(!is_dir($target_dir)){
        mkdir($target_dir, 0777, true);
    }

    for($j=0; $j<$noOfFiles; $j=$j+1){
        rename("../Media/$files[$j]", "../ArchivedMedia/$archive/$files[$j]");
    }    
}

$sql="DELETE FROM events WHERE archive='$archive'";
if(mysqli_query($conn, $sql)){
    echo "<script type=\"text/javascript\">
            alert('Report has been generated and the archive has been permanently deleted!');
            window.location='../archives.php';
          </script>";
}else{
    echo "Error".$sql."<br>".$conn->error;
}

removeEmptySubFolders("../Media");

mysqli_close($conn);

function removeEmptySubFolders($path){
  $empty=true;
  foreach (glob($path.DIRECTORY_SEPARATOR."*") as $file){
     $empty &= is_dir($file) && RemoveEmptySubFolders($file);
  }
  return $empty && rmdir($path);
}
?>