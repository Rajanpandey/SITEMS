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

$sql="SELECT * FROM events WHERE approvalStatus IS NULL";
$result=mysqli_query($conn, $sql);
$array=array();
while($row=mysqli_fetch_assoc($result)){
    $array[]=$row;
}
$totalUnapprovedEvents=mysqli_num_rows($result);

for($i=0; $i<$totalUnapprovedEvents; $i=$i+1){
    $str=$array[$i]['media'];
    $files=explode(",",$str);
    $noOfFiles=count($files);

    $date=$array[$i]['date'];
    $newDate = date("Y-d-F", strtotime($date));
    $department=$array[$i]['department'];
    $category=$array[$i]['category'];
    $name=$array[$i]['name'];
    
    $target_dir = '../Media/'.substr($newDate, 0, 4).'/'.str_replace(' ', '', $department).'/'.substr($newDate, 8).' - '.str_replace(' ', '', $category).'/'.$name;
    if(!is_dir($target_dir)){
        mkdir($target_dir, 0777, true);
    }

    for($j=0; $j<$noOfFiles; $j=$j+1){
        rename("../TempMedia/$files[$j]", "../Media/$files[$j]");
    }
}

$sql="UPDATE events SET approvalStatus='1' WHERE approvalStatus IS NULL";
$result2=mysqli_query($conn, $sql);

removeEmptySubFolders("../TempMedia/2018");

echo "<script type=\"text/javascript\">
    alert('All the events are approved!');
    window.location='home.php';
    </script>";

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