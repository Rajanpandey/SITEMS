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
$userName = $rowUserId['name'];

//Query to select events that are rejected
$sql="SELECT * FROM events WHERE userId='$userId' AND draft IS NOT NULL ORDER BY time ASC";
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
	<link rel="stylesheet" href="../assets/mycss/table.css">
	
	<title>Drafts</title>
</head>

<body>

<!-- Navbar starts -->  
<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" href="home.php"><i class="fas fa-home"></i>   Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled"><i class="fas fa-bookmark"></i>   Drafts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="rejectedEvents.php"><i class="far fa-calendar"></i>   Rejected Events</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="allEvents.php"><i class="fas fa-calendar-alt"></i>   Approved Events</a>
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
          <a class="dropdown-item" href="clearNotifications.php/?url=<?php echo $userId; ?>" style="text-align:right;">Clear all notification</a>
       <?php
        if($data<=10){
        for($i=0; $i<$data; $i=$i+1){
            if($i%2==0){
       ?>
        <a class="dropdown-item" href="eventDetails.php/?url=<?php echo $array3[$i]['url']; ?>"><?php echo $array3[$i]['name']; ?><br/><?php echo substr($array3[$i]['declineReply'], 0, 40); ?></a>
      <?php
            }else{
      ?>
        <a class="dropdown-item" href="eventDetails.php/?url=<?php echo $array3[$i]['url']; ?>" style="background-color:#C7BBF0;"><?php echo $array3[$i]['name']; ?><br/><?php echo substr($array3[$i]['declineReply'], 0, 40); ?></a>
      <?php  
            }
        }
       }else{
            for($i=0; $i<10; $i=$i+1){
            if($i%2==0){
       ?>
        <a class="dropdown-item" href="eventDetails.php/?url=<?php echo $array3[$i]['url']; ?>"><?php echo $array3[$i]['name']; ?><br/><?php echo substr($array3[$i]['declineReply'], 0, 40); ?></a>
      <?php
            }else{
      ?>
        <a class="dropdown-item" href="eventDetails.php/?url=<?php echo $array3[$i]['url']; ?>" style="background-color:#C7BBF0;"><?php echo $array3[$i]['name']; ?><br/><?php echo substr($array3[$i]['declineReply'], 0, 40); ?></a>
      <?php  
            }
          }
       ?>
            <a class="dropdown-item" href="allNotifications.php/?url=<?php echo $userId; ?>" style="text-align:right;">View all notifications</a>
      <?php  
        }
      ?>
      </div>
  <?php
    } 
  ?>  
    
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle">       <?php echo $userName; ?></i></a>
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
            <br/><h3>Drafted Event Data: </h3><br/>
        </div>
        
    <?php 
        if($noOfDeclinedEvents==0){
    ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-success">
          There are no drafted event data!
        </div>
    <?php 
        }

    ?>            
        
        <div class="table-responsive" id="myTable">
        <table class="table table-bordered table-hover">
          <thead class="thead-light">
            <tr>
              <th><a id="name">Name of the Event</a></th>
              <th><a id="department">Department</a></th>      
              <th><a id="category">Category</a></th>              
              <th><a id="eventDescribe">Description</a></th>
              <th><a id="date">Date</a></th>
              <th><a id="edit">Edit</a></th>
              <th><a id="delete">Delete</a></th>
            </tr>
          </thead>
          <tbody>
          <?php    
                for($i=0; $i<$noOfDeclinedEvents; $i=$i+1){
            ?>
                <div id="eventRows">
                 <tr class='clickable-row' data-href='eventDetails.php/?url=<?php echo $array[$i]['url']; ?>'>
                  <td><?php echo $array[$i]['name']; ?></td>
                  <td><?php echo $array[$i]['department']; ?></td>
                  <td><?php echo $array[$i]['category']; ?></td>
                  <td><?php echo $array[$i]['eventDescribe']; ?></td>
                  <td><?php echo $array[$i]['date']; ?></td>        
                  <td><a href="editEvent.php/?url=<?php echo $array[$i]['url']; ?>"><button type="button" class="btn btn-outline-primary">Edit</button></a></td>
                  <td><a href="deleteEvent.php?url=<?php echo $array[$i]['url']; ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a></td>                 
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
    
$(".viewResponse").click(function(){
    alert(this.id);
});
    
</script> 
 

</body>