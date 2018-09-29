<?php
include('../session.php');
if(!isset($_SESSION['login_user'])){
    header("location: ../index.php");
}
?>

<?php
require('../connect.php');

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$eventId = $_GET["eventId"]; 
$comment=mysqli_real_escape_string($conn,trim($_POST['comment']));
$sql="UPDATE events SET approvalStatus='-1', declineReply='$comment' WHERE eventId='$eventId'";
$result=mysqli_query($conn, $sql);

$sqlUserId="SELECT * FROM events WHERE eventId='$eventId'";
$resultUserId=mysqli_query($conn, $sqlUserId);
$row=mysqli_fetch_assoc($resultUserId);
$userId = $row['userId'];
$eventName = $row['name'];

$sql="SELECT email FROM users WHERE userId='$userId'";
$result=mysqli_query($conn, $sql);
$emailId=mysqli_fetch_assoc($result);
$email = $emailId['email'];


//CODE to send mail
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = getenv('MAIL');                 // SMTP username
    $mail->Password = getenv('PASS');                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('noreply@sitems.com', 'SITEMS');
    $mail->addAddress($email);     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = ''.$eventName.' event has been declined.';
    $mail->Body    = 'Decline comment: '.$comment.'';

    $mail->send();
    echo "<script type=\"text/javascript\">
    alert('Event has been declined and the the faculty has been informed!');
    window.location='../home.php';
    </script>";
} catch (Exception $e) {
    echo 'Email wasnt sent. Mailer Error: ', $mail->ErrorInfo;
}

mysqli_close($conn);
?>