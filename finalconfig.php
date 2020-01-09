<?php
session_start();
require_once "vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("1085777605069-2qss1bn1n04qpq0t8ip51o8ulkh1gdte.apps.googleusercontent.com");
$gClient->setClientSecret("7zl4QM3DSyB7SdfzyvRbclE1");
$gClient->setApplicationName("ComplainBox");
$gClient->setRedirectUri("http://localhost/complainbox/g-callback.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
$con = new mysqli('localhost', 'root', '', 'complainbox');
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>