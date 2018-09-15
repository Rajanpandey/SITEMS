<?php
require('connect.php');
session_start();

if(isset($_SESSION['login_user'])){ 
    $user_check = $_SESSION['login_user'];
    $query = "SELECT email FROM users WHERE email='$user_check'";
    $ses_sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($ses_sql);
    $login_session = $row['email'];
}
?>
