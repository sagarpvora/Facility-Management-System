<?php
require_once "finalconfig.php";
if (isset($_SESSION['access_token']))
    $gClient->setAccessToken($_SESSION['access_token']);
else if (isset($_GET['code'])) {
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['access_token'] = $token;
} else {
    header('Location: index.php');
    exit();
}
$oAuth = new Google_Service_Oauth2($gClient);
$userData = $oAuth->userinfo_v2_me->get();
$_SESSION['id'] = $userData['id'];
$_SESSION['email'] = $userData['email'];
$_SESSION['gender'] = $userData['gender'];
$_SESSION['imgurl'] = $userData['picture'];
$_SESSION['familyName'] = $userData['familyName'];
$_SESSION['name'] = $userData['givenName'] . " " . $userData['familyName'];


$sqlque = "select * from users where email='" . $userData['email'] . "'";
$res_u = mysqli_query($con, $sqlque);

if (mysqli_num_rows($res_u) > 0) {
    header('Location: dashboard.php');
    exit();
} else {
    $sql = "insert into users (name,email,google_id,imgurl) values
 ('" . $userData['givenName'] . " " . $userData['familyName'] . "','" . $userData['email'] . "',
 '" . $userData['id'] . "','" . $userData['picture'] . "')";
    mysqli_query($con, $sql);
    header('Location: password.php');
    exit();
}
?>