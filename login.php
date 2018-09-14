<?php
session_start(); 

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!strpos($email, '@')) {
        $email=$email.'@sitpune.edu.in';
    }
    
    $conn=mysqli_connect("localhost", "root", "", "sitems");
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $array = array();
        
     while($row = mysqli_fetch_assoc($result)){
         $array[] = $row;
     }     

    if($email==$array[0]['email']){
        if($password==$array[0]['password']){
            
            $_SESSION['login_user'] = $email;
            $_SESSION['user_type'] = $array[0]['type'];
            
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
            
            if($array[0]['type']=='admin'){
                header("location: admin/home.php"); 
            }
            if($array[0]['type']=='informationOfficer'){
                header("location: informationOfficer/home.php"); 
            }
            if($array[0]['type']=='faculty'){
                header("location: faculty/home.php"); 
            }
        }
    } 
    mysqli_close($conn);

?>
