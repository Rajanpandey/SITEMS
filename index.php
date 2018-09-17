<?php
include('session.php');

if(isset($_SESSION['login_user'])){    
    if($_SESSION['user_type']=='admin'){
        header("location: admin/home.php");   
    }elseif($_SESSION['user_type']=='informationOfficer'){
        header("location: informationOfficer/home.php");   
    }else{
        header("location: faculty/home.php");   
    }     
} 
?>

<!DOCTYPE HTML>
<html>
    
    <head>
        
        <!-- Meta Data -->
        <meta charset="utf-8">    
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        
        <!-- My CSS -->  
        <link rel="stylesheet" type="text/css" href="assets/mycss/login.css">
        
        <title>
            SIT EMS Login
        </title>
    
    </head>

    <body>
        
        <div class="container">
            
            <br/>
            
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <center><img src="assets/img/sitLogo.png"></center>
                </div>
            </div>
            
            <br/><br/>
            
            <form action="connection.php" method="POST">
              <div class="container">
               
                <label for="email"><b>Email:</b></label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Enter Email Address" aria-label="Enter Email Address" aria-describedby="basic-addon2" name="email" required value="<?php if(isset($_COOKIE["member_email"])) { echo $_COOKIE["member_email"]; } ?>">
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">@sitpune.edu.in</span>
                  </div>
                </div>
                
                <label for="password"><b>Password:</b></label>
                <input type="password" class="form-control" placeholder="Enter Password" name="password" required value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" class="input-field">
                
                <button type="submit">Login</button>
                
                <label>
                  <input type="checkbox" checked="checked" name="remember" value="1"> Remember me
                </label>
                
              </div>
              <div class="container" style="background-color:#f1f1f1">
                <span class="psw"><a href="forgotPassword.php">Forgot Password?</a></span>
              </div>
            </form>
            
        </div>
        
        
        <!--Load scripts-->
        
        <!-- Ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        
        <!--Bootstrap-->
        <script src="assets/js/bootstrap.min.js"></script>
        
        <!-- My JS -->  
        <script src=""></script>
        
    </body>
    
</html>