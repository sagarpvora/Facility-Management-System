<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Load Composer's autoloader
require 'vendor/autoload.php';


include("config/config.php");


$id = $_POST['id'];
$dp = $_POST['department'];
$dep = mysqli_query($con, "SELECT email from user where usertype='Department' and username='$dp'");
$query = mysqli_query($con, "SELECT * FROM complain WHERE id='$id'");
$row = mysqli_fetch_array($query);


$body = $row['description'];
$file_path = $row['complainimg'];
$department = $row['Departmentname'];
$sender = $row['complainant'];
$sender_mail = $row['complainantmail'];
$building = $row['building'];
$location = $row['location'];
$contact = $row['contactnum'];
$priority = $row['priority'];

$msg = "Dear Sir/Ma'am,<br>
<b>Complain is assign for " . $dp . " area of work</b><br>
Complain details are,<br>
<strong>Complain ID:</strong> " . $id . "<br>
<strong>Building:</strong> " . $building . "<br>
<strong>Location:</strong> " . $location . "<br>
<strong>Description:</strong> " . $body . "<br>
<strong>Sender Name:</strong> " . $sender . "<br>
<strong>Sender Email:</strong> " . $sender_mail . "<br>
<strong>Contact Number:</strong>" . $contact . "<br><br><br>
<hr>
<strong>Note:</strong><br>
<font color='blue'>This is an automated system generated mail.</font><br>
<font color='red'>Do not reply to this email.</font>
";
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
//
//    $mails = explode(",", $dep);
//    $len = 0;
//    while ($len != sizeof($mails)) {
//
//        $mail->addAddress($mails[$len]);
//        $len = $len + 1;
//    }
    while ($row = mysqli_fetch_array($dep)) {
        $email = $row['email'];
        $mail->addAddress($email);
    }

    if ($priority == 'critical') {
//        echo "<script>alert('hello');</script>";
        $q = mysqli_query($con, "SELECT  email from user where usertype='admin' or usertype='Manager'");
        while ($row = mysqli_fetch_array($q)) {
            $mails = explode(",", $row['email']);
            $len = 0;
            while ($len != sizeof($mails)) {
                $mail->addAddress($mails[$len]);
                $len = $len + 1;
            }

        }

    }

    // Add a recipient

    // Attachments
    if (!empty($file_path)) {
        $mail->addAttachment($file_path);
    }     // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    //$var=$_POST['body'];
    //$var='Test';//$_POST['body'];
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Complain Assign  id  ' . $id;
    $mail->Body = $msg;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}