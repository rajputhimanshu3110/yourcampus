<?php include '../functions.php';
include 'db.php';
ob_start();
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if (isset($_POST['usermail'])) {
    $name = $_POST['name'];
    $email = $_POST['usermail'];
    $cmail = $_POST['cmail'];
    $role = $_POST['role'];
    $pos = $_POST['pos'];
    $batch = $_POST['batch'];
    $token = registerHash($cmail);
    $url = 'https://mail.hostinger.com/';


$body1 ='<div style="color:Gray;font-family: Times New Roman;position: absolute;
  left:30%;
  right: 30%;
  border: 1px solid #bbbb77;
  padding: 20px 30px;
  line-height: 1.6;
  text-align: justify;"> 
  Hi <strong>'.$name.'</strong>,


  <p >Were haapy to invite you in YourCampus Team Portal as Member. To Start Your Work on Portal please generate your password.</p>

  <p >Your New Mail is '.$cmail.'.</p>

  <p >Your Mail Password is Welcome@123.</p>
  <p>You Can use to log into <a href='.$url.'>Hostinger Mail </a></p>

  <p>and generate password by below Link.</p>

  <a href="generatePassword.php?token='.$token.'" style="background-color: #4CAF50; /* Green */
    
    
    border-radius: 30px;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;">Generate Password</a>

  <br>

  <p>Welcome to YFarmerPC</p>


  <p>&copy; 2022 YFarmerPC</p>
</div>';


//Import PHPMailer classes into the global namespace


//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'no-reply@yourcampus.tk';                     //SMTP username
    $mail->Password   = 'Welcome@123';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('no-reply@yourcampus.tk', 'YourCampus');
    $mail->addAddress($email, $name);     //Add a recipient
    
    $mail->addReplyTo('support@yourcampus.tk', 'Support Team');

    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Welcome to YourCampus';
    $mail->Body    = $body1;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    
    if ($mail->send()) {
        register_team($name,$cmail,$role,$batch,$pos);
        
        header("Location:../employee.php");
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}