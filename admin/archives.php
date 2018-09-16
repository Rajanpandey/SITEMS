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

//Query to select unqiue archive names
$sql="SELECT DISTINCT archive FROM events WHERE archive IS NOT NULL";
$result=mysqli_query($conn, $sql);
if($result!=NULL){
    $array = array();
    while($row=mysqli_fetch_assoc($result)){
         $array[]=$row;
    }
}
$totalArchives=mysqli_num_rows($result);

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
	<link rel="stylesheet" href="../assets/mycss/sitLogo.css">
	<link rel="stylesheet" href="../assets/mycss/search.css">
	
	<title>Archives</title>
</head>

<body>

<!-- Navbar starts -->  
<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link" href="home.php"><i class="fas fa-home"></i>   Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="allUsers.php"><i class="fas fa-users"></i>   All Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="allEvents.php"><i class="fas fa-calendar-alt"></i>   All Events</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled"><i class="fas fa-archive"></i>   Archives</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
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
            <center><img class="logo" src="../assets/img/sitLogo.png"></center><hr/>      
        </div>   
    </div>        
</div>    
        
<div class="container">
    <div class="row">
        <div class="col-12">
         <h3>Archive Event Data:</h3>
         <form class="form-inline" action="archiveEvents.php" method="post">
           <div class="form-group">
             <label for="name" title="Eg: Year 2016-17">Name of the Archive:&nbsp;&nbsp;&nbsp;&nbsp;</label>
             <input type="text" class="form-control" id="name" name="name" title="Eg: Year 2016-17" required>
           </div>
           <div class="form-group">
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="from">Archive from:&nbsp;&nbsp;&nbsp;&nbsp;</label>
             <input type="date" class="form-control" id="from" name="from" required>
           </div>
           <div class="form-group">
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="to">Archive to:&nbsp;&nbsp;&nbsp;&nbsp;</label>
             <input type="date" class="form-control" id="to" name="to" required>
           </div><br/><br/><br/><br/>
           <button type="submit" class="btn btn-outline-danger btn-block">Archive data falling in the range mentioned above</button>
         </form><hr/>     
        </div>   
    </div>        
</div>  
        
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h3>List of Archives:</h3><br/>
        </div>   
    </div>        
</div> 
<div class="container">
    <div class="row">
      <?php
       if($totalArchives==0){
      ?>
       <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 alert alert-info">
          No archives yet!
        </div> 
      <?php
       }else{
           for($i=0; $i<$totalArchives; $i=$i+1){
      ?>
       <div class="col-4">
          <a href="archivedEvents.php/?archive=<?php echo $array[$i]['archive']; ?>">
              <button class="btn btn-outline-primary btn-block"> <?php echo $array[$i]['archive']; ?> </button>
          </a>
        </div>  
      <?php 
           }
       }    
      ?>
    </div>        
</div> 
        
         



<!-- Ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>  

<!-- Bootstrap -->
<script src="../assets/js/bootstrap.min.js"></script>

<script>  

 </script> 
</body>