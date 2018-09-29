<?php
//Get the Email from the DB
require('connect.php');
if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$email=mysqli_real_escape_string($conn,trim($_POST['email']));
    
$sql="SELECT password FROM users WHERE email='$email'";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)==0){
    echo "<script type=\"text/javascript\">
    alert('Invalid EMail ID. Please Try Again.');
    window.location='forgotPassword.php';
    </script>";
}

$password = $row['password'];
mysqli_close($conn);


//CODE to send mail
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = getenv('MAIL');                 // SMTP username
    $mail->Password = getenv('PASS');                            // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('noreply@sitems.com', 'SITEMS');
    $mail->addAddress($email);     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Password for SITEMS';
    $mail->Body    = 'Your Password is: '.$password.'';

    $mail->send();
    echo "<script type=\"text/javascript\">
    alert('Password has been sent to your EMail ID!');
    window.location='index.php';
    </script>";
} catch (Exception $e) {
    echo 'Password could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>