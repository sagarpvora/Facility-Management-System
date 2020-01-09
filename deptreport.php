<?php

include("config/config.php");
//dashboard of admin
require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Load Composer's autoloader
require 'vendor/autoload.php';


//dashboard of department
//$mysqli = new mysqli("localhost", "root", "", "complainbox");
$uname = $_SESSION["name"];

$sqlt = "SELECT name from user WHERE email like '%" . $_SESSION['email'] . "%'";
$result1 = mysqli_query($con, $sqlt);

$row5 = mysqli_fetch_array($result1);
$vname = $row5['name'];

$sqlt = "SELECT name from user WHERE email like '%" . $_SESSION['email'] . "%'";
$result1 = mysqli_query($con, $sqlt);
$deptnamearr = array();
while ($row1 = mysqli_fetch_array($result1)) {
    $deptnamearr[] = $row1['name'];
}

/*
while ($row1 = mysqli_fetch_array($result1)) {
    if (mysqli_num_rows(mysqli_query($con, $sqlt)) > 1) {
        $uname = $uname . $row1["name"] . ',';//set name to department name instead of gmail account name
        $_SESSION["name"] = $uname;
    } else {
        $uname = $row1["name"] . ',';//set name to department name instead of gmail account name
        $_SESSION["name"] = $uname;
    }
}
$uname = $_SESSION["name"];
*/

?>
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title> F M S S </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet"/>
</head>

<?php
$html = "";
if (isset($_GET['date_submit'])) {


     $checking = $_GET['checking']; 

    $pending = 0;
    $resolved = 0;
    $progress = 0;
    $total_cost = 0;
    $start = $_GET['first'];
    $second = $_GET['second'];
    $day1 = explode("-", $start);
    $day2 = explode("-", $second);
    $month = "";
    $month2 = "";
    if ($day1[2] == '01') {
        $day1[2] .= 'st';
    } else if ($day1[2] == '02') {
        $day1[2] .= 'nd';
    } else if ($day1[2] == '03') {
        $day1[2] .= 'rd';
    } else {
        $day1[2] .= 'th';
    }
    if ($day2[2] == '01') {
        $day2[2] .= 'st';
    } else if ($day2[2] == '02') {
        $day2[2] .= 'nd';
    } else if ($day1[2] == '03') {
        $day2[2] .= 'rd';
    } else {
        $day2[2] .= 'th';
    }
    switch ($day1[1]) {
        case 1:
            $month = "January";
            break;
        case 2:
            $month = "February";
            break;
        case 3:
            $month = "March";
            break;
        case 4:
            $month = "April";
            break;
        case 5:
            $month = "May";
            break;
        case 6:
            $month = "June";
            break;
        case 7:
            $month = "July";
            break;
        case 8:
            $month = "August";
            break;
        case 9:
            $month = "September";
            break;
        case 10:
            $month = "Octobar";
            break;
        case 11:
            $month = "November";
            break;
        case 12:
            $month = "December";
            break;
    }
    switch ($day2[1]) {
        case 1:
            $month2 = "January";
            break;
        case 2:
            $month2 = "February";
            break;
        case 3:
            $month2 = "March";
            break;
        case 4:
            $month2 = "April";
            break;
        case 5:
            $month2 = "May";
            break;
        case 6:
            $month2 = "June";
            break;
        case 7:
            $month2 = "July";
            break;
        case 8:
            $month2 = "August";
            break;
        case 9:
            $month2 = "September";
            break;
        case 10:
            $month2 = "Octobar";
            break;
        case 11:
            $month2 = "November";
            break;
        case 12:
            $month2 = "December";
            break;
    }
    $html .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <img src="./assets/img/somaiya_logo.png" style="width:50px; height:50px;">
    <h4 style="text-align:center; margin-top:-40px"><strong>K. J. Somaiya College of Engineering, Mumbai-77</strong><br>
          (Autonomous College Affiliated to University of Mumbai)</h4>
    <div style="float:right;">
    <h5>From:' . $day1[2] . " " . $month . " " . $day1[0] . ' </h5>
    <h5>To:' . $day2[2] . " " . $month2 . " " . $day2[0] . ' </h5>
    </div>
  
          <h3 style="text-align:center"><strong>Complain Report</strong></h3>
        <style>
              table, th, td {
                padding: 5px;
              border: 1px solid black;
              border-collapse: collapse;
            }
              </style>
          ';


          foreach ($checking as $deptname){



    $pending = 0;
    $resolved = 0;
    $progress = 0;
    $total_cost = 0;
    $total_complain = 0;
    $dep = $deptname;
    //echo $_POST['radio'];
    $query = mysqli_query($con, "SELECT * from complain WHERE Departmentname like '%$dep%'");
    $html .= '<h3>Department:' . $dep . ' </h3>
    
               <table class="table departmentTable">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Detail</th>
                        <th scope="col">Date Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Complainee Email</th>
                        <th scope="col">Cost</th>
                      </tr>
                    </thead>';
    while ($row = mysqli_fetch_array($query)) {
        $date = $row['complaindate'];
        $date = explode(" ", $date);
        $start = strtotime($_GET['first']);
        $second = strtotime($_GET['second']);
        $check = strtotime($date[0]);
        if ($start <= $check && $check <= $second) {
            $html .= '<tr>
                      <td>' . $row['id'] . '</td>
                      
                      
                      <td>' . $row['description'] . '</td>
                      
                      
                      <td>' . $row['complaindate'] . '</td>
                      
                      
                      <td>' . $row['status'] . '</td>
                      
                
                       
                        <td>' . $row['complainantmail'] . '</td>
                        <td>' . $row['cost'] . '</td>
                      </tr>
                      ';
            switch ($row['status']) {
                case 'Pending':
                    $pending += 1;
                    break;
                case 'In-Progress':
                    $progress += 1;
                    break;
                case 'Resolved':
                    $resolved += 1;
                    break;
            }
            $total_cost += $row['cost'];
            $total_complain += 1;
        }
        //$html.=$row['complaindate']."<br>";
    }
    $html .= '</table><br>
    <table class="table" align="center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Total Complains</th>
      <th scope="col">Pending</th>
      <th scope="col">In-Progress</th>
      <th scope="col">Resolved</th>
      <th scope="col">Total Cost</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">' . $total_complain . '</th>
      <td>' . $pending . '</td>
      <td>' . $progress . '</td>
      <td>' . $resolved . '</td>
      <td>' . $total_cost . '</td>
    </tr>
    </tbody>
    </table>
    <hr>';


}
    $mpdf = new Mpdf();
    $dname = date("d-m-Y H:i:s");
    $download = "complain(" . $dname . ").pdf";
    $currentTime = date("d-m-Y H:i:s");
    $mpdf->SetFooter($currentTime);
    //$mpdf->SetFooter('Document Title');
    $file_name = $dep . ".pdf";
    $mpdf->WriteHTML($html);
    $pdf = $mpdf->Output('', 'S');
    $mpdf->Output($file_name, 'I');
    if ($_GET['complain_send_to'] != '')
        sendEmail($_GET['complain_send_to'], $pdf);
}
?>


<?php

function sendEmail($email, $pdf)
{
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
        // //$mail->addAddress("9833saurabhtiwari@gmail.com");
        $mail->addAddress($email);     // Add a recipient

        // Attachments
        $mail->addStringAttachment($pdf, "complain.pdf");         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        //$var=$_POST['body'];
        //$var='Test';//$_POST['body'];
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Complain Report';
        $mail->Body = 'Please see the attachment';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }


}

?>


<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a class="simple-text logo-normal">
            F M S S </a>
        </div>


        <div class="sidebar-wrapper">
            <ul class="nav">

                <li class="nav-item">
                    <br/>
                    <div class="card-profile">
                        <div class="card-avatar">

                            <img class="img" src="<?php echo $_SESSION['imgurl']; ?>"/>

                        </div>
                        <div class="card-body">
                            <h5 class="card-title">    <?php echo $uname; ?></h5>

                        </div>
                </li>


                <li class="nav-item  ">
                    <a class="nav-link" href="./depthome.php">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>

                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="./deptstatuscomplain.php?status=">
                        <i class="material-icons">list_alt</i>
                        <p>View Complains</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./depthcancel.php">
                        <i class="material-icons">cancel_presentation</i>
                        <p>Cancel Complains</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="./deptforward.php">
                        <i class="material-icons">forward</i>
                        <p>Forwad Complains</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./deptdocomplain.php">
                        <i class="material-icons">post_add</i>
                        <p>Do Complain</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./deptmycomplain.php?status=">
                        <i class="material-icons">view_list</i>
                        <p>My Complains</p>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./deptreport.php">
                        <i class="material-icons">content_paste</i>
                        <p>Report</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./logout.php">
                        <i class="material-icons">arrow_back</i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#"><b>Dashboard</b></a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>

            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-md-6 offset-md-3">
                        <form style="margin-top: 50px;" method="GET" target="_blank">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">REPORT DETAILS</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <!--<input type="date" name="first" class="form-control" placeholder="First name">-->
                                            <div class="form-group">
                                                <h4 class="text-primary">From : </h4>
                                                <input placeholder="Report From" class="form-control" type="text"
                                                       onfocus="(this.type='date')" onblur="(this.type='text')"
                                                       id="date" name="first" required>
                                            </div>

                                        </div>
                                        <div class="col">
                                            <!--<input type="date" name="second" class="form-control" placeholder="Last name">-->
                                            <div class="form-group">

                                                <h4 class="text-primary">To : </h4>
                                                <input placeholder="Report To" class="form-control" type="text"
                                                       onfocus="(this.type='date')" onblur="(this.type='text')"
                                                       id="date" name="second" required>
                                            </div>
                                        </div>


                                    </div>


                                    <div style="margin: 25px 0 25px 10px">

                                        <?php
                                        $len = count($deptnamearr);
                                        while ($len != 0) {

                                            echo '<input type="checkbox" name="checking[]" value="' . $deptnamearr[$len - 1] . '">';
                                            echo $deptnamearr[$len - 1];
                                            echo "<br>";

                                            $len -= 1;

                                        }
                                        ?>


                                        <!-- <select class="custom-select" style="margin-top: 50px;">
                                         <option selected>select Department</option>
                                         <option value="1">Carpenter</option>
                                         <option value="2">Networking</option>
                                         <option value="3">Test</option>
                                       </select>-->

                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col">
                                                <input type="submit" class="btn btn-primary btn-block"
                                                       name="date_submit" value="Export to PDF">
                                            </div>
                                            <div class="col">
                                                <input type="submit" class="btn btn-primary btn-block" name="excel"
                                                       value="Export to Excel" formaction="complain_report_ajax.php">
                                            </div>
                                        </div>

                                        <h4 for="send_to" style="margin-top: 20px; font-size:18px"><strong>Send Report
                                                To:</strong></h4>
                                        <div class="row">
                                            <div class="col-md-8 col-sd-12 col-ld-8">
                                                <input placeholder="Enter Email" id="send_to" class="form-control"
                                                       name="complain_send_to" type="email">
                                            </div>
                                            <div class="col-md-4 col-sd-12 col-ld-4">
                                                <input type="submit" class="btn btn-primary btn-block"
                                                       name="date_submit" value="Send Mail">
                                            </div>
                                        </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>


    </div>

</div>

<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap-material-design.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="assets/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="assets/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="assets/js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
<!--    Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<!--    Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="assets/js/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="assets/js/plugins/jquery-jvectormap.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="assets/js/plugins/arrive.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/demo/demo.js"></script>


<script>
    /*  $("li").click(function(){
        alert("j");
        var val=$(this).text();
        $("#dropdownMenuLink").text("STATUS: "+$(this).text());
        $.ajax(function(){
          type:"POST",
          url:"status_update.php",
          data:"status="+val+"&id=<?php //echo $_GET['id']?>"
    }).done(function(){
      window.open("depthome.php?id="+<?php //echo $_GET['id']?>,"_self");
    });



    });
  */

</script>


<script>

    function doSomething(a) {
        var x = document.getElementById("testing");
        var y = document.getElementById("test");
        //if (x.style.display === "none") {
        y.innerHTML = a;
        //x.style.display = "block";
        console.log(a);
        // alert('Form submitted!'+a);
        return false;
    }

    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                    $('.fixed-plugin .dropdown').addClass('open');
                }

            }

            $('.fixed-plugin a').click(function (event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .active-color span').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .background-color .badge').click(function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('background-color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function () {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function () {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function () {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

            $('.switch-sidebar-image input').change(function () {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').change(function () {
                $body = $('body');

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function () {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function () {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function () {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    });
</script>
</body>
</html>
