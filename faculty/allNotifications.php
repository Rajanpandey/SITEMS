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
$sql="SELECT * FROM events WHERE userId='$userId' AND declineReply IS NOT NULL AND viewedNotification IS NULL";
$result=mysqli_query($conn, $sql);
$array=array();
while($row=$result->fetch_array()){
         $array[]=$row;
}
$noOfNotifications=mysqli_num_rows($result);

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
	
	<title>Notifications</title>
</head>

<body>

<!-- Navbar starts -->  
<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" href="home.php"><i class="fas fa-home"></i>   Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="rejectedEvents.php"><i class="far fa-calendar"></i>   Rejected Events</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="allEvents.php"><i class="fas fa-calendar-alt"></i>   All Events</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
<li class="nav-item dropdown">
  <?php
    if($noOfNotifications==0){
  ?>
    <a class="nav-link disabled"><i class="far fa-bell"> No New Message</i></a>
  <?php
    }else{
  ?>
    <a class="nav-link dropdown-toggle disabled" href="#" id="navbardrop" data-toggle="dropdown"><i class="fas fa-bell"> New Message (<?php echo $noOfNotifications ?>)</i></a>
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
            <br/><h3>All new notifications: </h3><br/>
            <a href="clearNotifications.php">Clear all notification</a>
        </div>
    </div>
        
 <div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
    <?php
     for($i=0; $i<$noOfNotifications; $i=$i+1){
    ?>
      <a class="list-group-item list-group-item-action" id="<?php echo $i ?>" data-toggle="list" href="#list-<?php echo $i.$i ?>" role="tab" aria-controls="home"><?php echo $array[$i]['name']; ?></a>
    <?php
     }
    ?>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
     <?php
      for($i=0; $i<$noOfNotifications; $i=$i+1){
     ?>
        <div class="tab-pane fade" id="list-<?php echo $i.$i ?>" role="tabpanel" aria-labelledby="<?php echo $i ?>"><a href="../eventDetails.php/?url=<?php echo $array[$i]['url']; ?>"><?php echo $array[$i]['declineReply']; ?></a></div>
     <?php
      }
     ?>
    </div>
  </div>
 </div>
    </div>
    <br/><br/><br/>

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