<?php
include('../session.php');
if(!isset($_SESSION['login_user'])){
    header("location: ../index.php");
}
?>

<?php
$conn=mysqli_connect("localhost", "root", "", "sitems");

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

//Query to select the user
$sqlUserId="SELECT userId FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['userId'];

//Query to select events that are rejected
$sql="SELECT * FROM events WHERE userId='$userId' AND approvalStatus='-1' ORDER BY declineReply DESC";
$result=mysqli_query($conn, $sql);
$array=array();
while($row=$result->fetch_array()){
         $array[]=$row;
}
$noOfDeclinedEvents=mysqli_num_rows($result);

//Query to select number of new messages
$sql="SELECT * FROM events WHERE userId='$userId' AND declineReply IS NOT NULL AND viewedNotification IS NULL";
$result=mysqli_query($conn, $sql);
$array3=array();
while($row=$result->fetch_array()){
         $array3[]=$row;
}
$data=mysqli_num_rows($result);

mysqli_close($conn);
?>


<!DOCTYPE HTML>
<html>
<head>
    <!-- Meta Data -->
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    
    <!-- Bootstrap -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">	
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- My CSS -->  
	<link rel="stylesheet" href="../assets/mycss/facultyHome.css">
	
	<title>Rejected Events</title>
</head>

<body>

<!-- Navbar starts -->  
<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" href="home.php"><i class="fas fa-home"></i>   Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled"><i class="far fa-calendar"></i>   Rejected Events</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="allEvents.php"><i class="fas fa-calendar-alt"></i>   All Events</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
<li class="nav-item dropdown">
  <?php
    if($data==0){
  ?>
    <a class="nav-link"><i class="far fa-bell"> No New Message</i></a>
  <?php
    }else{
  ?>
    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown"><i class="fas fa-bell"> New Message (<?php echo $data ?>)</i></a>
      <div class="dropdown-menu dropdown-menu-right">
       <?php
        for($i=0; $i<$data; $i=$i+1){
       ?>
        <a class="dropdown-item" href="../eventDetails.php/?url=<?php echo $array3[$i]['url']; ?>"><?php echo $array3[$i]['name']; ?><br/><?php echo $array3[$i]['declineReply']; ?></a>
      <?php
        }
      ?>
      </div>
  <?php
    } 
  ?>  
</li>
    
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle">       Profile</i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="profile.php"><i class="fas fa-user-alt"></i>   My Profile</a>
        <a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i>   Logout</a>
      </div>
    </li>
  </ul>
</nav>
<!-- Navbar ends -->  


<div class="container">
    <div class="row">        
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <br/><h3>Rejected Events: </h3><br/>
        </div>
        
    <?php 
        if($noOfDeclinedEvents==0){
    ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-success">
          <strong>Congrats!</strong> There is no declined event!
        </div>
    <?php 
        }else{

    ?>

    <?php             
        }
    ?>              
        
        <div class="table-responsive" id="myTable">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th><a class="column_sort" id="name">Name of the Event</a></th>
              <th><a class="column_sort" id="department">Department</a></th>      
              <th><a class="column_sort" id="category">Category</a></th>              
              <th><a class="column_sort" id="eventDescribe">Description</a></th>
              <th><a class="column_sort" id="date">Date</a></th>
              <th><a class="column_sort" id="response">Response</a></th>
              <th><a class="column_sort" id="edit">Edit</a></th>
              <th><a class="column_sort" id="delete">Delete</a></th>
            </tr>
          </thead>
          <tbody>
          <?php    
                for($i=0; $i<$noOfDeclinedEvents; $i=$i+1){
            ?>
                <div id="eventRows">
                 <tr class='clickable-row' data-href='../eventDetails.php/?url=<?php echo $array[$i]['url']; ?>'>
                  <td><?php echo $array[$i]['name']; ?></td>
                  <td><?php echo $array[$i]['department']; ?></td>
                  <td><?php echo $array[$i]['category']; ?></td>
                  <td><?php echo $array[$i]['eventDescribe']; ?></td>
                  <td><?php echo $array[$i]['date']; ?></td>
                  <?php    
                    if($array[$i]['declineReply']!=''){
                  ?>
                  <td><a href=""><button type="button" class="btn btn-outline-dark">View</button></a></td>                  
                  <td><a href=""><button type="button" class="btn btn-outline-primary">Edit</button></a></td>
                  <td><a href=""><button type="button" class="btn btn-outline-danger">Delete</button></a></td>
                  <?php    
                    }else{
                  ?>
                  <td colspan="3"><a href=""><button type="button" class="btn btn-outline-danger">No Response, Delete</button></a></td>                  
                  <?php    
                    }
                  ?>                  
                </tr>
                </div>
          <?php
                }              
          ?>
          </tbody>
        </table>  
        </div>
        
    </div>
    <br/><br/><br/>
</div>

<!-- Ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>  

<!-- Bootstrap -->
<script src="../assets/js/bootstrap.min.js"></script>

<script>  
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
 </script> 
 

</body>