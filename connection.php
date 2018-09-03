<?php
include('login.php'); 
if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='admin'){
        header("location: admin/home.php");   
    }elseif($_SESSION['user_type']=='informationOfficer'){
        header("location: informationOfficer/home.php");   
    }else{
        header("location: faculty/home.php");   
    }     
}    
else{
    echo "<script type=\"text/javascript\">
    alert('Invalid User Details. Please Try Again.');
    window.location='index.php';
    </script>";
}
    
?> 