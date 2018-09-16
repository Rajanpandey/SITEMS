<?php
include('../session.php');
if(!isset($_SESSION['login_user'])){
    header("location: ../../index.php");
}
?>

<?php
require('../connect.php');

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$url=$_GET["url"]; 

//Query to select the user
$sqlUserId="SELECT * FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userId = $rowUserId['userId'];
$userName = $rowUserId['name'];

$sql="SELECT * FROM events WHERE url='$url'";
$result=mysqli_query($conn, $sql);
if($result!=NULL){
    $array = array();
    while($row=mysqli_fetch_assoc($result)){
         $array[]=$row;
    }
}

if($array[0]['declineReply']!=""){
    $sql="UPDATE events SET viewedNotification='1' WHERE url='$url'";
    $result=mysqli_query($conn, $sql);
}

//Query to select number of new messages
$sql="SELECT * FROM events WHERE userId='$userId' AND declineReply IS NOT NULL AND viewedNotification IS NULL";
$result=mysqli_query($conn, $sql);
$array3=array();
while($row=$result->fetch_array()){
         $array3[]=$row;
}
$data=mysqli_num_rows($result);

$resourcePersonArray=explode(',', $array[0]['resourceName']);
$resourceDesignationArray=explode(',', $array[0]['resourceDesignation']);
$noOfResource=count($resourcePersonArray);

$arrayOfMediaLoc=explode(",", $array[0]['media']);
$sizeOfArray=count($arrayOfMediaLoc);

mysqli_close($conn);
?>

<!DOCTYPE HTML>

<html>
<head>
    <!-- Meta Data -->
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    
    <!-- Bootstrap -->
	<link href="../../assets/css/bootstrap.min.css" rel="stylesheet">	
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- My CSS -->  
	
	<title>Event Details</title>
</head>
    <body>
       
<!-- Navbar starts -->  
<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" href="../home.php"><i class="fas fa-home"></i>   Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="../allEvents.php"><i class="fas fa-calendar-alt"></i>   All Events</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle">       <?php echo $userName; ?></i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="../profile.php"><i class="fas fa-user-alt"></i>   My Profile</a>
        <a class="dropdown-item" href="../../logout.php"><i class="fas fa-sign-out-alt"></i>   Logout</a>
      </div>
    </li>
  </ul>
</nav>
<!-- Navbar ends -->   
        
        <div class="container">
            
          <div class="jumbotron">
            <h1><?php echo $array[0]['name']; ?></h1>
            <h3><?php echo $array[0]['category']; ?></h3> <br/>
            <h5 style="text-align:right;"><?php echo $array[0]['date']; ?></h5>
          </div>
          
          <?php 
           if($array[0]['approvalStatus']==-1){
          ?>
           <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-danger">
              The event submission is rejected.
              <?php 
                if($array[0]['declineReply']!=""){
              ?>
                  <h5>The Information Officer says:</h5>
                  <?php echo $array[0]['declineReply']; ?>
                  <br/>              
              <?php 
                }
              ?>
              <a href="../editEvent.php/?url=<?php echo $array[0]['url']; ?>"><button type="button" class="btn btn-outline-primary">Edit</button></a>     
              <a href="../deleteEvent.php?url=<?php echo $array[0]['url']; ?>"><button type="button" class="btn btn-outline-danger">Delete</button></a>
            </div>
          <?php 
           }
          ?>
          
          <?php 
           if($array[0]['approvalStatus']==NULL){
          ?>
           <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-primary">
              The event submission is pending my approval.
            </div>
          <?php 
           }
          ?>
            
          <div class="row">
            <div class="col-sm-4">
              <h3>Department</h3>
              <p><?php echo $array[0]['department']; ?></p>
            </div>
              
            <div class="col-sm-4">
              <h3>Incharge</h3>
              <p><?php echo $array[0]['incharge']; ?></p>
              <br/><br/>
            </div>
              
            <div class="col-sm-4">
              <h3>Event Type</h3>
              <p><?php echo $array[0]['type']; ?></p>
            </div>
            
            <div>
              <br/><br/><br/><br/><br/><br/>
            </div>
            
            <div class="col-sm-4">
              <h3>Date</h3>
                <p><?php echo $array[0]['date']; ?></p>
            </div>
              
            <div class="col-sm-4">
              <h3>Event for</h3>
              <p><?php echo $array[0]['eventFor']; ?></p>
            </div>
              
            <div class="col-sm-4">
              <h3>Attendees</h3>
              <p><?php echo $array[0]['attendees']; ?></p>
            </div>
              
            <div>
              <br/><br/><br/><br/><br/><br/>
            </div>            
              
            <div class="col-sm-12">
              <h3>Description</h3>
              <p><?php echo $array[0]['eventDescribe']; ?>
              </p>
            </div>
            
            <div>
              <br/><br/><br/><br/><br/><br/>
            </div>
              
            <div class="col-sm-12">
              <h3>Achievements</h3>
              <p>
                <?php echo $array[0]['achievements']; ?>
              </p>
            </div>
            
            <div>
              <br/><br/><br/><br/><br/><br/>
            </div>   
             
            <div class="col-sm-6">
              <h3>Resource person(s)</h3>
              <table class="table table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th>Name</th>
                    <th>Designation</th>
                  </tr>
                </thead>
                <tbody>
                 <?php
                    for($i=0; $i<$noOfResource; $i=$i+1){
                 ?>
                        <tr>
                            <td><?php echo $resourcePersonArray[$i]; ?></td>
                            <td><?php echo $resourceDesignationArray[$i]; ?></td>
                        </tr>
                 <?php
                    }
                 ?>
                </tbody>
                </table>
            </div>
              
            <div>
              <br/><br/><br/><br/><br/><br/><br/><br/>
            </div>
              
            <div class="col-sm-12">
              <h3>Media Location</h3>
              <?php 
                if($array[0]['approvalStatus']==1){
                    for($i=0; $i<$sizeOfArray; $i=$i+1){
              ?>
                        <p>pathToMedia/<?php echo $arrayOfMediaLoc[$i] ?></p>
              <?php 
                    }
                }else{
                    for($i=0; $i<$sizeOfArray; $i=$i+1){
              ?>
                      <p>pathToTempMedia/<?php echo $arrayOfMediaLoc[$i] ?></p>
              <?php 
                    }
                }
              ?>         
              <br/><br/>
            </div>
              
            <div>
              <br/><br/><br/><br/><br/><br/>
            </div>
              
            <div>
              <br/><br/><br/><br/><br/><br/>
            </div>
            
            <div class="col-sm-4">              
              <?php 
                if($array[0]['approvalStatus']==1){
              ?>
               <h3>Approval Status</h3>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-success">
                    The event submission is approved.
                </div>
              <?php 
                }
              ?>
            </div>
              
            <div>
              <br/>
            </div>
            
          </div>
        </div>
        
        <!--Load scripts-->        
        <!-- Ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        
        <!--Bootstrap-->
        <script src="../assets/js/bootstrap.min.js"></script>  
    
    </body>
    
</html>