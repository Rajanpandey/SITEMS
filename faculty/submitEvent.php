<?php
$conn=mysqli_connect("fdb20.your-hosting.net", "2703787_sitems", "rkp12345", "2703787_sitems");

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
$media=implode(',', (array)$_POST['media']);

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
    
    //Store the file in the file storage, and it's path in the DB
    $filename=$_FILES["media"]["name"][0];
    $new_name=substr($newDate, 0, 4).str_replace(' ', '', $department).substr($newDate, 8).str_replace(' ', '', $category).'/'.str_replace(' ', '', $name).'/'.$filename;    

    //Target file is the complete path of the file to be stored. move_uploaded_file uploads the file.
    $target_file = $target_dir.'/'.$filename;
    move_uploaded_file($_FILES["media"]["tmp_name"][0], $target_file);
  
    //Store everything to the database
    $sql="INSERT INTO events (name, department, incharge, date, type, eventDescribe, achievements, attendees, eventFor, category, media) 
        VALUES ('$name', '$department', '$incharge', '$date', '$type', '$describe', '$achievement', '$attendees', '$for', '$category', '$new_name')";    
    if(mysqli_query($conn, $sql)){
        echo "<script type=\"text/javascript\">
        alert('Your event has been sent to information officer for approval!');
        window.location='home.html';
        </script>";
    } else {
        echo "Error".$sql."<br>".$conn->error;
    }          
}          

mysqli_close($conn);
?>
