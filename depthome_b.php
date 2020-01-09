<?php
include("checkuser.php");

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Load Composer's autoloader
require 'vendor/autoload.php';

//dashboard of department
//$mysqli = new mysqli("localhost", "root", "", "complainbox");
$uname = $_SESSION["name"];
/*
$sqlt = "SELECT name from user WHERE email like '%" . $_SESSION['email'] . "%'";
$result1 = mysqli_query($con, $sqlt);

while ($row1 = mysqli_fetch_array($result1)) {
    if (mysqli_num_rows(mysqli_query($con, $sqlt)) > 1) {
        $uname = $uname . $row1["name"] . ',';//set name to department name instead of gmail account name
        $_SESSION["name"] = $uname;
    } else {
        $uname = $row1["name"] . ',';//set name to department name instead of gmail account name
        $_SESSION["name"] = $uname;
    }
}*/
$totcomp = 0;//mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE Departmentname like'%" . $uname . "%'"));

$sqlt = "SELECT name from user WHERE email like '%" . $_SESSION['email'] . "%'";
$result1 = mysqli_query($con, $sqlt);
while ($row1 = mysqli_fetch_array($result1)) {
    $sql = "SELECT * FROM complain WHERE Departmentname like '%" . $row1['name'] . "%'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $totcomp += 1;
    }
}

$totpendingcomp = 0; //mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE (status='Pending' OR status='Pending#' ) AND Departmentname like'%" . $uname . "%'"));

$sqlt = "SELECT name from user WHERE email like '%" . $_SESSION['email'] . "%'";
$result1 = mysqli_query($con, $sqlt);
while ($row1 = mysqli_fetch_array($result1)) {
    $sql = "SELECT * FROM complain WHERE (status='Pending' OR status='Pending#' ) AND Departmentname like '%" . $row1['name'] . "%'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $totpendingcomp += 1;
    }
}


$totsolvedcomp = 0; //mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE  (status='Resolved' OR status='Resolved#' ) AND Departmentname like'%" . $uname . "%'"));
$sqlt = "SELECT name from user WHERE email like '%" . $_SESSION['email'] . "%'";
$result1 = mysqli_query($con, $sqlt);
while ($row1 = mysqli_fetch_array($result1)) {
    $sql = "SELECT * FROM complain WHERE (status='Resolved' OR status='Resolved#' ) AND Departmentname like '%" . $row1['name'] . "%'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $totsolvedcomp += 1;
    }
}

$totinprogresscomp = 0; //mysqli_num_rows(mysqli_query($con, "SELECT * FROM complain WHERE (status='In-Progress' OR status='In-Progress#' ) AND Departmentname like'%" . $uname . "%'"));
$sqlt = "SELECT name from user WHERE email like '%" . $_SESSION['email'] . "%'";
$result1 = mysqli_query($con, $sqlt);
while ($row1 = mysqli_fetch_array($result1)) {
    $sql = "SELECT * FROM complain WHERE (status='In-Progress' OR status='In-Progress#' ) AND Departmentname like '%" . $row1['name'] . "%'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $totinprogresscomp += 1;
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


                <li class="nav-item active ">
                    <a class="nav-link">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="./deptstatuscomplain.php?status=">
                        <i class="material-icons">content_paste</i>
                        <p>View Complain</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="./depthcancel.php">
                        <i class="material-icons">clear</i>
                        <p>Cancel Complains</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="./deptdocomplain.php">
                        <i class="material-icons">content_paste</i>
                        <p>Do Complain</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./deptmycomplain.php">
                        <i class="material-icons">content_paste</i>
                        <p>My Complains</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./deptpass.php">
                        <i class="material-icons">person</i>
                        <p>My Profile</p>
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
        <!-- End Navbar -->


        <?php
        if (!isset($_GET['id'])) {

            echo '
      <div class="content" id="complainDetail">
        <div class="container-fluid">
		<div class="row">
		  <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0"><b>Complains Status</b></h4>
                </div>
                </div>
                </div>
</div>            
			<br/>
		         <div class="row">
           <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">format_list_bulleted</i>
                  </div>
                  <p class="card-category">Complains</p>
                  <h3 class="card-title">' . $totcomp . '
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
				  
                    <i class="material-icons">content_paste</i><a href="./deptstatuscomplain.php?status=">View Details</a>

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
                  <div class="stats">
                    <i class="material-icons">error_outline</i><a href="./deptstatuscomplain.php?status=Pending">View Details</a>
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
                    <i class="material-icons">refresh</i><a href="./deptstatuscomplain.php?status=In-Progress">View Details</a>
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
                  <div class="stats">
                    <i class="material-icons">check</i><a href="./deptstatuscomplain.php?status=Solved">View Details</a>
                  </div>
                </div>
              </div>
            </div>
          </div>




	<br/>																
          <div class="row">
			
				<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">List of Complains</h4>
                  <p class="card-category">  </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
						
                        <th>
                          Dept
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
                      <tbody>
                     ';


            $sqlt = "SELECT name from user WHERE email like '%" . $_SESSION['email'] . "%'";
            $result1 = mysqli_query($con, $sqlt);
            while ($row1 = mysqli_fetch_array($result1)) {
                $sql = "SELECT * FROM complain WHERE Departmentname like '%" . $row1['name'] . "%'  ORDER BY id DESC";
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    //Creates a loop to dipslay all complain
                    echo " <tr><td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['Departmentname'] . "</td>";
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
                    echo '<td><button type="button" class="btn btn-primary" name="' . $row['id'] . '" onclick="takeAction(event)">Take Action</button></td></tr>';
                }
            }
            echo '</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
     </div>
	 
      </div>';

            include("footer.php");
            echo '  </div>';

        }
        ?>
        <!----     action form   ---->


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

            if (empty($upload_img)) {
                $upload = "";
            } else {

                /*$upload="
                <div class='form-group'>
                <a class='btn btn-primary' target='_blank' href='" .$upload_img."'>View Document</a>
                </div>";*/

                $upload = '<div class="col-lg-4 col-md-6 col-sm-6">

                <div class="card card-stats">
                <br>
                <div class="card-header card-header-warning card-header-icon">
                  
                  <p class="card-category text-left text-primary">Uploaded Document :</p>
                  
                </div>
                <div class="card-footer" style="margin-top:0px;">
                  <div class="stats">
                    <a class="btn btn-primary"  target="_blank" href="' . $upload_img . '">View Document</a>
                   
                  </h4>
                  </div>
                </div>
              </div>

                </div>';


            }

            //echo $a;

            echo '
	  <div class="content" >
        <div class="container-fluid">
	  <div class="row" id="complain">  

              
      <div class="col-md-8 offset-md-2">
              <div class="card" id="dept_card">
                <div class="card-header card-header-primary" style="margin:0">
                  <h4 class="card-title" id="complain_card">Complain Id : ' . $id . '</h4>
                  <!--
                  <p class="card-category">Complain By ' . $cname . '</p>
                  <p class="card-category">Mail id : ' . $cmail . '</p>
                  <p class="card-category">Date Time : ' . $dtym . '</p>
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
                  <div class="stats"  style="word-break: break-word">
                    <h4 class="card-title" style="font-weight:400">' . $cname . '
                   
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
                    <h4 class="card-title" style="font-weight:400 ">' . $cmail . '
                   
                  </h4>
                  </div>
                </div>
              </div>

                </div>

             <div class="col-lg-4 col-md-6 col-sm-6">

                <div class="card card-stats">
                <br>
                <div class="card-header card-header-warning card-header-icon">
                  
                  <p class="card-category text-left text-primary">Date Time :</p>
                  
                </div>
                <div class="card-footer" style="margin-top: 0px;">
                  <div class="stats" style="word-break: break-word">
                    <h4 class="card-title" style="font-weight:400">' . $dtym . '
                   
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
                  
                  <p class="card-category text-left text-primary">Building :</p>
                  
                </div>
                <div class="card-footer" style="margin-top: 0px;">
                  <div class="stats" style="word-break: break-word">
                    <h4 class="card-title" style="font-weight:400">' . $building . '
                   
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
                    <h4 class="card-title" style="font-weight:400">' . $location . '
                   
                  </h4>
                  </div>
                </div>
              </div>

                </div>' . $upload . '

  </div>



                 
				  
				 <!--
          <form action="" enctype="multipart/form-data" method="POST">
          <input type="hidden" id="cid" value="' . $id . '"  >
					<div class="form-group" id="building_input" style="">
                      <h6><u><b>Current Status</b></u></h6>
					  <input type="text" class="form-control " value="' . $cstatus . '"  disabled>
					  
                    </div>    
                    <div class="form-group" id="building_input" style="">
                      <h6><u><b>Building</b></u></h6>
					  <input type="text" class="form-control " value="' . $building . '" id="Building" disabled>
                    </div>    
                    <div class="form-group" >
                      <h6><u><b>location</b></u></h6>
					  <input type="text" class="form-control"  value="' . $location . '" id="location"  disabled>
                    </div>

                    -->

                     <div class="form-group">
                      
					<p class="card-category text-left text-primary" style="font-size:18px">Description :</p>
					<textarea class="form-control" name="complain_body" rows="5" id="complain_message" style="border: 1px solid #cacaca;
    padding: 10px;cursor: auto; " disabled>' . $description . '</textarea>
            
                      </div>';


            // echo $upload;

            $date = date("m-d-Y");


            $parts = explode('-', $date);
            $date = $parts[2] . '-' . $parts[0] . '-' . $parts[1];


            echo '
                    <form action="" method="POST">
                                     				                     
              
                      
                     
                    <hr>
						<div class="form-group">
						<div class="col-lg-12 col-md-12 col-sm-12">
						<h3 class="text-center text-primary" style="font-family: monoton; font-weight: 600;border: 1px solid #9c27b0;"><b>TAKE ACTION</b><h3>
						</div>
						</div>


              <div class="row">


              <div class="col-lg-4 col-md-6 col-sm-6">

                <div class="card card-stats">
                <br>
                <div class="card-header card-header-warning card-header-icon">
                  
                  <p class="card-category text-left text-primary">CHANGE STATUS :</p>
                  
                </div>
                <div class="card-footer" style="margin-top:0px;">
                  <div class="stats">
                    <div class="dropdown" >
                      <a class="btn btn-primary btn-block dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SELECT STATUS
                      </a>
            
                      <ul class="dropdown-menu btn-block" aria-labelledby="dropdownMenuLink" >
                        <li class="dropdown-item" id="item1" name="pending" href="#">Pending</li>
                        <li class="dropdown-item" id="item2" name="inprogress" href="#">In-Progress</li>
                        <li class="dropdown-item" id="item3" name="resolved" href="#">Resolved</li>
                      </ul>
                    </div>
                   
                  </h4>
                  </div>
                </div>
              </div>

                </div>


                <div class="col-lg-4 col-md-6 col-sm-6">

                <div class="card card-stats" id="start">
                <br>
                <div class="card-header card-header-warning card-header-icon">
                  
                  <p class="card-category text-left text-primary">Time Require(In Days) :</p>
                  
                </div>
                <div class="card-footer" style="margin-top:0px;">
                  <div class="stats">
                  <div class="form-group">
                     
                       <input type="number"  name="timer" class="form-control" style="" value=0>
                    </div>
                   
                   
                  </h4>
                  </div>
                </div>
              </div>




               <div class="card card-stats" id="expense" style="display:none">
                <br>
                <div class="card-header card-header-warning card-header-icon">
                  
                  <p class="card-category text-left text-primary">Total Expenditure(In Rs.):</p>
                  
                </div>
                <div class="card-footer" style="margin-top:0px;">
                  <div class="stats">
                  <div class="form-group">
                     
                       <input type="number" name="cost" class="form-control"  value=0>
                    </div>
                   
                   
                  </h4>
                  </div>
                </div>
              </div>



                </div>
                  <div class="col-lg-4 col-md-6 col-sm-6">

                <div class="card card-stats">
                <br>
                <div class="card-header card-header-warning card-header-icon">
                  
                  <p class="card-category text-left text-primary">Unable To Resolve:</p>
                    <input type="text"  name="remark" class="form-control" id="complainRemark" placeholder="Enter remark" onkeyup="stoppedTyping()">
                    
                </div>
                <div class="card-footer" style="margin-top: 0px;">
                  <div class="stats" style="word-break: break-word">
					
                     <input type="submit" class="btn btn-primary btn-block"  id="forwardComplain" name="forward_admin"  value="Forward Admin" onClick="return confirm(' . "'Are you sure you want to forward the complain?'" . ');" disabled>
                  
                  </div>
                </div>
              </div>

                </div>

</div>

    <input type="submit" name="reg_complain" class="btn btn-primary btn-block" value="Update Status">

									<!--			<div class="row">

                      <div class="col-md-12 col-sd-12">
                          <div class="dropdown" >
                      <a class="btn btn-primary btn-block dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        SELECT STATUS
                      </a>
					  
                      <ul class="dropdown-menu btn-block" aria-labelledby="dropdownMenuLink" >
                        <li class="dropdown-item" id="item1" name="pending" href="#">Pending</li>
                        <li class="dropdown-item" id="item2" name="inprogress" href="#">In-Progress</li>
                        <li class="dropdown-item" id="item3" name="resolved" href="#">Resolved</li>
                      </ul>
                    </div>
                    </div>
					</div>
					
					<br/>
						<div class="row">
					  <div class="col-md-12 col-sd-12">
                 
						<h6><u><b>Enter number of dasy required to solve problem</b></u></h6>
                      <input type="number" id="start" name="timer" style="display:none;">

                              </div>
                     </div>		

					 
					 <br/>

							  
					<div class="row">
					<div class="col-md-4 col-sd-12">
					
					<a href="./depthome.php" class="btn btn-primary btn-block">GO BACK</a>
					</div>
					
					<div class="col-md-4 col-sd-12">
					
					<input type="submit" name="reg_complain" class="btn btn-primary btn-block" value="Update Status">
					</div>
					<div class="col-md-4 col-sd-12">
					
					
					<input type="submit" class="btn btn-primary btn-block"  name="forward_admin"  value="Forward to Admin">
					</div>
					</div>-->

                    </form>';


            echo '<div class="clearfix"></div>
                 <!-- </form>-->
                </div>
              </div>
            </div>
          
      
          </div>
          </div>';

            include("footer.php");
            echo '</div>
		  
		  
		  
		  ';


        }


        if (isset($_POST['reg_complain'])) {

            if (isset($_COOKIE['status'])) {
                $status = $_COOKIE['status'];
            } else {
                $status = "Pending";
            }

            $timer = $_POST['timer'];
            $cost = $_POST['cost'];

//$sql7="UPDATE complain SET status='".$status."' , time_constraint=".$timer." ,cost=".$cost." WHERE id=".$id.";";
//echo $sql7;
            $query = mysqli_query($con, "UPDATE complain SET status='$status' , time_constraint='$timer' , cost='$cost' WHERE id='$id'");

            if ($_COOKIE['status'] == "Resolved") {


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


                $msg = "<strong>department:</strong> " . $department . "<br>
<strong>Building:</strong> " . $building . "<br>
<strong>Location:</strong> " . $location . "<br>
<strong>Description:</strong> " . $body . "<br><br>
<strong>YOUR COMPLAIN HAS BEEN RESOLVED</strong>";
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
                    $mail->setFrom($usermailid,$mailusername);
                    //$mail->addAddress("9833saurabhtiwari@gmail.com");
                    $mail->addAddress($mail_to);     // Add a recipient

                    // Attachments
                    //  if($file_path!="")
                    //  $mail->addAttachment($file_path);         // Add attachments
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    // Content
                    //$var=$_POST['body'];
                    //$var='Test';//$_POST['body'];
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Complain Resolved';
                    $mail->Body = $msg;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }


            }
            header("Location:depthome.php");

        }


        ?>






        <?php

        /*if(isset($_POST['pending'])){
          header("Location: dashboard.php");
        }*/

        ?>


        <!----end of complain-->


    </div>
    <!--   Core JS Files

  margin-top: 34px;
      left: -119px;
      color: #fff;
      background: #9c27b0;


      -->


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
    </script>

    <?php


    ?>


    <script>

        function takeAction(event) {

            // var building = document.getElementById('building');
            // var location = document.getElementById('location');
            // var msg = document.getElementById('complain_message');
            var id = event.target.name;

            window.open("depthome.php?id=" + id, "_self");


        }


        $(document).ready(function () {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();

        });
    </script>


    <?php

    if (isset($_POST['forward_admin'])) {


        $remark = $_POST['remark'];
        $remark = mysqli_real_escape_string($con, $remark);
        $sql7 = "INSERT INTO admincomplain (`ogid`, `remark`) values ($id,'" . $remark . "')";
//echo $sql7;
        $query = mysqli_query($con, $sql7);

        $query = mysqli_query($con, "SELECT email from user WHERE usertype='admin'");
        $row = mysqli_fetch_array($query);
        $mail_to = $row['email'];

        echo '<script>
                
		        $.ajax({              
                url:"complain_submit_ajax.php",
                type:"POST",
               
                data:"id=' . $id . '&mail_to=' . $mail_to . '",
                cache:false,

              
            }).done(function(data){
                console.log(data);
                window.location.href = "depthome.php";

            }).fail(function() { 
                alert( "Login with Somaiya mail" );
            });

            </script>';
        header("Location: depthome.php");
    }


    ?>


    <script>

        $("li").click(function () {

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
               data:"status="+val+"&id=<?php //echo $_GET['id']?>"
    }).done(function(){
      window.open("depthome.php","_self");
    });

*/

        });


    </script>


    <script type="text/javascript">


        function stoppedTyping() {
            var t = document.getElementById('complainRemark');
            if (t.value.length > 0) {
                document.getElementById('forwardComplain').disabled = false;
            } else {
                document.getElementById('forwardComplain').disabled = true;
            }
        }

        function verify() {
            /* if  is empty{
                 alert "Put some text in there!"
                 return
             }
             else{
                 do button functionality
             }
         */
        }
    </script>


</body>

</html>
