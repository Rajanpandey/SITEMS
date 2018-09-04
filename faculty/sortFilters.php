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



$query1='1=1';
$query2='1=1';
$query3='1=1';
$query4='1=1';
$query5='1=1';
$query6='1=1';

$department=$_POST['department1'];
$year=$_POST['year1'];
$type=$_POST['type1'];
$category=$_POST['category1'];

if($_POST["department1"]!=''){
    $query1="department='$department'";
}
if($_POST["year1"]!=''){
    $query2="year='$year'";
}
if($_POST["type1"]!=''){
    $query3="type='$type'";
}
if($_POST["category1"]!=''){
    $query4="category='$category'";
}
 $output = '';  
 $start_from=($page-1)*$num_rec_per_page; 
 $query = "SELECT * FROM events WHERE $query1 LIMIT $start_from, $num_rec_per_page";
 $result = mysqli_query($connect, $query);  
 $output .= '  
 <table class="table table-bordered table-hover">
      <thead>  
        <th><a class="column_sort" id="name" data-order="" href="#">Name of the Event</a></th>
        <th><a class="column_sort" id="category" data-order="" href="#">Category</a></th>  
        <th><a class="column_sort" id="eventDescribe" data-order="" href="#">Description</a></th>
        <th><a class="column_sort" id="date" data-order="" href="#">Date</a></th>    
        <th><a class="column_sort" id="url" data-order="" href="#">Details</a></th>
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