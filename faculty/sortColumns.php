<?php
include('../session.php');
if(!isset($_SESSION['login_user'])){
    header("location: ../index.php");
}
?>

<?php  
 //sort.php  
$connect=mysqli_connect("localhost", "root", "", "sitems");

//Query to select the user
$sqlUserId="SELECT userId FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['userId'];

 $output = '';  
 $order = $_POST["order"];  
 if($order == 'desc')  
 {  
      $order = 'asc';  
 }  
 else  
 {  
      $order = 'desc';  
 }  
 $query = "SELECT * FROM events WHERE userId='$userId' AND approvalStatus='1' ORDER BY ".$_POST['column_name']." ".$_POST['order']."";
 $result = mysqli_query($connect, $query);  
 $output .= '  
 <table class="table table-bordered table-hover">
      <thead class="thead-dark">  
        <th><a class="column_sort" id="name" data-order="'.$order.'" href="#">Name of the Event</a></th>
        <th><a class="column_sort" id="department" data-order="'.$order.'" href="#">Department</a></th>  
        <th><a class="column_sort" id="category" data-order="'.$order.'" href="#">Category</a></th>
        <th><a class="column_sort" id="eventDescribe" data-order="'.$order.'" href="#">Description</a></th>    
        <th><a class="column_sort" id="date" data-order="'.$order.'" href="#">Date</a></th>
        <th><a class="column_sort" id="attendees" data-order="'.$order.'" href="#">Attendees</a></th>
        <th><a class="column_sort" id="eventFor" data-order="'.$order.'" href="#">Event For</a></th>
        <th><a class="column_sort" id="type" data-order="'.$order.'" href="#">Type</a></th>
      </thead>  
 ';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
      <tr>  
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
 ?>  