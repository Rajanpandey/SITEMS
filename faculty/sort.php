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

//Query to select the user
$sqlUserId="SELECT * FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['userId'];

$department=$_POST['department'];
$category=$_POST['category'];
$year=$_POST['year'];
$type=$_POST['type'];
$attendees=$_POST['attendees'];
$eventFor=$_POST['eventFor'];

$sql="SELECT * FROM events WHERE userId='$userId' AND approvalStatus='1' AND archive IS NULL";

if($department!=""){
    $sql=$sql." AND department IN ('$department')";
}
if($category!=""){
    $sql=$sql." AND category IN ('$category')";
}
if($year!=""){
    $sql=$sql." AND year IN ('$year')";
}
if($type!=""){
    $sql=$sql." AND type IN ('$type')";
}
if($attendees!=""){
    $sql=$sql." AND attendees IN ('$attendees')";
}
if($eventFor!=""){
    $sql=$sql." AND eventFor IN ('$eventFor')";
}

$result=mysqli_query($conn, $sql);

$output ="";
$output .= '  
 <table class="table table-bordered table-hover" id="myTable">
      <thead class="thead-dark">  
        <th><a id="name">Name of the Event</a></th>
        <th><a id="department">Department</a></th>  
        <th><a id="category">Category</a></th>
        <th><a id="eventDescribe">Description</a></th>    
        <th><a id="date">Date</a></th>
        <th><a id="attendees">Attendees</a></th>
        <th><a id="eventFor">Event For</a></th>
        <th><a id="type">Type</a></th>
      </thead>  
 ';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
      <tr onclick=location.href="eventDetails.php/?url='.$row["url"].'">
           <td>' . $row["name"] . '</td>   
           <td>' . $row["department"] . '</td>  
           <td>' . $row["category"] . '</td>  
           <td>' . $row["eventDescribe"] . '</td> 
           <td>' . $row["date"] . '</td>  
           <td>' . $row["attendees"] . '</td>  
           <td>' . $row["eventFor"] . '</td>  
           <td>' . $row["type"] . '</td>  
      </tr>  
      ';  
 } 
 $output .= '</table>';  
 echo $output;  

mysqli_close($conn);
?>