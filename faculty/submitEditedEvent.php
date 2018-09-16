<?php
include('../session.php');
$login_session=$_SESSION['login_user'];
$sqlUserId="SELECT userId FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['userId'];

require('../connect.php');

$eventId=$_POST['eventId'];
$sql="SELECT * FROM events WHERE eventId='$eventId'";
$result=mysqli_query($conn, $sql);
if($result!=NULL){
    $array = array();
    while($row=mysqli_fetch_assoc($result)){
         $array[]=$row;
    }
}

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
$resourceName=implode(',', (array)$_POST['resourceName']);
$resourceDesignation=implode(',', (array)$_POST['resourceDesignation']);
$attendees=implode(',', (array)$_POST['attendees']);
$for=implode(',', (array)$_POST['for']);

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
    array_push($arrayOfFileNames, $array[0]['media']);
    $new_name=implode(',', $arrayOfFileNames);
    
    $str=$array[0]['media'];
    $files=explode(",",$str);
    $noOfOldFiles=count($files);
    
    for($i=0; $i<$noOfOldFiles; $i=$i+1){
        $arr=explode("/",$files[$i]);
        $oldName=end($arr);
        $newPath='../TempMedia/'.substr($newDate, 0, 4).'/'.str_replace(' ', '', $department).'/'.substr($newDate, 8).' - '.str_replace(' ', '', $category).'/'.$name.'/'.$oldName;
        rename("../TempMedia/$files[$i]", "$newPath");
    }    
  
    //Store everything to the database
    if (isset($_POST['submit'])) {
            $sql="UPDATE events SET name='$name', department='$department', incharge='$incharge', date='$date', year='$year', type='$type', eventDescribe='$describe', achievements='$achievement', attendees='$attendees', eventFor='$for', resourceName='$resourceName', resourceDesignation='$resourceDesignation', category='$category', media='$new_name', url='$new_url', approvalStatus=NULL, declineReply=NULL, viewedNotification=NULL, draft=NULL WHERE eventId='$eventId'";
    
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
        $sql="UPDATE events SET name='$name', department='$department', incharge='$incharge', date='$date', year='$year', type='$type', eventDescribe='$describe', achievements='$achievement', attendees='$attendees', eventFor='$for', resourceName='$resourceName', resourceDesignation='$resourceDesignation', category='$category', media='$new_name', url='$new_url', draft='1', approvalStatus=NULL, declineReply=NULL, viewedNotification=NULL WHERE eventId='$eventId'";
        
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
