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

//Logic to count total pages for pagination
$num_rec_per_page=10;
$selecAllIssues = "SELECT * FROM events WHERE userId='$userId' AND approvalStatus='1'";
$allIssues = mysqli_query($conn, $selecAllIssues);			  
$total_records =mysqli_num_rows($allIssues);  //count number of issues					  
$total_pages = ceil($total_records / $num_rec_per_page);   

//Fetch Issues Posted By All Users
if(isset($_GET["page"])) {
    $page  = $_GET["page"]; 
} else { 
    $page=1; 
}; 


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
 $start_from=($page-1)*$num_rec_per_page; 
 $query = "SELECT * FROM events WHERE userId='$userId' AND approvalStatus='1' ORDER BY ".$_POST['column_name']." ".$_POST['order']." LIMIT $start_from, $num_rec_per_page";
 $result = mysqli_query($connect, $query);  
 $output .= '  
 <table class="table table-bordered table-hover">
      <thead>  
        <th><a class="column_sort" id="name" data-order="'.$order.'" href="#">Name of the Event</a></th>
        <th><a class="column_sort" id="category" data-order="'.$order.'" href="#">Category</a></th>  
        <th><a class="column_sort" id="eventDescribe" data-order="'.$order.'" href="#">Description</a></th>
        <th><a class="column_sort" id="date" data-order="'.$order.'" href="#">Date</a></th>    
        <th><a class="column_sort" id="url" data-order="'.$order.'" href="#">Details</a></th>
      </thead>  
 ';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
      <tr>  
           <td>' . $row["name"] . '</td>  
           <td>' . $row["category"] . '</td>  
           <td>' . $row["eventDescribe"] . '</td>  
           <td>' . $row["date"] . '</td>  
           <td><a href="events.php/url='.$row["url"].'"><button  type="button" class="btn btn-outline-dark">View</button></a></td>
      </tr>  
      ';  
 }  
 $output .= '</table>';  
 echo $output;  
 ?>  