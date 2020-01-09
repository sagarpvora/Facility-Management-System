<?php
include("config/config.php");
if (isset($_SESSION['type'])) {

    if ($_SESSION['type'] == 'admin') {
        header("Location: admindashboard.php");
        exit();
    } else if ($_SESSION['type'] == 'Manager') {
        header("Location: managerdashboard.php");
        exit();
    } else if ($_SESSION['type'] == 'Department') {
        header("Location: depthome.php");
        exit();
    } else {
        header("Location: dashboard.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!--Change api key here-->
    <meta name="google-signin-client_id"
          content="1085777605069-2qss1bn1n04qpq0t8ip51o8ulkh1gdte.apps.googleusercontent.com">

    <title> F M S S </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-kit.css" rel="stylesheet"/>

</head>

<body class="landing-page sidebar-collapse">
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">

            <div class="page-header header-filter"
                 style="background-image: url('assets/img/cam.jpg'); background-size: cover; background-position: top center;">
                <div class="container">
                    <div class="row" id="login">
                        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                            <div class="card card-login">
                                <form class="form" method="post" action="logindb.php">
                                    <div class="card-header card-header-primary text-center" style="margin:0;">
                                        <h4 class="card-title" style="font-size:">Login </h4>
                                        <div class="social-line">

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <br>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                  <i class="material-icons">perm_identity</i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="username"
                                                   placeholder="Username..." required="true">
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                  <i class="material-icons">lock_outline</i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control" name="password"
                                                   placeholder="Password..." required="true">
                                        </div>


                                    </div>

                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-primary">Login
                                        </button>
                                    </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include("footer.php");
        ?>
        <!--   Core JS Files   -->
        <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
        <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
        <script src="assets/js/plugins/moment.min.js"></script>


        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

        <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
        <script src="assets/js/material-kit.js" type="text/javascript"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
        <script>

            <
            script >
            $(document).ready(function () {
                // Add smooth scrolling to all links
                $("a").on('click', function (event) {

                    // Make sure this.hash has a value before overriding default behavior
                    if (this.hash !== "") {
                        // Prevent default anchor click behavior
                        event.preventDefault();

                        // Store hash
                        var hash = this.hash;

                        // Using jQuery's animate() method to add smooth page scroll
                        // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                        $('html, body').animate({
                            scrollTop: $(hash).offset().top - 100
                        }, 1000, function () {

                            // Add hash (#) to URL when done scrolling (default click behavior)
                            window.location.hash = hash;
                        });
                    } // End if
                });
            });
        </script>

</body>

</html>
