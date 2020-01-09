<?php
include("config/config.php");

//dashboard of admin
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Load Composer's autoloader
require 'vendor/autoload.php';
if (!isset($_SESSION['name'])) {

    header("Location: index.php");
    exit();
} else {
    $sql = "SELECT usertype FROM user WHERE email='" . $_SESSION["email"] . "'";
    $res = mysqli_query($con, $sql);
    $row = $res->fetch_assoc();

    if ($row['usertype'] == 'admin') {
        $sidebar = '
	  <li class="nav-item ">
            <a class="nav-link" href="./adddepartment.php">
              <i class="material-icons">group_add</i>
              <p>Add department</p>
            </a>
          </li>
            <li class="nav-item ">
            <a class="nav-link" href="./removedepartment.php">
              <i class="material-icons">clear</i>
              <p>Remove department</p>
            </a>
          </li>
	  ';
    } else {
        $sidebar = '';
    }

    if ($row['usertype'] != 'admin') {
        if ($row['usertype'] == 'Manager') {

        } else
            if ($row['usertype'] == 'User') {
                header("Location: dashboard.php");
                exit();
            } else if ($row['usertype'] == 'Department') {
                header("Location: depthome.php");
                exit();

            } else {
                header("Location: index.php");
                exit();
            }
    }

}

$totcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain "));

$totpendingcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE status='Pending'"));

$totsolvedcomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE  status='Resolved'"));

$totinprogresscomp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE status='In-Progress'"));

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
                FMSS </a>
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
                    <a class="nav-link" href="./admindashboard.php">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!--<li class="nav-item ">
                    <a class="nav-link" href="./adminprofile.php">
                        <i class="material-icons">person</i>
                        <p>My Profile</p>
                    </a>
                </li>-->
                <li class="nav-item ">
                    <a class="nav-link" href="./test_report.php">
                        <i class="material-icons">content_paste</i>
                        <p>Reports</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="./editdepartment.php">
                        <i class="material-icons">create</i>
                        <p>Edit department</p>
                    </a>
                </li>

                <?php
                echo $sidebar;
                ?>
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
                    <a class="navbar-brand">Perform Action</a>
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


        <?php
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $query = mysqli_query($con, "SELECT * FROM complain WHERE id='$id'");
            $fetch = mysqli_fetch_array($query);
            $building = $fetch['building'];
            $location = $fetch['location'];
            $description = $fetch['description'];
            $upload_img = $fetch['complainimg'];
            $cname = $fetch['complainant'];
            $cmail = $fetch['complainantmail'];
            $dtym = $fetch['complaindate'];
            $cstatus = $fetch['status'];
            $usercontactnum = $fetch['contactnum'];
            $quotation = $fetch['quotation'];
            if (empty($upload_img)) {
                $upload = "";
            } else {


                $upload = '<div class="col-lg-4 col-md-6 col-sm-6">

                <div class="card card-stats">
                <br>
                <div class="card-header card-header-warning card-header-icon">
                  
                  <p class="card-category text-left text-primary">Uploaded Document :</p>
                  
                </div>
                <div class="card-footer" style="margin-top:0px;">
                  <div class="stats">
                    <a class="btn btn-primary"  target="_blank" href="../' . $upload_img . '">View Document</a>
                   
                  </h4>
                  </div>
                </div>
              </div>

                </div>';
            }


            if (empty($quotation)) {
                $view_quotation = "";
            } else {

                /*$upload="
                <div class='form-group'>
                <a class='btn btn-primary' target='_blank' href='" .$upload_img."'>View Quotation:</a>
                </div>";*/

                $view_quotation = '
	<div class="col-lg-6 col-md-6 col-sm-6">

                <div class="card card-stats">
                <br>
                <div class="card-header card-header-warning card-header-icon">
                  
                  <p class="card-category text-left text-primary">Uploaded Attachment :</p>
                  
                </div>
                <div class="card-footer" style="margin-top:0px;">
                  <div class="stats">
                    <a class="btn btn-primary"  target="_blank" href="' . $quotation . '">View Document</a>
                   
                  </h4>
                  </div>
                </div>
              </div>

                </div>
                ';
            }
        }


        $sql44 = "select * from admincomplain where ogid=" . $id;

        $res = mysqli_query($con, $sql44);
        $cc = mysqli_num_rows($res);

        if ($cc == 0) {
            $admin_remark_ui = '';
        } else {
            $admin_remark_ui = '
					
					
					<div class="row" style="margin-top: 50px">' .
                $view_quotation . '

                                        <div class="col-lg-6 col-md-6 col-sm-6">

                                            <div class="card card-stats">
                                                <br>
                                                <div class="card-header card-header-warning card-header-icon">

                                                    <p class="card-category text-left text-primary">Remark:</p>
                                                    <input type="text" name="adminremark" class="form-control"
                                                           id="complainRemark" placeholder="Enter remark"
                                                    >

                                                </div>
                                                <div class="card-footer" style="margin-top: 0px;">
                                                    <div class="stats" style="word-break: break-word">


                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <input type="submit" name="reg_complain" class="btn btn-primary btn-block"
                                              
					
					
					';
        }


        ?>


        <div class="content">
            <div class="container-fluid">
                <div class="row" id="complain">


                    <div class="col-md-8 offset-md-2">
                        <div class="card" id="dept_card">
                            <div class="card-header card-header-primary" style="margin:0">
                                <h4 class="card-title"
                                    id="complain_card"><?php echo "Complain Id : $id - $cstatus "; ?></h4>
                                <!--
                                <p class="card-category">Complain By '.$cname.'</p>
                                <p class="card-category">Mail id : '.$cmail.'</p>
                                <p class="card-category">Date Time : '.$dtym.'</p>
                                -->
                            </div>
                            <div class="card-body">


                                <div class="row">

                                    <div class="col-lg-4 col-md-6 col-sm-6">

                                        <div class="card card-stats">
                                            <br>
                                            <div class="card-header card-header-warning card-header-icon">

                                                <p class="card-category text-left text-primary">Complain By :</p>

                                            </div>
                                            <div class="card-footer" style="margin-top: 0px;">
                                                <div class="stats" style="word-break: break-word">
                                                    <h4 class="card-title" style="font-weight:400"><?php echo $cname; ?>

                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6">

                                        <div class="card card-stats">
                                            <br>
                                            <div class="card-header card-header-warning card-header-icon">

                                                <p class="card-category text-left text-primary">Mail id :</p>

                                            </div>
                                            <div class="card-footer" style="margin-top: 0px;">
                                                <div class="stats" style="word-break: break-word">
                                                    <h4 class="card-title"
                                                        style="font-weight:400 "><?php echo $cmail; ?>

                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6">

                                        <div class="card card-stats">
                                            <br>
                                            <div class="card-header card-header-warning card-header-icon">

                                                <p class="card-category text-left text-primary">Contact Number</p>

                                            </div>
                                            <div class="card-footer" style="margin-top: 0px;">
                                                <div class="stats" style="word-break: break-word">
                                                    <h4 class="card-title"
                                                        style="font-weight:400"><?php echo $usercontactnum; ?>

                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-lg-4 col-md-6 col-sm-6">

                                        <div class="card card-stats">
                                            <br>
                                            <div class="card-header card-header-warning card-header-icon">

                                                <p class="card-category text-left text-primary">Date Time :</p>

                                            </div>
                                            <div class="card-footer" style="margin-top: 0px;">
                                                <div class="stats" style="word-break: break-word">
                                                    <h4 class="card-title" style="font-weight:400"><?php echo $dtym; ?>

                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">

                                        <div class="card card-stats">
                                            <br>
                                            <div class="card-header card-header-warning card-header-icon">

                                                <p class="card-category text-left text-primary">Building :</p>

                                            </div>
                                            <div class="card-footer" style="margin-top: 0px;">
                                                <div class="stats" style="word-break: break-word">
                                                    <h4 class="card-title"
                                                        style="font-weight:400"><?php echo $building; ?>

                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6">

                                        <div class="card card-stats">
                                            <br>
                                            <div class="card-header card-header-warning card-header-icon">

                                                <p class="card-category text-left text-primary">Location :</p>

                                            </div>
                                            <div class="card-footer" style="margin-top: 0px;">
                                                <div class="stats" style="word-break: break-word">
                                                    <h4 class="card-title"
                                                        style="font-weight:400"><?php echo $location; ?>

                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php echo $upload; ?>
                                </div>


                                <!--
                                 <form action="" enctype="multipart/form-data" method="POST">
                                 <input type="hidden" id="cid" value="'.$id.'"  >
                                 <div class="form-group" id="building_input" style="">
                                             <h6><u><b>Current Status</b></u></h6>
                                   <input type="text" class="form-control " value="'.$cstatus.'"  disabled>

                                           </div>
                                           <div class="form-group" id="building_input" style="">
                                             <h6><u><b>Building</b></u></h6>
                                   <input type="text" class="form-control " value="'.$building.'" id="Building" disabled>
                                           </div>
                                           <div class="form-group" >
                                             <h6><u><b>location</b></u></h6>
                                   <input type="text" class="form-control"  value="'.$location.'" id="location"  disabled>
                                           </div>

                                           -->

                                <div class="form-group">

                                    <p class="card-category text-left text-primary" style="font-size:18px">Description
                                        :</p>
                                    <textarea class="form-control" name="complain_body" rows="5" id="complain_message"
                                              style="border: 1px solid #cacaca;
    padding: 10px;cursor: auto; " disabled><?php
                                        echo $description;
                                        ?></textarea>

                                </div>
                                <!--

                                                         // echo $upload;

                                                          $date=date("m-d-Y");


                                                          $parts = explode('-', $date);
                                                          $date=$parts[2]. '-' . $parts[0] . '-' . $parts[1]  ;


                                                          echo '-->
                                <form action="" method="POST">


                                    <hr>
                                    <div class="form-group">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <h3 class="text-center text-primary"
                                                style="font-family: monoton; font-weight: 600;border: 1px solid #9c27b0;">
                                                <b>TAKE ACTION</b>
                                                <h3>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">

                                            <div class="card card-stats">
                                                <br>
                                                <div class="card-header card-header-warning card-header-icon">

                                                    <p class="card-category text-left text-primary">Assign to Department
                                                        :</p>

                                                </div>
                                                <div class="card-footer" style="margin-top:0px;">
                                                    <div class="stats">
                                                        <div class="dropdown">
                                                            <a class="btn btn-primary btn-block dropdown-toggle"
                                                               href="#" role="button" id="dropdownMenuLink1"
                                                               data-toggle="dropdown" aria-haspopup="true"
                                                               aria-expanded="false">
                                                                SELECT DEPARTMENT
                                                            </a>

                                                            <ul class="dropdown-menu btn-block"
                                                                aria-labelledby="dropdownMenuLink">

                                                                <?php

                                                                $deptsql = "SELECT * FROM complain WHERE id=$id";
                                                                $resultdpt = mysqli_query($con, $deptsql);
                                                                $rowdpt = mysqli_fetch_array($resultdpt);
                                                                $compdept = $rowdpt['Departmentname'];


                                                                $sql = "SELECT * FROM department order by dname";
                                                                $result = mysqli_query($con, $sql);

                                                                while ($row = mysqli_fetch_array($result)) {


                                                                    if (strpos($compdept, $row['dname']) !== false) {
                                                                        echo '';
                                                                    } else {
                                                                        echo '
								
								<a href="./forwarddept.php?dept=' . $row['dname'] . '&id=' . $id . '">
								<li class="dropdown-item forward_department" id="item' . $row['id'] . '" name="' . $row['dname'] . '" href="#">' . $row['dname'] . '</li>
								</a>
								
								
								';
                                                                    }

                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>

                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">

                                            <div class="card card-stats">
                                                <br>
                                                <div class="card-header card-header-warning card-header-icon">

                                                    <p class="card-category text-left text-primary">Remove Department
                                                        :</p>

                                                </div>
                                                <div class="card-footer" style="margin-top:0px;">
                                                    <div class="stats">
                                                        <div class="dropdown">
                                                            <a class="btn btn-primary btn-block dropdown-toggle"
                                                               href="#" role="button" id="dropdownMenuLink1"
                                                               data-toggle="dropdown" aria-haspopup="true"
                                                               aria-expanded="false">
                                                                SELECT DEPARTMENT
                                                            </a>

                                                            <ul class="dropdown-menu btn-block"
                                                                aria-labelledby="dropdownMenuLink">

                                                                <?php

                                                                $deptsql = "SELECT * FROM complain WHERE id=$id";
                                                                $resultdpt = mysqli_query($con, $deptsql);
                                                                $rowdpt = mysqli_fetch_array($resultdpt);
                                                                $compdept = $rowdpt['Departmentname'];


                                                                $sql = "SELECT * FROM department";
                                                                $result = mysqli_query($con, $sql);

                                                                while ($row = mysqli_fetch_array($result)) {


                                                                    if (strpos($compdept, $row['dname']) !== false) {
                                                                        echo '
									
								<a href="./removedeptcomp.php?dept=' . $row['dname'] . '&id=' . $id . '">
								<li class="dropdown-item forward_department" id="item' . $row['id'] . '" name="' . $row['dname'] . '" href="#">' . $row['dname'] . '</li>
								</a>
									';
                                                                    } else {
                                                                        echo '
								
								
								
								';
                                                                    }

                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>

                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="card card-stats">
                                                <br>
                                                <div class="card-header card-header-warning card-header-icon">

                                                    <p class="card-category text-left text-primary">CHANGE STATUS :</p>

                                                </div>
                                                <div class="card-footer" style="margin-top:0px;">
                                                    <div class="stats">
                                                        <div class="dropdown">
                                                            <a class="btn btn-primary btn-block dropdown-toggle"
                                                               href="#" role="button" id="dropdownMenuLink"
                                                               data-toggle="dropdown" aria-haspopup="true"
                                                               aria-expanded="false">
                                                                SELECT STATUS
                                                            </a>
                                                            <?php
                                                            echo '
                                       <ul class="dropdown-menu btn-block" aria-labelledby="dropdownMenuLink" >
                                            <li class="dropdown-item" id="item2" name="inprogress" href="#">In-Progress</li>
                                            <li class="dropdown-item" id="item3" name="resolved" href="#">Resolved</li>
                                       </ul>';
                                                            ?>
                                                        </div>

                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-lg-6 col-md-6 col-sm-6">

                                            <div class="card card-stats" id="start">
                                                <br>
                                                <div class="card-header card-header-warning card-header-icon">

                                                    <p class="card-category text-left text-primary">Time Require(In
                                                        Days) :</p>

                                                </div>
                                                <div class="card-footer" style="margin-top:0px;">
                                                    <div class="stats">
                                                        <div class="form-group">

                                                            <input type="number" name="timer" id="timer_update"
                                                                   class="form-control" style="" min="0" value="0"
                                                                   required>
                                                        </div>


                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="card card-stats" id="expense" style="display:none">
                                                <br>
                                                <div class="card-header card-header-warning card-header-icon">

                                                    <p class="card-category text-left text-primary">Total Expenditure(In
                                                        Rs.):</p>

                                                </div>
                                                <div class="card-footer" style="margin-top:0px;">
                                                    <div class="stats">
                                                        <div class="form-group">

                                                            <input type="number" name="cost" id="cost_update"
                                                                   class="form-control" min="0" value=0 required>
                                                        </div>


                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                    <input type="submit" name="reg_complain" class="btn btn-primary btn-block"
                                           style="float: left;" value="Update">

                                    <br/>
                                    <?php
                                    echo $admin_remark_ui;
                                    ?>


                                </form>


                                <div class="clearfix"></div>
                                <!-- </form>-->
                            </div>
                        </div>
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

    <?php


    if (isset($_POST['reg_complain'])) {
        if (isset($_COOKIE['status'])) {
            $status = $_COOKIE['status'];
        } else {
            $status = "Pending";
        }
        if (isset($_COOKIE['Department'])) {
            $deptn = $_COOKIE['Department'] . ",";
        } else {
            $deptn = '';
        }
        $timer = $_POST['timer'];
        $cost = $_POST['cost'];
        $adminremark = $_POST['adminremark'];
        $adminremark = mysqli_real_escape_string($con, $adminremark);
        $check = 0;
        if (!empty($adminremark)) {
            $adminremark = $adminremark . " by " . $_SESSION['name'];
            $sql99 = "UPDATE admincomplain SET admin_remark='$adminremark' WHERE ogid='$id'";
            $query = mysqli_query($con, $sql99);
            $check = 1;

        }
        if ($check == 0) {
//              $query = mysqli_query($con, "UPDATE complain SET status='$status'  , cost='$cost' WHERE id='$id'");
            $query = mysqli_query($con, "UPDATE complain SET status='$status' , time_constraint='$timer' , cost='$cost'WHERE id='$id'");


//$sql7="UPDATE complain SET status='".$status."' , time_constraint=".$timer." ,cost=".$cost." WHERE id=".$id.";";
//echo $sql7;

            if ($status == "Resolved") {

                setcookie('status', time() - 1);
                $query8 = mysqli_query($con, "SELECT * FROM complain where id='$id'");
                //row8 = mysqli_fetch_array($query8);
                /*if($row8['solved_by']=="NULL"){
                  $query8 = mysqli_query($con,"INSERT into complain(solved_by) values('') where id =")
                }*/
//            echo '<script>alert("in resolved part")</script>';
                $uname = $_SESSION['name'];
                $query = mysqli_query($con, "UPDATE complain SET solved_by='$uname' WHERE id='$id'");
                $dt = date("Y-m-d H:i:s");
                $query = mysqli_query($con, "UPDATE complain SET resolved_date='$dt' where id='$id'");
                // $query = mysqli_query($con, "UPDATE complain SET status='$status'  , cost='$cost' WHERE id='$id'");


                $query = mysqli_query($con, "SELECT * FROM complain WHERE id='$id'");
                $row = mysqli_fetch_array($query);
                $body = $row['description'];
                $file_path = $row['complainimg'];
                $mail_to = $row['complainantmail'];
                $department = $row['Departmentname'];
                $sender = $row['complainant'];
                $sender_mail = $row['complainantmail'];
                $building = $row['building'];
                $location = $row['location'];


                $msg = "<strong>
 Your complain has been resolved.</strong><br> Your complain details were<br>
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
                    $mail->addAddress($mail_to);     // Add a recipient

                    // Attachments
                    //  if($file_path!="")
                    //  $mail->addAttachment($file_path);         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name


                    $dep = mysqli_query($con, "SELECT email from user where usertype='Department' and username='$dp'");


                    // Content
                    //$var=$_POST['body'];
                    //$var='Test';//$_POST['body'];
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Complain Resolved id ' . $id;
                    $mail->Body = $msg;

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }


            }


        }
        header("Location:admindashboard.php");

    }


    ?>
    <script>

        $(".dropdown-item").click(function () {

            var val = $(this).text().trim();
            $("#dropdownMenuLink").text($(this).text());

            document.cookie = "status=" + $(this).text();

            if ($(this).text() == 'In-Progress') {
                $('#expense').hide();
                $("#start").show();
            } else if ($(this).text().trim() == 'Resolved') {
                $("#start").hide();
                $('#expense').show();
            } else {
                $('#expense').hide();
                $("#start").show();
            }
            /* $.ajax({
               type: "POST",
               url: "status_update.php",
               data:"status="+val+"&id=
    }).done(function(){
      window.open("depthome.php","_self");
    });

*/

        });


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


        $(document).ready(function () {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();

        });
    </script>

    <script>

        $(".dropdown-item").click(function () {

            var val = $(this).text();
            $("#dropdownMenuLink").text($(this).text());

            document.cookie = "status=" + $(this).text();

            if ($(this).text() == 'In-Progress') {
                $('#expense').hide();
                $("#start").show();
            } else if ($(this).text() == 'Resolved') {
                $("#start").hide();
                $('#expense').show();
            } else {
                $('#expense').hide();
                $("#start").show();
            }
            /* $.ajax({
               type: "POST",
               url: "status_update.php",
               data:"status="+val+"&id=
    }).done(function(){
      window.open("depthome.php","_self");
    });

*/

        });


    </script>


