<?php
include('../session.php');
$login_session=$_SESSION['login_user'];
$sqlUserId="SELECT userId FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['userId'];

require('../connect.php');

//Used mysqli_real_escape_string to avoid apostrophe conflicts
$name=mysqli_real_escape_string($conn,trim($_POST['name']));
$department=mysqli_real_escape_string($conn,trim($_POST['department']));
$incharge=mysqli_real_escape_string($conn,trim($_POST['incharge']));
$date=mysqli_real_escape_string($conn,trim($_POST['date']));
$category=mysqli_real_escape_string($conn,trim($_POST['category']));
$type=mysqli_real_escape_string($conn,trim($_POST['type']));
$describe=mysqli_real_escape_string($conn,trim($_POST['describe']));
$achievement=mysqli_real_escape_string($conn,trim($_POST['achievement']));
$year=substr($date, 0, 4);

//Used implode to separate array values with commas
$attendees=implode(',', (array)$_POST['attendees']);
$for=implode(',', (array)$_POST['for']);
$resourceName=implode(',', (array)$_POST['resourceName']);
$resourceDesignation=implode(',', (array)$_POST['resourceDesignation']);

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}
else{
    
    //Login for dynamic url generation
    $new_url=friendly_seo_string($name);                                
    $counter=1;		
    $intial_url=$new_url;	    
    while(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM events WHERE url ='$new_url'" ))){	          
        $counter++;        
        $new_url="{$intial_url}-{$counter}"; 
        //If the url already exists for some other article then put a number (-2, -3...etc) infront of it
    }      
    
    //Changed date format to YEAR-DATE-MONTH (2018-02-September)
    $newDate = date("Y-d-F", strtotime($date));
    
    //Set target directory to required value. If it doesn't exists, create it.
    $target_dir = '../TempMedia/'.substr($newDate, 0, 4).'/'.str_replace(' ', '', $department).'/'.substr($newDate, 8).' - '.str_replace(' ', '', $category).'/'.$name;
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
        $arrayOfFileNames[$i]=substr($newDate, 0, 4).'/'.str_replace(' ', '', $department).'/'.substr($newDate, 8).' - '.str_replace(' ', '', $category).'/'.$name.'/'.$filename;
    }
    $new_name=implode(',', $arrayOfFileNames);
  
    //Store everything to the database
    if (isset($_POST['submit'])) {
         $sql="INSERT INTO events (name, department, incharge, date, year, type, eventDescribe, achievements, attendees, eventFor, resourceName, resourceDesignation, category, media, userId, url) VALUES ('$name', '$department', '$incharge', '$date', '$year', '$type', '$describe', '$achievement', '$attendees', '$for', '$resourceName', '$resourceDesignation', '$category', '$new_name', '$userId', '$new_url')"; 
        
        if(mysqli_query($conn, $sql)){
            echo "<script type=\"text/javascript\">
            alert('Your event has been sent to information officer for approval!');
            window.location='home.php';
            </script>";
        } else {
            echo "Error".$sql."<br>".$conn->error;
        }  
    }
    elseif (isset($_POST['save'])) {        
        $sql="INSERT INTO events (name, department, incharge, date, year, type, eventDescribe, achievements, attendees, eventFor, resourceName, resourceDesignation, category, media, userId, url, draft) VALUES ('$name', '$department', '$incharge', '$date', '$year', '$type', '$describe', '$achievement', '$attendees', '$for', '$resourceName', '$resourceDesignation', '$category', '$new_name', '$userId', '$new_url', '1')";
        
        if(mysqli_query($conn, $sql)){
            echo "<script type=\"text/javascript\">
            alert('Your event has been saved to drafts!');
            window.location='home.php';
            </script>";
        } else {
            echo "Error".$sql."<br>".$conn->error;
        }  
    }
   
    
            
}          

function friendly_seo_string($vp_string){   														
    $vp_string = trim($vp_string);														
    $vp_string = html_entity_decode($vp_string);														
    $vp_string = strip_tags($vp_string);														
    $vp_string = strtolower($vp_string);														
    $vp_string = preg_replace('~[^ a-z0-9_.]~', ' ', $vp_string);														
    $vp_string = preg_replace('~ ~', '-', $vp_string);														
    $vp_string = preg_replace('~-+~', '-', $vp_string);												
    return $vp_string;
						
}  

mysqli_close($conn);
?>
