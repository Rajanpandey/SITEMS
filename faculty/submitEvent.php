<?php
$conn=mysqli_connect("fdb20.your-hosting.net", "2703787_sitems", "rkp12345", "2703787_sitems");

//Used mysqli_real_escape_string o avoid apostrophe conflicts
$name=mysqli_real_escape_string($conn,trim($_POST['name']));
$department=mysqli_real_escape_string($conn,trim($_POST['department']));
$incharge=mysqli_real_escape_string($conn,trim($_POST['incharge']));
$date=mysqli_real_escape_string($conn,trim($_POST['date']));
$category=mysqli_real_escape_string($conn,trim($_POST['category']));
$type=mysqli_real_escape_string($conn,trim($_POST['type']));
$describe=mysqli_real_escape_string($conn,trim($_POST['describe']));
$achievement=mysqli_real_escape_string($conn,trim($_POST['achievement']));
$attendees=implode(',', (array)$_POST['attendees']);
$for=implode(',', (array)$_POST['for']);
$media=implode(',', (array)$_POST['media']);

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}
else{
    $newDate = date("Y-d-F", strtotime($date));
    $target_dir = '../Media/'.substr($newDate, 0, 4).str_replace(' ', '', $department).substr($newDate, 8).str_replace(' ', '', $category);
    if(!is_dir($target_dir)){
        mkdir($target_dir, 0777, true);
    }
    
    $uniqid=uniqid();
    $fileType = strtolower(pathinfo(basename($_FILES["media"]["name"][0]),PATHINFO_EXTENSION));
    $target_file = $target_dir.'/'.$uniqid.".".$fileType;
    $new_name=$uniqid.".".$fileType;    

    if (move_uploaded_file($_FILES["media"]["tmp_name"][0], $target_file)) {
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
}          

mysqli_close($conn);
?>
