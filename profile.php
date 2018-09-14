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

$userId=$_GET["u"]; 

$sql="SELECT * FROM users WHERE userId='$userId'";
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
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">	
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- My CSS -->  
	
	<title>My Profile</title>
</head>
<style>
.posts {
    margin-bottom: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);    
}

.posts:hover {
    -ms-transform: scale(1.02); /* IE 9 */
    -webkit-transform: scale(1.02)); /* Safari 3-8 */
    transform: scale(1.02); 
}
</style>
<body>

<!-- Change Password Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Header Ends -->
        
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="changePassword.php">
           <label for="category">Enter a new password:</label>
           <input type="text" class="form-control" id="password" name="password" value="" required><br/>
                      
           <button type="submit" class="btn btn-outline-primary" name="submit">Change Password</button>               
          </form>
        </div>  
        <!-- Modal body Ends -->  
            
      </div>
    </div>
  </div>
<!-- Change Password Modal Ends -->

<div class="container">
	<div class="row">
        <div class="col-12">
            <br/><br/><br/><br/>
              <center>
                <div class="card posts" style="width:400px">
                  <img src="assets/img/profile.png" style="width:100%">
                  <div class="card-body">
                  <h4 class="card-title"><?php echo $array[0]['name']; ?></h4>
                  <h5 class="card-title"><?php echo $array[0]['type']; ?></h5>
                  <p class="card-text"><?php echo $array[0]['email']; ?></p>
                  <p class="card-text"><?php echo $array[0]['password']; ?></p>
                </div>
               </div>
              </center>       
        </div>
        <div class="col-4"></div>
        <div class="col-4">
            <center><button type="button" class="btn btn-outline-dark btn-block edit" data-toggle="modal" data-target="#myModal">Change Password</button></center>       
        </div>
    </div>
</div>
            
        
<div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>

<br/><br/>
        <!--Load scripts-->        
        <!-- Ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        
        <!--Bootstrap-->
        <script src="assets/js/bootstrap.min.js"></script>  
</body>    
</html>