<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Load Composer's autoloader
require 'vendor/autoload.php';


include("config/config.php");


$id = $_POST['id'];
//$complain_id=$_POST['complainid'];
$query = mysqli_query($con, "SELECT * FROM cancelcomplain WHERE id='$id'");
$row = mysqli_fetch_array($query);
//$dep = mysqli_query($con, "SELECT email from user where usertype='Department' and username='$dp'");

$body = $row['description'];
$file_path = $row['complainimg'];
$mail_to = $_POST['mail_to'];
$department = $row['Departmentname'];
$sender = $row['complainant'];
$sender_mail = $row['complainantmail'];
$building = $row['building'];
$location = $row['location'];
$complain_id = $row['complain_id'];


$msg = "<strong>Complain ID:</strong> " . $complain_id . "<br>
<strong>Department:</strong> " . $department . "<br>
<strong>Building:</strong> " . $building . "<br>
<strong>Location:</strong> " . $location . "<br>
<strong>Description:</strong> " . $body . "<br>
<strong>Sender Name:</strong> " . $sender . "<br>
<strong>Sender Email:</strong> " . $sender_mail;
//$department= $_POST['department'];
//$location = $_POST['location'];
//$building = $_POST['building'];

//$query = mysqli_query($con,"INSERT into complain(description,complainimg,Departmentname,status,complainant,complainantmail,building,location) values('$body','$file_path','$department','pending','$name','$email','$building','$location')");
//echo '<script>  swal("Your complain successfully submitted"); </script>';

//echo '"<script>".$body.'"
//      </script>"';

//"body='.$body.'&attachment='.$file_path.'&deptmail='.$dptmail.'&department='.$department.'&location='.$location.'&building="+build,

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 1;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = $usermailid;                     // SMTP username
    $mail->Password = $usermailpass;                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($usermailid, $mailusername);
    //$mail->addAddress("9833saurabhtiwari@gmail.com");

    $mails = explode(",", $mail_to);
    $len = 0;
    while ($len != sizeof($mails)) {

        $mail->addAddress($mails[$len]);// Add a recipient
        $len = $len + 1;
    }

    // Attachments
    if (!empty($file_path)) {
        $mail->addAttachment($file_path);
    }         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    //$var=$_POST['body'];
    //$var='Test';//$_POST['body'];
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Cancelled Complain id ' . $id;
    $mail->Body = $msg;
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}