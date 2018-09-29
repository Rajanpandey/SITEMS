<?php
session_start(); 
require('connect.php');

    $email=mysqli_real_escape_string($conn,trim($_POST['email']));
    $password=mysqli_real_escape_string($conn,trim($_POST['password']));

    if (!strpos($email, '@')) {
        $email=$email.'@sitpune.edu.in';
    }    
    
    $query = "SELECT email, password, type FROM users WHERE email=? AND password=? LIMIT 1";      

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $stmt->bind_result($email, $password);
    $stmt->store_result();

    if($stmt->fetch()){
        $sql="SELECT type FROM users WHERE email='$email'"; 
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
            
        $_SESSION['login_user'] = $email;
        $_SESSION['user_type'] = $row['type'];
        echo $array[0]['type'];
        
        if(!empty($_POST["remember"])) {
            setcookie ("member_email", $email, time()+ (10 * 365 * 24 * 60 * 60));
            setcookie ("member_password", $password, time()+ (10 * 365 * 24 * 60 * 60));
		} else {
            if(isset($_COOKIE["member_email"])) {
                setcookie ("member_email","");
            }
            if(isset($_COOKIE["member_password"])) {
                setcookie ("member_password","");
            }
		}
        
        if($row['type']=='admin'){
            header("location: admin/home.php"); 
        }
        if($row['type']=='informationOfficer'){
            header("location: informationOfficer/home.php"); 
        }
        if($row['type']=='faculty'){
            header("location: faculty/home.php"); 
        }
        
    }

    mysqli_close($conn);

?>
