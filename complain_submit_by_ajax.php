<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Load Composer's autoloader
require 'vendor/autoload.php';


include("config/config.php");


$id = $_POST['id'];
$query = mysqli_query($con, "SELECT * FROM complain WHERE id='$id'");
$row = mysqli_fetch_array($query);

$body = $row['description'];
$file_path = $row['complainimg'];
$mail_by = $_POST['mail_by'];
$department = $row['Departmentname'];
$sender = $row['complainant'];
$sender_mail = $row['complainantmail'];
$building = $row['building'];
$location = $row['location'];

$user_query = mysqli_query($con, "SELECT name FROM user where email='$mail_by'");
$row5 = mysqli_fetch_array($user_query);

$msg = "<strong>Dear " . $_SESSION['name'] . ",</strong><br>
Thank you, Your complain is registered.<br> Your complain details are<br>
<strong>Complain ID: </strong>" . $id . "<br> 
<strong>Area of Working:</strong> " . $department . "<br>
<strong>Building:</strong> " . $building . "<br>
<strong>Location:</strong> " . $location . "<br>
<strong>Description:</strong> " . $body . "<br><br>
<hr>
<strong>Note:</strong><br>
<font color='blue'>This is an automated system generated mail.</font><br>
<font color='red'>Do not reply to this email.</font>
";


/*
Dear (name of user),
Thank you, Your complain is registered. Your complain details are 
Complain ID:
Area of Working:
Building/Area:
Location:
Description:
__________
Note:
This is an automated system generated mail.
Do not reply to this email.

*/
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
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also 
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($usermailid, $mailusername);
    //$mail->addAddress("9833saurabhtiwari@gmail.com");
    $mail->addAddress($mail_by);     // Add a recipient

    // Attachments
    //        // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    //$var=$_POST['body'];
    //$var='Test';//$_POST['body'];

    if ($file_path != "") {
        $mail->addAttachment($file_path);
    }


    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Complain Registered Successfully with id  ' . $id;
    $mail->Body = $msg;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
