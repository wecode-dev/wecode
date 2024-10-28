<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST['submit']))
{
    $name= $_POST['name'];
    $email=$_POST['email'];
    //$mobile=$_POST['mobile'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->SMTPAuth   = true;  //Enable SMTP authentication
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        
        $mail->Username   = 'aravindmarshall.tech@gmail.com';                     //SMTP username
        $mail->Password   = 'jvwxcwkfvflkluvw';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        //Recipients
        $mail->setFrom('aravindmarshall.tech@gmail.com', 'Mailer');
        $mail->addAddress('aravindmarshall.tech@gmail.com','funn');     //Add a recipient
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New Enquiry - WeCode Contact Form';
        $mail->Body    = '<h3>Hello, you got a new enquiry from Customer with contact details and Approach -<b>WeCode</b>-
	<br><b>Customer Contact Details</b><br>
        <h4>Name: '.$name.'</h4>
        <h4>Email:'.$email.'</h4>
        //<h4>Mobile:'.$mobile.'</h4>
        <h4>Subject:'.$subject.'</h4>
        <h4>Message:'.$message.'</h4>
    ';
        
        if($mail->send())
        {
            $_SESSION['status']="Thank you for contacting us - WeCode";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
        else{
            $_SESSION['status']="Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else
{
    header('Location: index.html');
    exit(0);
}

?>
