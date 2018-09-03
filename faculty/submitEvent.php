<?php
include('../session.php');
$login_session=$_SESSION['login_user'];
$sqlUserId="SELECT userId FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['userId'];

$conn=mysqli_connect("localhost", "root", "", "sitems");

//Used mysqli_real_escape_string to avoid apostrophe conflicts
$name=mysqli_real_escape_string($conn,trim($_POST['name']));
$department=mysqli_real_escape_string($conn,trim($_POST['department']));
$incharge=mysqli_real_escape_string($conn,trim($_POST['incharge']));
$date=mysqli_real_escape_string($conn,trim($_POST['date']));
$category=mysqli_real_escape_string($conn,trim($_POST['category']));
$type=mysqli_real_escape_string($conn,trim($_POST['type']));
$describe=mysqli_real_escape_string($conn,trim($_POST['describe']));
$achievement=mysqli_real_escape_string($conn,trim($_POST['achievement']));

//Used implode to separate array values with commas
$attendees=implode(',', (array)$_POST['attendees']);
$for=implode(',', (array)$_POST['for']);

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}
else{
    //Changed date format to YEAR-DATE-MONTH (2018-02-September)
    $newDate = date("Y-d-F", strtotime($date));
    
    //Set target directory to required value. If it doesn't exists, create it.
    $target_dir = '../Media/'.substr($newDate, 0, 4).str_replace(' ', '', $department).substr($newDate, 8).str_replace(' ', '', $category).'/'.str_replace(' ', '', $name);
    if(!is_dir($target_dir)){
        mkdir($target_dir, 0777, true);
    }
    
    //Run a loop to store all the uploaded files in the file storage
    $noOfFiles=count($_FILES["media"]["name"]);
    $arrayOfFileNames=array();
    for($i=0; $i<$noOfFiles; $i=$i+1){
        $filename=$_FILES["media"]["name"][$i];
        $target_file = $target_dir.'/'.$filename;
        move_uploaded_file($_FILES["media"]["tmp_name"][$i], $target_file);
        $arrayOfFileNames[$i]=substr($newDate, 0, 4).str_replace(' ', '', $department).substr($newDate, 8).str_replace(' ', '', $category).'/'.str_replace(' ', '', $name).'/'.$filename;
    }
    $new_name=implode(',', $arrayOfFileNames);
  
    //Store everything to the database
    $sql="INSERT INTO events (name, department, incharge, date, type, eventDescribe, achievements, attendees, eventFor, category, media, userId) 
        VALUES ('$name', '$department', '$incharge', '$date', '$type', '$describe', '$achievement', '$attendees', '$for', '$category', '$new_name', '$userId')";    
    if(mysqli_query($conn, $sql)){
        echo "<script type=\"text/javascript\">
        alert('Your event has been sent to information officer for approval!');
        window.location='home.php';
        </script>";
    } else {
        echo "Error".$sql."<br>".$conn->error;
    }          
}          

mysqli_close($conn);
?>
