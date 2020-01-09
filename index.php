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


<!-- META for preview-->
<!-- Primary Meta Tags -->
<title>FACILITY MANAGEMENT SERVICE SOFTWARE |  KJSCE
</title>
<meta name="title" content="FACILITY MANAGEMENT SERVICE SOFTWARE |  KJSCE
">
<meta name="description" content="One-Step Solution
A portal for all your complaints, Focus on complaining about the problem you have, rather than staying with the issue.">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="http://lms-kjsce.somaiya.edu/fmss">
<meta property="og:title" content="FACILITY MANAGEMENT SERVICE SOFTWARE |  KJSCE
">
<meta property="og:description" content="One-Step Solution
A portal for all your complaints, Focus on complaining about the problem you have, rather than staying with the issue.">
<meta property="og:image" content="./assets/img/ee.png">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="http://lms-kjsce.somaiya.edu/fmss">
<meta property="twitter:title" content="FACILITY MANAGEMENT SERVICE SOFTWARE |  KJSCE
">
<meta property="twitter:description" content="One-Step Solution
A portal for all your complaints, Focus on complaining about the problem you have, rather than staying with the issue.">
<meta property="twitter:image" content="./assets/img/ee.png">


 
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


<div class="page-header header-filter" data-parallax="true" style="background-image: url('assets/img/slider1.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title">FACILITY MANAGEMENT SERVICE SOFTWARE</h2>
                <h2 class="title"> One Step Solution</h2>
                <h4>A portal for all your complaints, Focus on complaining about the<br> problem you have, rather than
                    staying with the issue.</h4>
                <br>
                <h4><b>Login in with Somaiya Mail</b></h4>
                <div class="row">
                    <div class="col-md-12">

                        <div id="my-signin1" onclick="ClickLogin()" data-onsuccess="onSignIn"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="title">Untold Suffering is not wise.</h2>
                    <h5 class="description">

                        Tell us about the complaints you have and we will look after it. Be it any department , Be it
                        any smallest to biggest complaint you have just tell us and sit back relaxed , we will resolve
                        it as soon as possible.

                    </h5>
                </div>
            </div>
            <div class="features">

                <div class="row">
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-danger">
                                <i class="material-icons">domain</i>
                            </div>
                            <h4 class="info-title">Anyone can complaint</h4>
                            <p>
                                If you are in somaiya vidyavihar then just login into complain box using somaiya mail
                                and register your complain online.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-success">
                                <i class="material-icons">supervisor_account</i>
                            </div>
                            <h4 class="info-title">Connect to Supervisor </h4>
                            <p>
                                Submit your complain direct to supervisor, Just select Department we will submit your
                                complain to respective supervisor
                                .</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info">
                            <div class="icon icon-info">
                                <i class="material-icons">schedule</i>
                            </div>
                            <h4 class="info-title">Use at Any time</h4>
                            <p>
                                If you have any complain register your complain at any time any day no mater if it is
                                holiday or evening we will forward your complain.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--          <div class="page-header header-filter"
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
                                                  <br>
                                                  <br>

                                                  <p><b>Login Using Somaiya Mail</b></p>
                                                  <div class="row">
                                                      <div class="col-md-12">
                                                          <center>
                                                              <div id="my-signin1" onclick="ClickLogin()" data-onsuccess="onSignIn"></div>
                                                          </center>
                                                      </div>
                                                  </div>

                                              </div>

                                      </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
          -->

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

                var clicked = false;

                function ClickLogin() {
                    clicked = true;
                }

                function onSuccess(googleUser) {

                    $('#my-signin1 div div span span:last').text("Sign in");
                    if (clicked) {
                        $('#my-signin1 div div span span:last').text("Signed In");
                        var profile = googleUser.getBasicProfile();
                        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
                        console.log('Name: ' + profile.getName());
                        console.log('Image URL: ' + profile.getImageUrl());
                        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.

                        if (profile) {
                            $.ajax({
                                type: 'POST',
                                url: 'verifyuser.php',
                                data: {
                                    id: profile.getId(),
                                    name: profile.getName(),
                                    email: profile.getEmail(),
                                    imgurl: profile.getImageUrl()
                                }
                            }).done(function (usertype) {
                                console.log(usertype);


                                if (usertype == "Department") {
                                    console.log("In dept");
                                    window.location.href = 'depthome.php';
                                } else if (usertype == "admin") {
                                    console.log("Admin");
                                    window.location.href = 'admindashboard.php';
                                } else if (usertype == "Manager") {
                                    console.log("In Manager");
                                    window.location.href = 'managerdashboard.php';
                                } else if (usertype == "User") {
                                    console.log("In user");
                                    window.location.href = 'dashboard.php';
                                } else if (usertype == "Firstuser") {
                                    console.log("In first user");
                                    window.location.href = 'dashboard.php';
                                }

                                //window.location.href = 'dashboard.php';

                            }).fail(function () {
                                alert("Error occur. Try again later");
                            });
                        }
                    }
                }

                function onFailure(error) {
                    console.log(error);

                }

                function renderButton() {

                    gapi.signin2.render('my-signin1', {
                        'scope': 'profile email',
                        'width': 240,
                        'height': 50,
                        'longtitle': false,
                        'theme': 'dark',
                        'prompt': 'select_account',
                        'onsuccess': onSuccess,
                        'onfailure': onFailure
                    });
                }
            </script>
            <script>
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
