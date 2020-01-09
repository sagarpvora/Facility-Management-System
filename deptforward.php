<?php
include("checkuser.php");

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


                <li class="nav-item ">
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
                <li class="nav-item active">
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
                    <a class="navbar-brand" href="#"><b>Forwarded Complains</b></a>
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
		        
		
		';

            //if close
            echo '<div class="row">
			
				<div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">List of Forwarded Complains</h4>
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
                          Area Of Service
                        </th>
						<th>
                          Detail
                        </th>
                       
                        <th>
                          Date Time
                        </th>
                        <th>
						Your remark
							</th>
                        <th>
                          Admin Remark
                        </th>
						
						<th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                     ';


            $sqlt = "SELECT name from user WHERE email like '%" . $_SESSION['email'] . "%'";
            $result1 = mysqli_query($con, $sqlt);
            $deptnamearr = array();
            while ($row1 = mysqli_fetch_array($result1)) {
                $deptnamearr[] = $row1['name'];
            }


            //SELECT * FROM complain WHERE Departmentname='Carpentry' OR Departmentname='Networking' ORDER BY id DESC
            $sql = "SELECT complain.id,complaindate,description,status,Departmentname,remark,priority,admin_remark FROM complain INNER JOIN admincomplain ON admincomplain.ogid=complain.id
		AND ( Departmentname like '%" . $deptnamearr[0] . "%' ";
            $arrlength = count($deptnamearr);

            for ($x = 1; $x < $arrlength; $x++) {
                $sql = $sql . "OR Departmentname like '%" . $deptnamearr[$x] . "%'  ";
            }
            $sql = $sql . ")";

            $sql = $sql . "ORDER BY id DESC";


            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                //Creates a loop to dipslay all complain

                echo "<td>" . $row['id'] . "</td>";
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
                echo "<td>" . $row['remark'] . "</td>";


                echo "<td>" . $row['admin_remark'] . "</td>";
                echo '<td><button type="button" class="btn btn-primary" name="' . $row['id'] . '" onclick="takeAction(event)">Take Action</button></td></tr>';
            }
            // }//end outer while
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
              data:"status="+val+"&id=
    }).done(function(){
      window.open("depthome.php?id="+,"_self");
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
        $norowcom = mysqli_num_rows(mysqli_query($con, "select * from admincomplain where ogid=" . $id . " ;"));
        if (!$norowcom > 0) {
            $sql7 = "INSERT INTO admincomplain (`ogid`, `remark`) values ($id,'" . $remark . "')";
//echo $sql7;
            $query = mysqli_query($con, $sql7);

            $query = mysqli_query($con, "SELECT email from user WHERE usertype='admin'");
            $row = mysqli_fetch_array($query);
            $mail_to = $row['email'];

            //////// Quoatatio////////////////


            $uploadOk = 1;
            $tmpFilePath = $_FILES['upload']['tmp_name'];//[$i];

            echo "<script>alert('tmp  " . $tmpFilePath . "');</script>";
            $file_path = '';

            //Make sure we have a filepath
            if ($tmpFilePath != "") {

                if ($_FILES["upload"]["size"] < 25000000) {
                    //save the filename
                    $shortname = $_FILES['upload']['name'];

                    //save the url and the file
                    $filePath = "$filerootpath" . date('d-m-Y-H-i-s') . '-' . $_FILES['upload']['name'];
                    //$filePath = date('d-m-Y-H-i-s') . '-' . $_FILES['upload']['name'];

                    $imageFileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));


                    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "pdf") {

                        //echo $imageFileType;
                        //Upload the file into the temp dir
                        //  if(move_uploaded_file($tmpFilePath, $filePath)) {
                        //echo "<script>alert('tmpFilePath   " . $tmpFilePath . "');</script>";

                        //if (move_uploaded_file($tmpFilePath, $filePath))
                        // echo "<script>alert('done   ');</script>";
                        //else
                        move_uploaded_file($tmpFilePath, $filePath);
                        //  echo "<script>alert('error ');</script>";
                        //echo "<script>alert('file   " . $filePath . "');</script>";
                        //$files[] = $shortname;
                        $file_path = $filePath;
                        //insert into db
                        //use $shortname for the filename
                        //use $filePath for the relative url to the file
                    } else {
                        $uploadOk = 0;
                        $msg = '<script>alert("Sorry, File format is not supported.")</script>';
                        echo $msg;
                        //  header("Location: complain.php?department=$department");
                    }
                    //}
                } else {
                    $uploadOk = 0;
                    $msg = '<script>alert("Sorry, your file should not be more than 25MB.")</script>';
                    echo $msg;
                    // header("Location: complain.php?department=$department");
                }


            }


            if ($uploadOk == 1) {

                $query = mysqli_query($con, "UPDATE complain SET quotation='$file_path' WHERE id='$id'");

            }


            /////quaotaion end here/////////////


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
            //  header("Location: depthome.php");
        } else {

            echo '<script>alert("Complain already forwarded ");
                window.location.href = "depthome.php";
            </script>';

        }

    }


    ?>


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


    <script type="text/javascript">

        /* $("input[name='number']").on("change", function(){

           var t=$("#timer_update").val();
           var c=$("#cost_update").val();
           var u=$("#dropdownMenuLink").val();

           if((u=='Resolved' || u=='In-Progress') && (t>0 || c>0)){
               document.getElementById('status_change').disabled = false;
           }else{
             document.getElementById('status_change').disabled = true;

           }

         }*/

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
