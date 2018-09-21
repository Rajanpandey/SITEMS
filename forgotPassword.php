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
            Forgot Password
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
            <h4>Forgot Password:</h4>
            <form action="sendMail.php" method="POST">
              <div class="container">
                <label for="email"><b>Email:</b></label>
                <input type="" class="form-control" placeholder="Enter Email Address" name="email" required value="<?php if(isset($_COOKIE["member_email"])) { echo $_COOKIE["member_email"]; } ?>">
                <p>The password will be sent to your Email ID.</p>   
                
                <button type="submit">SEND PASSWORD</button>                

              </div>
              <div class="container" style="background-color:#f1f1f1">
                <button type="button" class="cancelbtn" onclick="location.href='index.php';">Go Back</button>
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
