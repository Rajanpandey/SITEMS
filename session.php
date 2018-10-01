<?php
require('connect.php');
session_start();

if(isset($_SESSION['login_user'])){ 
    $email = $_SESSION['login_user'];
    
    $query = "SELECT email FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();    
    
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $login_session = $row['email'];
    }    
}
?>
