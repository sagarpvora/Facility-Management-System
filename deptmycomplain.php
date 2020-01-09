<?php

include("checkuser.php");
//dashboard of department
//$mysqli = new mysqli("localhost", "root", "", "complainbox");
/*$sql = "SELECT name FROM user WHERE email like '%" . $_SESSION["email"] . "%'";
$res = $res_u = mysqli_query($con, $sql);
$row = $res->fetch_assoc();
$uname = $row["name"];//set name to department name instead of gmail account name
$_SESSION["name"] = $uname;
*/

if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $img = $_SESSION['imgurl'];
} else {
    header("Location: index.php");
    exit();
}

$totcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE complainantmail='" . $email . "'"));

$totpendingcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE (status='Pending' OR status='Pending#') AND complainantmail='" . $email . "'"));

$totsolvedcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE  (status='Resolved' OR status='Resolved#')  AND complainantmail='" . $email . "'"));

$totinprogresscomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE (status='In-Progress' OR status='In-Progress#') AND complainantmail='" . $email . "'"));


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

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a href="#" class="simple-text logo-normal">
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
                            <h5 class="card-title">    <?php echo $_SESSION['name']; ?></h5>
                        </div>

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

                <li class="nav-item ">
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
                <li class="nav-item active">
                    <a class="nav-link" href="./deptmycomplain.php?status=">
                        <i class="material-icons">view_list</i>
                        <p>My Complains</p>
                    </a>
                </li>
                <li class="nav-item ">
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
                    <a class="navbar-brand" href="#"><b>Complains</b></a>
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
        <!-- End Navbar -->


        <?php

        echo '
			<div class="content" id="complainDetail">
        <div class="container-fluid">
			
				
<div class="row">
		  <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"><b>Complain Status</b></h4>
                </div>
                </div>
                </div>
</div>            
			<br/>
		         <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">format_list_bulleted</i>
                  </div>
                  <p class="card-category">Complains</p>
                  <h3 class="card-title">' . $totcomp . '
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats"><a href="./deptmycomplain.php?status=">View Details</a>

                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-clock-o"></i>

                  </div>
                  <p class="card-category">Pending</p>
                  <h3 class="card-title">' . $totpendingcomp . '</h3>
                </div>
                <div class="card-footer">
                  <div class="stats"><a href="./deptmycomplain.php?status=Pending">View Details</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
				  <i class="fa fa-refresh"></i>
                  </div>
                  <p class="card-category">In Progress</p>
                  <h3 class="card-title">' . $totinprogresscomp . '</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
				  <a href="./deptmycomplain.php?status=In-Progress">View Details</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
					<i class="fa fa-check-square-o"></i>

                  </div>
                  <p class="card-category">Solved</p>
                  <h3 class="card-title">' . $totsolvedcomp . '</h3>
                </div>
                <div class="card-footer">
                  <div class="stats"><a href="./deptmycomplain.php?status=Solved">View Details</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
                        <br/>																
          <div class="row">
                        <div class="card">
                <div class="card-header card-header-primary" style="margin:0;">
                  <h4 class="card-title ">' . $_GET['status'] . ' Complains</h4>
                  <p class="card-category">  </p>
                </div>';


        echo '   <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-primary">
                 <th>
                          ID
                        </th>
                        <th>
                          Detail
                        </th>
                       
                        <th>
                          Date Time
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Details
                        </th>
                        <th>
                        
                           </th>       
						 <th>
                         Cancel 
                        </th>
						
						                    
						               
					<!--	<th>Complainant</th>  
						<th>Mail</th>-->
					
                    </thead> <tbody>';

        $sql = "SELECT * FROM complain WHERE  status like '%" . $_GET['status'] . "%' AND complainantmail='" . $_SESSION['email'] . "' ORDER BY id DESC";

        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
            //Creates a loop to dipslay all complain
            echo "<tr><td>" . $row['id'] . "</td>";
            if (strlen($row['description']) > 50) {
                echo "<td >" . substr($row['description'], 0, 50) . " ...</td>";
            } else {
                $tmpd = $row['description'];
                $tmplen = 54 - strlen($row['description']);

                echo "<td >" . $tmpd . str_repeat('&nbsp;', $tmplen);
                "</td>";
            }

            echo "<td>" . $row['complaindate'] . "</td>";
            echo "<td class='";
            if ($row['status'] == 'Pending' || $row['status'] == 'Pending#') {
                echo 'text-danger';
            } else if ($row['status'] == 'In-Progress' || $row['status'] == 'In-Progress#') {
                echo 'text-warning';
            } else if ($row['status'] == 'Resolved' || $row['status'] == 'Resolved#') {
                echo 'text-success';
            }
            echo "'  style='    font-weight: 500;'>" . $row['status'];
            if ($row['status'] == 'In-Progress' || $row['status'] == 'In-Progress#') {
                //echo " (" .$row['time_constraint']. ")";
            }

            echo "</td>";
            echo '
                <form action="deptcomplaindetail.php" method="post">
                <td>
                <input type="hidden" style="width:1px" name="id"  value="' . $row['id'] . '">
                <button type="submit" class="btn btn-primary" name="' . $row['id'] . '">View Details
                </button>
                </td>
                </form>
                ';
            /*
                            $tmptime = strtotime($row['complaindate']);
                            $start_date = new DateTime($tmptime);
                            $new = date("d-M-Y h:i:A");
                            //   $new = date("Y-m-d H:i:s");
                            $since_start = $start_date->diff(new DateTime($new));


                            $minutes = $since_start->days * 24 * 60;
                            $minutes += $since_start->h * 60;
                            $minutes += $since_start->i;
                           */
            $start_date = new DateTime($row['complaindate']);
            $new = date("Y-m-d H:i:s");
            $since_start = $start_date->diff(new DateTime($new));
            $minutes = $since_start->days * 24 * 60;
            $minutes += $since_start->h * 60;
            $minutes += $since_start->i;

            /* $date1 = strtotime($row['complaindate']);
             $new = date("d-M-Y H:i");
             $date2 = strtotime($new);


             $diff = abs($date2 - $date1);
             $years = floor($diff / (365 * 60 * 60 * 24));

             $months = floor(($diff - $years * 365 * 60 * 60 * 24)
                 / (30 * 60 * 60 * 24));


             $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
                     $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

             $hours = floor(($diff - $years * 365 * 60 * 60 * 24
                     - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)
                 / (60 * 60));
             $minutes = floor(($diff - $years * 365 * 60 * 60 * 24
                     - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
                     - $hours * 60 * 60) / 60);
             $minutes = $minutes + ($hours * 60) + ($days * 24 * 60) + ($months * 30 * 24 * 60) + ($years * 365 * 60);*/

            echo '<form action="delete_complain.php" method="POST">';
            echo '<td><input type="hidden" style="width:1px" name="cancel_id" id="cancel_button" value="' . $row['id'] . '"></td>';
            if ($minutes <= 15) {

                /*echo '<td>
                <from action="delete_complain.php?id='.$row['id'].'" method="POST">
                <input type="submit" class="btn btn-danger" id="cancel_button" name="'.$row['id'].'" value="Cancel">
                </form></td>';*/


                echo '<td><input type="submit" class="btn btn-danger" onClick="return confirm(' . "'are you sure you want to cancel the complain?'" . ');" value="Cancel"></td>';
            } else {

                echo '<td><button type="button" class="btn btn-danger" name="cancel_id" id="cancel_button" disabled>Cancel</button></td>';

            }
            echo "</form>";
        }


        echo '</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
     </div>
	 
      </div>';

        ?>


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
        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
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

            function viewDetails() {

                var ip = event.target.name;
                var sp = ip.split(",");
                window.open("dep_cancel_view.php?id=" + sp[0] + "&dept=" + sp[1], "_self");
                // window.location.href = "./admin_action.php";
            }

        </script>

