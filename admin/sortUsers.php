<?php
include('../session.php');
if(!isset($_SESSION['login_user'])){
    header("location: ../index.php");
}
?>

<?php  
 //sort.php  
require('../connect.php');

$output="";
$role=$_POST['role_name'];
if($role=="Information Officer"){
    $role="InformationOfficer";
}
  
 $query = "SELECT * FROM users WHERE type='$role'";
 $result = mysqli_query($conn, $query);  
 $output .= '  
 <table class="table table-bordered table-hover allEventsTable" id="myTable">
          <thead class="thead-dark">
            <tr>
              <th>User ID</th>
              <th>Name</th>    
              <th>EMail</th>              
              <th>Password</th>
              <th>Role</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
 ';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
      <tr>  
           <td>' . $row["userId"] . '</td>   
           <td>' . $row["name"] . '</td>  
           <td>' . $row["email"] . '</td>  
           <td>' . $row["password"] . '</td> 
           <td>' . $row["type"] . '</td>  
           <td><button type="button" class="btn btn-outline-info edit" data-toggle="modal" data-target="#myModal2">Edit</button></td>
           <td><a href="deleteUser.php/?userId='. $row["userId"]. '"><button type="button" class="btn btn-outline-danger">Delete</button></a></td>
      </tr>  
      ';  
 }  
 $output .= '</table>';  
 echo $output;  
 ?>  