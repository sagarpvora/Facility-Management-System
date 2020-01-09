<?php
//session_start();
include("checkuser.php");
$uname = $_SESSION["name"];


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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
	

</head>

<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
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
                </li>


                
                <li class="nav-item">
                    <a class="nav-link" href="./depthome.php">
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
                <li class="nav-item active">
                    <a class="nav-link" href="./deptchat.php?user=Carpentry">
                        <i class="material-icons">content_paste</i>
                        <p>Chat</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./deptpass.php">
                        <i class="material-icons">person</i>
                        <p>My Profile</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./deptreport.php">
                        <i class="material-icons">person</i>
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
                    <a class="navbar-brand" href="#pablo">Dashboard</a>
                </div>


                <div class="collapse navbar-collapse justify-content-end">

                    <ul class="navbar-nav">


                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="#">User Name</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
         <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header card-header-tabs card-header-primary">
                                <h4 class="card-title">Select department to view complains </h4>
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
                                                $active="";
                                                if($dptname==$_GET['user']){
                                                	$active="  active";
                                                }
                                                if($dptname==$uname)
                                                	continue;

                                                echo '<li class="nav-item">';
                                                echo "<a class='nav-link".$active." ";
                                               /* if ($row['id'] == 1)
                                                    echo ' active';*/
                                                echo "' href='./deptchat.php?user=" . $row['dname'] . "'>";
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

                            	<div id="scroll_body" style="overflow:auto; padding: 50px 20px 20px 20px; max-height:450px">


                            	<?php 
                            				////////////////




                            	if(isset($_GET['user'])){

                            	$data="";
                            	$user_to=$_GET['user'];
                            	$user_from=$uname;
							//$update = mysqli_query($con,"UPDATE messages SET opened='yes' WHERE (user_to='$userLoggedIn' AND user_from='$otherUser'");
							$query = mysqli_query($con,"SELECT * FROM messages WHERE (user_to='$user_to' and user_from='$user_from') OR (user_to='$user_from' and user_from='$user_to') ");
							while($row = mysqli_fetch_array($query)){
								$user_to=$row['user_to'];
								$user_from=$row['user_from'];
								$body=$row['body'];
								$split = explode(" ",$row['date']);
								$div_top=($user_to == $uname)? "<div class='messages' id='green'>" : "<div class='messages' id='blue'>";
								//$deptname = "<br><div style='float:right; font-size:12px; color:#fff;'>.$row[].</div>";
							$datetime = "<br><div style='float:right; font-size:12px; color:#fff;'>".$split[1]."</div>";
								$data = $data . $div_top . $body .$datetime. "</div><br><br><br>";

								
							}
							echo $data;
							}/*else if(isset($_GET['id'])){
								$user_to = $_GET['user'];

								$d = $_GET['id'];
								$r = "SELECT * from messages where id='$d'";
								$quer = mysqli_query($con,$r);
								$ro = mysqli_fetch_array($quer);
								$mess = $ro['body'];
								$data = '';
								$div_top=($user_to == $uname)? "<div class='messages' id='green'>" : "<div class='messages' id='blue'>";
								$data = $data . $div_top . $mess . "</div><br><br>";

							}*/
                            				///////////////

                            	 ?>





          							<form action="message_submit_ajax.php" method="POST">
                                	<?php 
                                	echo "
                                	<input type='hidden' value='".$_GET['user']."' name='user_to' />
                                	<input type='hidden' value='".$uname."' name='user_from' />
                                	<textarea name='message_body' class='form-control' style='width:85%;' placeholder='Write a message ...'></textarea>";
 					echo "<input type='submit' name='post_message' class='info' id='message_submit' style='float:right; top:-30px' value='Send'>";
 					 ?>
 					 				</form>
                                </div>
                            </div>
                    </div>
                </div>

            </div>
            <!--  <footer class="footer">
                <div class="container-fluid">
                  <nav class="float-left">
                    <ul>
                      <li>
                        <a href="https://www.creative-tim.com">
                          Creative Tim
                        </a>
                      </li>
                      <li>
                        <a href="https://creative-tim.com/presentation">
                          About Us
                        </a>
                      </li>
                      <li>
                        <a href="http://blog.creative-tim.com">
                          Blog
                        </a>
                      </li>
                      <li>
                        <a href="https://www.creative-tim.com/license">
                          Licenses
                        </a>
                      </li>
                    </ul>
                  </nav>
                  <div class="copyright float-right">
                    &copy;
                    <script>
                      document.write(new Date().getFullYear())
                    </script>, made with <i class="material-icons">favorite</i> by
                    <a href="#" target="_blank">Complain box</a>
                  </div>
                </div>
              </footer>-->
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
        $(document).ready(function () {
            // Javascript method's body can be found in assets/js/demos.js
            md.initDashboardPageCharts();

        });

    </script>
    <script>
		var div = document.getElementById('scroll_body');
		div.scrollTop = div.scrollHeight;
	</script>



     <?php 

/*   if(isset($_POST['post_message'])){


    	




    	$mbody = $_POST['message_body'];

    	if($mbody != ''){
    		$user_to=$_GET['user'];
			$user_from=$uname;
    		$mbody = mysqli_real_escape_string($con,$mbody);


    		 $var = '<script type="text/javascript">
    		 	
        
		      $.ajax({              
		                url:"message_submit_ajax.php",
		                type:"POST",
		                data:"user_to=' . $user_to . '&user_from=' . $user_from . '&mbody='.$mbody.'",
		                cache:false,

		              
		            }).done(function(data){
		                console.log(data);
		               

		            }).fail(function() { 
		                alert( "Something went wrong" );
		            });</script>';


    		
    	}

    	$mbody='';

    		
    }*/
   
     ?>



</body>

</html>