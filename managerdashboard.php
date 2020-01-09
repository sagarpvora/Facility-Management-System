<?php
include("config/config.php");
//dashboard of admin
if (!isset($_SESSION['name'])) {

    header("Location: index.php");
    exit();
} else {
    $sql = "SELECT usertype FROM user WHERE email='" . $_SESSION["email"] . "'";
    $res = mysqli_query($con, $sql);
    $row = $res->fetch_assoc();

}


$sql = "SELECT name FROM user WHERE email='" . $_SESSION["email"] . "'";
$res = $res_u = mysqli_query($con, $sql);
$row = $res->fetch_assoc();
$uname = $row["name"];//set name to department name instead of gmail account name
$_SESSION["name"] = $uname;

$totcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain "));

$totpendingcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE status='Pending' OR status='Pending#'"));

$totsolvedcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE  status='Resolved' OR status='Resolved#'"));

$totinprogresscomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE status='In-Progress' OR status='In-Progress#'"));

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
                            <h5 class="card-title">   <?php echo $_SESSION['name']; ?></h5>

                        </div>
                </li>


                <li class="nav-item active ">
                    <a class="nav-link">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!--<li class="nav-item ">
                    <a class="nav-link" href="./manprofile.php">
                        <i class="material-icons">person</i>
                        <p>My Profile</p>
                    </a>
                </li>-->
                <li class="nav-item ">
                    <a class="nav-link" href="./manager_test_report.php">
                        <i class="material-icons">content_paste</i>
                        <p>Reports</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="./editmandepartment.php">
                        <i class="material-icons">create</i>
                        <p>Edit department</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./admincancel.php">
                        <i class="material-icons">clear</i>
                        <p>Cancel complains</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="./admindocomp.php">
                        <i class="material-icons">content_paste</i>
                        <p>Do Complain</p>
                    </a>
                </li>


                <li class="nav-item ">
                    <a class="nav-link" href="./adminmycomplain.php?status=">
                        <i class="material-icons">content_paste</i>
                        <p>My Complains</p>
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
                    <a class="navbar-brand" href="#pablo">Dashboard</a>
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
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-primary card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">format_list_bulleted</i>
                                </div>
                                <p class="card-category">Complains</p>
                                <h3 class="card-title"><?php echo $totcomp ?>
                                </h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">

                                    <i class="material-icons">content_paste</i><a href="./statuscomplain.php?status=">View
                                        Details</a>

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
                                <h3 class="card-title"><?php echo $totpendingcomp ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">error_outline</i><a
                                            href="./statuscomplain.php?status=Pending">View Details</a>
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
                                <h3 class="card-title"><?php echo $totinprogresscomp ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">refresh</i><a
                                            href="./statuscomplain.php?status=In-Progress">View Details</a>
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
                                <h3 class="card-title"><?php echo $totsolvedcomp ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="material-icons">check</i><a href="./statuscomplain.php?status=Solved">View
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br/>
                <?php


                $checkcomp = mysqli_num_rows(mysqli_query($con, "SELECT * from complain where Departmentname='Emergency' AND status!='Resolved'"));
                if ($checkcomp > 0) {
                    echo '  <div class="row">
		    <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-danger">
                  <h4 class="card-title">Attention Required</h4>
                  <p class="card-category">Urgent Complains</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-danger">
					
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
                          Action
                        </th>
                      </thead>
                      <tbody>';

                    $sql = "SELECT * from complain where Departmentname='Emergency'  AND status != 'Resolved'";
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
                        echo "'  style='    font-weight: 500;'>" . $row['status'] . "</td>";

                        echo '<td><button type="button" class="btn btn-danger" name="' . $row['id'] . '" onclick="redirectme(event)">Take Action!</button></td></tr>';
                    }

                    echo '            </tbody>
                    </table>
                </div>
              </div>
            </div>
		  </div>
		 
		  
		  <br/>';
                }

                //forwarded complains
                $checkcomp = mysqli_num_rows(mysqli_query($con, "SELECT * from complain where id IN (SELECT ogid from admincomplain)
		AND (status='In-Progress' OR status='Pending' OR status='In-Progress#' OR status='Pending#')"));
                if ($checkcomp > 0) {
                    echo '  <div class="row">
		    <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Forwarded Complain</h4>
                  <p class="card-category">Action required</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
					
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
						Severity
						</th>
                        <th>
                          Status
                        </th>
						<th>
                          Department
                        </th>
						
						<th>
                          Remark
                        </th>	<th>
                         Admin Remark
                        </th>
						<th>
                          Action
                        </th>
                      </thead>
                      <tbody>';


                    $sql = "SELECT complain.id,complaindate,description,status,Departmentname,remark,admin_remark,priority FROM complain INNER JOIN admincomplain ON admincomplain.ogid=complain.id  AND  status not like '%Resolved%' ORDER BY complaindate DESC ";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        //Creates a loop to dipslay all complain
                        if ($row['priority'] == 'High') {
                            echo '<tr style="background-color:rgba(255, 0, 0, 0.2)">';
                        } else {
                            echo '<tr>';
                        }
                        echo "<td>" . $row['id'] . "</td>";
                        if (strlen($row['description']) > 50) {
                            echo "<td >" . substr($row['description'], 0, 50) . " ...</td>";
                        } else {
                            $tmpd = $row['description'];
                            $tmplen = 54 - strlen($row['description']);

                            echo "<td >" . $tmpd . str_repeat('&nbsp;', $tmplen);
                            "</td>";
                        }
                        echo "<td>" . $row['complaindate'] . "</td>";
                        echo "<td>" . $row['priority'] . "</td>";
                        echo "<td class='";
                        if ($row['status'] == 'Pending' || $row['status'] == 'Pending#') {
                            echo 'text-danger';
                        } else if ($row['status'] == 'In-Progress' || $row['status'] == 'In-Progress#') {
                            echo 'text-warning';
                        } else if ($row['status'] == 'Resolved' || $row['status'] == 'Resolved#') {
                            echo 'text-success';
                        }
                        echo "'  style='    font-weight: 500;'>" . $row['status'] . "</td>";
                        echo "<td>" . $row['Departmentname'] . "</td>";
                        echo "<td>" . $row['remark'] . "</td>";
                        echo "<td>" . $row['admin_remark'] . "</td>";
                        echo '<td><button type="button" class="btn btn-warning" name="' . $row['id'] . '" onclick="redirectme(event)">Take Action!</button></td></tr>';
                    }

                    echo '            </tbody>
                    </table>
                </div>
              </div>
            </div>
		  </div>
		 
		  
		  <br/>';
                }
                ?>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header card-header-tabs card-header-primary">
                                <h4 class="card-title">Select area of service to view complains </h4>
                                <br/>
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">

                                        <ul class="nav nav-tabs" data-tabs="tabs">

                                            <?php


                                            $sql = "SELECT * FROM department ";
                                            $result = mysqli_query($con, $sql);
                                            //display all department
                                            while ($row = mysqli_fetch_array($result)) {
                                                $dptname = $row['dname'];


                                                echo '<li class="nav-item">';
                                                echo "<a class='nav-link ";
                                                if ($row['id'] == 1)
                                                    echo ' active';
                                                echo "' href='#" . $row['dname'] . "' data-toggle='tab'>";
                                                echo '    <i class="material-icons">domain</i>';
                                                echo $row['dname'];
                                                echo '             <div class="ripple-container"></div>
                          </a>
                        </li>';

                                            }


                                            ?>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <?php

                                    $sql = "SELECT * FROM department ";
                                    $result = mysqli_query($con, $sql);
                                    //display all department
                                    while ($row = mysqli_fetch_array($result)) {

                                        $sql1 = "SELECT * FROM complain WHERE Departmentname='" . $row['dname'] . "' ORDER BY id DESC ";
                                        $result1 = mysqli_query($con, $sql1);
                                        $uname = $row['dname'];/*
					$pendingcomp=mysqli_num_rows(mysqli_query($con,"SELECT * FROM complain WHERE Departmentname='".."' AND status='Pending'"));
					
					$solvedcomp=mysqli_num_rows(mysqli_query($con,"SELECT * FROM complain WHERE Departmentname='".$row['dname']."' AND status='Resolved'"));
					
					$inprogresscomp=mysqli_num_rows(mysqli_query($con,"SELECT * FROM complain WHERE Departmentname='".$row['dname']."' AND status='In-Progress'"));*/

                                        //$totcomp=mysqli_num_rows(mysqli_query($con,"SELECT * FROM complain WHERE Departmentname='".$uname."'"));

                                        $pendingcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE (status='Pending' OR status='Pending#' ) AND Departmentname='" . $uname . "'"));

                                        $solvedcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE  (status='Resolved' OR status='Resolved#' ) AND Departmentname='" . $uname . "'"));

                                        $inprogresscomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE (status='In-Progress' OR status='In-Progress#' ) AND Departmentname='" . $uname . "'"));


                                        echo "<div class='tab-pane";
                                        if ($row['id'] == 1)
                                            echo ' active';
                                        echo "' id='" . $row['dname'] . "'>";

                                        echo '<div class="row">';
                                        echo '     <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header ">';

                                        echo '		</br>
		
                  <p class="card-category text-center">Total complain</p>
                  
                  <h3 class="card-title text-center" name="' . $row["dname"] . '">' . mysqli_num_rows($result1) . '</h3>									  
				
				<div class="card-footer">
                  <div class="stats">
                   <a class="text-center" href="./statuscomplain.php?status=&department=' . $row["dname"] . '">View Details</a>
                  </div>
                </div>
				</div>
              </div>
            </div>';

                                        echo '     <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header ">';

                                        echo '		</br>
		
                  <p class="card-category text-center">Pending complain</p>
                  
                  <h3 class="card-title text-center">' . $pendingcomp . '</h3>									  
				<div class="card-footer">
                  <div class="stats">
                   <a href="./statuscomplain.php?status=Pending&department=' . $row["dname"] . '">View Details</a>
                  </div>
                </div>
				</div>
              </div>
            </div>';


                                        echo '     <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header ">';

                                        echo '		</br>
		
                  <p class="card-category text-center">In Progress complain</p>
                  
                  <h3 class="card-title text-center">' . $inprogresscomp . '</h3>									  
				<div class="card-footer">
                  <div class="stats">
                   <a href="./statuscomplain.php?status=In-Progress&department=' . $row["dname"] . '">View Details</a>
                  </div>
                </div>
				</div>
              </div>
            </div>';

                                        echo '     <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header ">';

                                        echo '		</br>
		
                  <p class="card-category text-center">Solved complain</p>
                  
                  <h3 class="card-title text-center">' . $solvedcomp . '</h3>									  
				<div class="card-footer">
                  <div class="stats">
                   <a href="./statuscomplain.php?status=Solved&department=' . $row["dname"] . '">View Details</a>
                  </div>
                </div>
				</div>
              </div>
            </div>';


                                        echo '</div>';//close raw


                                        echo '   <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-primary">
                        <th>ID</th>               
						<th>Detail</th>
						<th>Date Time</th>   
						<th>Severity</th>   
					                     
						<th>Status</th>                    
					<!--	<th>Complainant</th>  
						<th>Mail</th>-->
						<th>View</th>
						<th>Action</th>
                    </thead> <tbody>';


                                        while ($row = mysqli_fetch_array($result1)) {
                                            //Creates a loop to dipslay all complain
                                            if ($row['priority'] == 'High') {
                                                echo '<tr style="background-color:rgba(255, 0, 0, 0.2)">';
                                            } else {
                                                echo '<tr>';
                                            }
                                            echo "<td>" . $row['id'] . "</td>";

                                            if (strlen($row['description']) > 50) {
                                                echo "<td >" . substr($row['description'], 0, 50) . " ...</td>";
                                            } else {
                                                $tmpd = $row['description'];
                                                $tmplen = 54 - strlen($row['description']);

                                                echo "<td >" . $tmpd . str_repeat('&nbsp;', $tmplen);
                                                "</td>";
                                            }
                                            echo "<td>" . $row['complaindate'] . "</td>";
                                            echo "<td>" . $row['priority'] . "</td>";
                                            echo "<td class='";
                                            if ($row['status'] == 'Pending' || $row['status'] == 'Pending#') {
                                                echo 'text-danger';
                                            } else if ($row['status'] == 'In-Progress' || $row['status'] == 'In-Progress#') {
                                                echo 'text-warning';
                                            } else if ($row['status'] == 'Resolved' || $row['status'] == 'Resolved#') {
                                                echo 'text-success';
                                            }
                                            echo "'  style='    font-weight: 500;'>" . $row['status'] . "</td>";
                                            //echo "<td>".$row['complainant']."</td>";
                                            //echo "<td>".$row['complainantmail']."</td>";
                                            echo '<td><button type="button" class="btn btn-primary" name="' . $row['id'] . '" onclick="viewDetails()">View Details</button></td>';
                                            echo '<td><button type="button" class="btn btn-primary" name="' . $row['id'] . '" onclick="takeAction()">Take Action</button></td>';

                                        }

                                        echo '
                    </tbody>
                  </table>
                </div>
                   </div> ';
                                    }

                                    ?>


                                </div>

                            </div>
                        </div>
                    </div>


                    <div id='testing' style="display: none">
                        <h1 id="test" value="he">He</h1>
                    </div>
                </div>

            </div>
            <?php
            include("footer.php");
            ?>
        </div>
    </div>
    <!--   Core JS Files   -->
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

    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>

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
    <script>
        function redirectme() {

            var id = event.target.name;
            window.open("admin_action.php?id=" + id, "_self");
            // window.location.href = "./admin_action.php";
        }


        function viewDetails() {

            var id = event.target.name;
            window.open("admin_view.php?id=" + id, "_self");
            // window.location.href = "./admin_action.php";
        }

        function takeAction() {

            var id = event.target.name;
            window.open("admin_action.php?id=" + id, "_self");
            // window.location.href = "./admin_action.php";
        }

        $(document).ready(function () {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();

        });
    </script>
</body>

</html>
