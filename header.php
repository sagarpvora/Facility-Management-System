<?php
include("config/config.php");

$name = $_SESSION['name'];
$email = $_SESSION['email'];
$img = $_SESSION['imgurl'];

?>


<!DOCTYPE html>
<html>
<head>

    <title> F M S S </title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>

    <script src="assets/js/bootbox.js"></script>
    <script src="assets/js/jquery.Jcrop.js"></script>
    <script src="assets/js/jcrop_bits.js"></script>
    <script src="assets/js/upload.js"></script>


    <!-- css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="assets/css/jquery.Jcrop.css">

</head>

<body>
<!--<div class="container">
     <ul class="progressbar">
         <li class="active">login</li>
         <li>choose interest</li>
         <li>add friends</li>
         <li>View map</li>
 </ul>
-->
<div class="top_bar">
    <div class="logo">
        <a href="index.php">COMPLAIN<strong>BOX</strong></a>
    </div>

    <nav>

        <a href='' class="login_name">
            <?php echo $name; ?>
        </a>

        <a href="#">
            <i class="fa fa-home fa-2x"></i>
        </a>
        <a href="#">
            <i class="fa fa-envelope fa-2x"></i>
        </a>
        <a href="#">
            <i class="fa fa-bell fa-2x"></i>
        </a>
        <a href="#">
            <i class="fa fa-info-circle fa-2x"></i>

        </a>
        <a href="#">
            <i class="fa fa-cog fa-2x"></i>
        </a>
        <a href="index.php" onclick="signOut">
            <i class="fa fa-sign-out fa-2x"></i>
        </a>
    </nav>


</div>
