<?php include '../functions.php';
include 'db.php';
ob_start();

if (isset($_GET['did'])) {
    $id = $_GET['did'];
    $query = "DELETE FROM subject WHERE id='$id'";
    $delete = mysqli_query($connection,$query);
    confirmQuery($delete);
    redirect('../review.php');
}
if (isset($_GET['publish'])) {
    $id = $_GET['publish'];
    $query = "UPDATE subject SET status = 'publish' WHERE id='$id'";
    $publish = mysqli_query($connection,$query);
    confirmQuery($publish);
    redirect('../review.php');
}
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_SESSION['name'];


    



$body1 ='Hey Support Team User '.$_SESSION['name'].' Just tried to delete a Subject <a href="https://yourcampus.tk/subject.php?id='.$id.'">View here</a>';


//Import PHPMailer classes into the global namespace


//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                                                 //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'no-reply@yourcampus.tk';                     //SMTP username
    $mail->Password   = 'Welcome@123';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@yourcampus.tk', 'YourCampus');
    $mail->addAddress('support@yourcampus.tk', 'Support');     //Add a recipient
    
    $mail->addReplyTo('support@yourcampus.in', 'Support Team');

    $query ="UPDATE subject SET status='review',del_user ='$name' WHERE id='$id'";
    $res = mysqli_query($connection,$query);
    confirmQuery($res);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Someone Tried Delete';
    $mail->Body    = $body1;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    
    if ($mail->send()) {
        header("Location:../content.php");
    }
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}