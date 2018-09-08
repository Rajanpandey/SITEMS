<?php
include('session.php');
if(!isset($_SESSION['login_user'])){
    header("location: index.php");
}
?>

<?php
$conn=mysqli_connect("localhost", "root", "", "sitems");

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$url=$_GET["url"]; 

if(substr($_SERVER['HTTP_REFERER'], -8)=='home.php'){
    $sql="UPDATE events SET viewedNotification='1' WHERE url='$url'";
    $result=mysqli_query($conn, $sql);
}


//Query to select the user
$sqlUserId="SELECT type FROM users WHERE email='$login_session'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$rowUserId=mysqli_fetch_assoc($resultUserId);
$userType = $rowUserId['type'];

$sql="SELECT * FROM events WHERE url='$url'";
$result=mysqli_query($conn, $sql);
if($result!=NULL){
    $array = array();
    while($row=mysqli_fetch_assoc($result)){
         $array[]=$row;
    }
}

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
	
	<title>Event Details</title>
</head>
    <body>
        
        <div class="container">
            
          <div class="jumbotron">
            <h1><?php echo $array[0]['name']; ?></h1>
            <h3><?php echo $array[0]['category']; ?></h3> <br/>
            <h5 style="text-align:right;"><?php echo $array[0]['date']; ?></h5>
          </div>
          
          <?php 
           if($array[0]['approvalStatus']==-1 && $userType=="faculty"){
          ?>
           <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-danger">
              The event submission is rejected.
              <?php 
                if($array[0]['declineReply']!=""){
              ?>
                  <h5>The Information Officer says:</h5>
                  <?php echo $array[0]['declineReply']; ?> 
              <?php 
                }
              ?>
            </div>
          <?php 
           }
          ?>
          
          <?php 
           if($array[0]['approvalStatus']==NULL && $userType=="faculty"){
          ?>
           <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-primary">
              The event submission is pending approval.
            </div>
          <?php 
           }
          ?>
           
          <?php 
           if($array[0]['approvalStatus']==NULL && $userType=="informationOfficer"){
          ?>
           <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-primary">
              The event submission is pending approval.
              <?php 
                if($array[0]['declineReply']!=""){
              ?>
                  <h5>The Information Officer says:</h5>
                  <?php echo $array[0]['declineReply']; ?> 
              <?php 
                }
              ?>
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
              
            <div class="col-sm-12">
              <h3>Media Location</h3>
              <?php 
                if($array[0]['approvalStatus']==1){
              ?>
               <p>pathToMedia/<?php echo $array[0]['url']; ?></p>
              <?php 
               }else{
              ?>   
               <p>pathToTempMedia/<?php echo $array[0]['url']; ?></p>
              <?php 
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
              <br/><br/><br/><br/><br/><br/>
            </div>
            
          </div>
        </div>
        
        <!--Load scripts-->        
        <!-- Ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        
        <!--Bootstrap-->
        <script src="assets/js/bootstrap.min.js"></script>  
    
    </body>
    
</html>