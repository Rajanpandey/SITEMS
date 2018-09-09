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

//Query to select events awaiting approval
$sql="SELECT * FROM events WHERE approvalStatus IS NULL ORDER BY date DESC";
$result=mysqli_query($conn, $sql);
if($result!=NULL){
    $array1 = array();
    while($row=mysqli_fetch_assoc($result)){
         $array1[]=$row;
    }
}
$totalUnapprovedEvents=mysqli_num_rows($result);

//Query to select events that are approved
$start_from=($page-1)*$num_rec_per_page; 
$sql="SELECT * FROM events WHERE userId='$userId' AND approvalStatus='1' ORDER BY date DESC LIMIT $start_from, $num_rec_per_page";
$result=mysqli_query($conn, $sql);
$array2=array();
while($row=$result->fetch_array()){
         $array2[]=$row;
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
	<link rel="stylesheet" href="../assets/mycss/facultyHome.css">
	
	<title>Information Officer Home</title>
</head>

<body>

<!-- Navbar starts -->  
<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
  <ul class="navbar-nav">
   <li class="nav-item">
      <a class="nav-link disabled"><i class="fas fa-home"></i>   Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="allUsers.php"><i class="fas fa-users"></i>   All Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link"  href="allEvents.php"><i class="fas fa-calendar-alt"></i>   All Events</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle">       Profile</i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="../profile.php?u=<?php echo $userId; ?>"><i class="fas fa-user-alt"></i>   My Profile</a>
        <a class="dropdown-item" href="../logout.php"><i class="fas fa-sign-out-alt"></i>   Logout</a>
      </div>
    </li>
  </ul>
</nav>
<!-- Navbar ends -->  

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <center><img class="logo" src="../assets/img/sitLogo.png"></center><hr/><br/><br/><br/><br/><br/><br/><br/><br/>          
        </div>        
        
        <div class="col-6">            
            <center><a href="allUsers.php"><i class="fas fa-users fa-5x"></i><br/>Manage Users</a></center><br/><br/><br/><br/>    
        </div>
           
        <div class="col-6">
            <center><a href="allEvents.php"><i class="fas fa-calendar-alt fa-5x"></i><br/>Manage Events</a></center>
        </div>        
        </div>
        
    </div>

<!-- Ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>  

<!-- Bootstrap -->
<script src="../assets/js/bootstrap.min.js"></script>

<script>  
 $(document).ready(function(){  
      $(document).on('click', '.column_sort', function(){  
           var column_name = $(this).attr("id");  
           var order = $(this).data("order");  
           var arrow = ''; 
           if(order == 'desc')  
           {  
                arrow = '&nbsp;<i class="fa fa-chevron-down" aria-hidden="true"></i>';  
           }  
           else  
           {  
                arrow = '&nbsp;<i class="fa fa-chevron-up" aria-hidden="true"></i>';  
           }  
           $.ajax({  
                url:"sortColumns.php",  
                method:"POST",  
                data:{column_name:column_name, order:order},  
                success:function(data)  
                {  
                     $('#eventsTable').html(data);  
                     $('#'+column_name+'').append(arrow);  
                }  
           })  
      });  
 });
 </script> 
</body>