<?php
//session_start();


include("config/config.php");
if (isset($_SESSION['name'])) {
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $img = $_SESSION['imgurl'];
} else {
    header("Location: index.php");
    exit();
}
//dashboard of normal user
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

<body>
<div class="wrapper" id="completebody">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar.jpg">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo" style="
    background: white;
">
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
                            <h5 class="card-title">    <?php echo $_SESSION['name']; ?></h5>
                        </div>

                    </div>
                </li>


                <li class="nav-item active ">
                    <a class="nav-link" href="">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="./usercomplain.php?status=">
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
    <div class="main-panel" data-background-color="white">
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
        <div class="content">
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
                        <div class="card card-stats" style="box-shadow:none;">
                            <div class="card-header card-header-danger card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">format_list_bulleted</i>
                                </div>
                                <p class="card-category">Complains</p>
                                <h3 class="card-title"><?php echo $totcomp ?>
                                </h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <a href="./usercomplain.php?status=">View Details</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats" style="box-shadow:none;">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-clock-o"></i>

                                </div>
                                <p class="card-category">Pending</p>
                                <h3 class="card-title"><?php echo $totpendingcomp ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats"><a href="./usercomplain.php?status=Pending">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats" style="box-shadow:none;">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-refresh"></i>
                                </div>
                                <p class="card-category">In Progress</p>
                                <h3 class="card-title"><?php echo $totinprogresscomp ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats"><a href="./usercomplain.php?status=In-Progress">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6" style="box-shadow:none;">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="fa fa-check-square-o"></i>

                                </div>
                                <p class="card-category">Solved</p>
                                <h3 class="card-title"><?php echo $totsolvedcomp ?></h3>
                            </div>
                            <div class="card-footer">
                                <div class="stats"><a href="./usercomplain.php?status=Solved">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title mt-0"><b>Select Area of Service</b></h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <?php


                    $sql = "SELECT * FROM department ORDER BY dname";
                    $result = mysqli_query($con, $sql);
                    //display all department
                    while ($row = mysqli_fetch_array($result)) {
                        $dptname = $row['dname'];
                        if ($row['dname'] == 'Emergency') {
                            continue;
                        }
                        echo '     <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header ">';

                        echo "<form method='POST' action='' id=" . $row['id'] . ">";
                        echo " <input type='hidden' name='department' value=" . $row['dname'] . ">";
                        echo '		</br>
                  <h3 class="card-title text-center" name="' . $row["dname"] . '"><b>' . $row["dname"] . '</b></h3>									  
				</br>
				<a href="#complain" class="btn btn-info btn-block" name="' . $row["dname"] . '" onClick="scrollToBottom(event)">Complain</a>
				
				</form>
				</div>
              </div>
            </div>';
                    }

                    $sql = "SELECT * FROM department WHERE dname='Emergency'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    echo '     <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header "style="background: #f44336;">';

                    echo "<form method='POST' action='' id=" . $row['id'] . ">";
                    echo " <input type='hidden' name='department' value=" . $row['dname'] . ">";
                    echo '		</br>
                  <h3 class="card-title text-center" style="    color: white;" name="' . $row["dname"] . '"><b>' . $row["dname"] . '</b></h3>
				</br>
				<a href="#complain" class="btn btn-info btn-block" name="' . $row["dname"] . '" onClick="scrollToBottom(event)">Complain</a>

				</form>
				</div>
              </div>
            </div>';
                    ?>

                </div>

                <br/>
                <div class="row" style="display: none" id="complain">

                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title mt-0"><b>Fill Complain Form</b></h4>
                            </div>
                        </div>
                    </div>
                    <br/>

                    <div id="emergency_dept"></div>


                    <br>

                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-header card-header-primary" style="
    margin: 0;
">
                                <h4 class="card-title" id="complain_card"></h4>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body">
                                <form action="" enctype="multipart/form-data" style="margin-top: -40px;"
                                      method="POST">
                                    <br/>
                                    <br/>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <!--   <label for="dropCompulsion" style="margin-bottom: 5px">Location:</label> -->

                                            <label for="dropCompulsion"
                                                   style="margin-bottom: 5px; color: #9128ac">Building:</label>

                                            <input type="text" class="form-control" id="dropCompulsion"
                                                   placeholder="Choose Building" spellcheck="false"
                                                   name="buildingOption" required/>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <br>
                                            <div class="dropdown" required>
                                                <a class="btn btn-primary dropdown-toggle " href="#" role="button"
                                                   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                   aria-expanded="false">Options </a>

                                                <ul class="dropdown-menu" style="cursor:pointer;"
                                                    aria-labelledby="dropdownMenuLink" name="ul" required>
                                                    <li class="dropdown-item" id="item2" href="#">ARYABHATTA(A)</li>
                                                    <li class="dropdown-item" id="item3" href="#">BHASKARACHARYA(B)</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group" style="margin-top: 25px;">
                                        <label for="exampleFormControlInput1"
                                               style="margin-bottom: 5px; color: #9128ac">Location:</label>

                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                               name="location" placeholder="Eg: Room no,Lab name,Campus area..."
                                               required>
                                    </div>

                                    <div class="form-group" style="margin-top: 25px;">


                                        <label style="margin-bottom: 5px; color: #9128ac"
                                               for="exampleFormControlInput2">
                                            Describe your complain
                                        </label>

                                        <textarea class="form-control" name="complain_body" rows="5"
                                                  id="exampleFormControlInput2"
                                                  placeholder="(If complain is regarding laptop/desktop/projector please specify model number, brand name and DSR number)"
                                                  required
                                        ></textarea>

                                    </div>


                                    <div class="form-group">

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <label class="bmd-label-floating">Supporting
                                                    Document(Optional)</label>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <!--<label for="upload"
                                                    style="margin: 0px 70px 10px 228px;
                                                        border: 3px solid #9c27b0;
                                                        border-radius: 13px;
                                                        padding: 5px;
                                                        background-color: #9c27b0;
                                                        color: white;
                                                        cursor: pointer;">Upload File</label>
                                                        -->
                                                <label for="upload" class="btn btn-primary">Upload</label>
                                                <input id='upload' name="upload" type="file">
                                                <!--       <div id="file-upload-filename" style=" margin: 0px 70px 10px 213px;"></div>
                                                 <input type="file" class="form-control-file" id="exampleFormControlFile1">-->

                                            </div>
                                        </div>


                                        <div id="file-upload-filename"></div>
                                    </div>

                                    <script type="text/css">
                                        input[type="file"] {
                                            z-index: -1;
                                            position: absolute;
                                            opacity: 0;
                                        }

                                        input:focus + label {
                                            outline: 2px solid;
                                        }
                                    </script>


                                    <script type="text/javascript">


                                        var input = document.getElementById('upload');
                                        var infoArea = document.getElementById('file-upload-filename');

                                        input.addEventListener('change', showFileName);

                                        function showFileName(event) {

                                            // the change event gives us the input it occurred in
                                            var input = event.srcElement;

                                            // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
                                            var fileName = input.files[0].name;

                                            // use fileName however fits your app best, i.e. add it into a div
                                            var res = fileName.split(".");
                                            if (res[res.length - 1] == "jpg" || res[res.length - 1] == "jpeg" || res[res.length - 1] == "pdf" || res[res.length - 1] == "png") {
                                                infoArea.textContent = 'File name: ' + fileName;
                                                $("#file-upload-filename").css("color", "blue");
                                                $("#file_test").show();
                                            } else {
                                                $("#file-upload-filename").css("color", "red");
                                                infoArea.textContent = "*Following file format is not supported! (only images or pdf)";
                                                $("#file_test").hide();
                                            }

                                        }


                                    </script>


                                    <div class="form-group" style="margin-top: 25px;">
                                        <label for="exampleFormControlInput1"
                                               style="margin-bottom: 5px; color: #9128ac">Phone/Extension
                                            Number:</label>
                                        <?php
                                        $row = mysqli_fetch_array(mysqli_query($con, "SELECT contactnum FROM user WHERE email='" . $email . "'"));
                                        $conta = $row['contactnum'];

                                        echo '<input type="number" class="form-control" id="contactnumber"
                                               name="contactnumber"
                                               value="' . $conta . '" min="0"
                                               required>';
                                        ?>
                                    </div>

                                    <label for="exampleFormControlInput1"
                                           style="margin-bottom: 20px; color: #9128ac">Complain Severity: </label>


                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="radio" id="customRadio1"
                                               class="custom-control-input"
                                               value="Low">
                                        <label class="custom-control-label" style="
									color: black;" for="customRadio1" required>Low</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="radio" id="customRadio2"
                                               class="custom-control-input"
                                               value="Medium">
                                        <label class="custom-control-label" style="
									color: black;" for="customRadio2" required>Medium</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="radio" id="customRadio3"
                                               class="custom-control-input"
                                               value="High">
                                        <label class="custom-control-label" style="
									color: black;" for="customRadio3" required>High</label>
                                    </div>


                                    <!--<div class="input-group">


                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="radio" aria-label="Radio button for following text input"> Urgent
                                </div>

                                <div class="input-group-text">
                                <input type="radio" aria-label="Radio button for following text input"> Intermediate
                                </div>

                                <div class="input-group-text">
                                <input type="radio" aria-label="Radio button for following text input"> Common
                                </div>

                              </div>

                            </div>-->
                                    <br>


                                    <input type="submit"
                                           id="file_test"
                                           name="com_submit" class="btn btn-primary" value="Submit">

                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>


            </div>

        </div>

        <?php
        include("footer.php");
        if (isset($_COOKIE['dname']))
            $department = $_COOKIE['dname'];
        ?>


    </div>
</div>


<script src="assets/js/core/jquery.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap-material-design.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>


<!--  Plugin for Sweet Alert -->
<script src="assets/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="assets/js/plugins/jquery.validate.min.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>


<script>

    function scrollToBottom(event) {
        var build = "";
        var y = document.getElementById("complain_card");
        var em = document.getElementById("emergency_dept");

        var dname = event.target.name;
        y.innerHTML = "Service : " + dname;

        var cmp = dname.localeCompare("Emergency");
        if (cmp == 0) {
            em.innerHTML = '  <div class="col-md-8 offset-md-2">\n' +
                '                        <div class="card">\n' +
                '                            <div class="card-header card-header-danger" style="margin: 0;">\n' +
                '                                <h4 class="card-title" id="emergency_dept">Please DO NOT complain here unless your complaint requires immediate action.</h4>\n' +
                '                                <p class="card-category"> Your mail id, name and other details will be recorded </p>\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>  ';
        } else {
            em.innerHTML = '';
        }
        window.scrollTo(0, document.querySelector("#complain").scrollHeight);
        //var dname=event.target.name;
        document.cookie = "dname=" + dname;
        var z = document.getElementById("complain");
        z.style.display = "block";


    }


</script>


<?php
if (isset($_POST['com_submit'])) {


    /* echo '<script>
   alert(document.getElementById("dropdownMenuLink").textContent);
    var build= $("#dropdownMenuLink").text();
   </script>';*/
    /*echo '<script>
      if( typeof build == "undefined"){
      }
    </script>';*/
    $location = $_POST['location'];
    $building = $_POST['buildingOption'];
    /*  if (isset($_COOKIE['building'])) {
        $building = $_COOKIE['building'];
      }else{
        $building='none';
      }
      */

    $complain_body = $_POST['complain_body'];
    $contactnumber = $_POST['contactnumber'];
    $priority = $_POST['radio'];
    // echo $contactnumber;
    if ($complain_body != '') {
        $body = mysqli_real_escape_string($con, $complain_body);
        $location = mysqli_real_escape_string($con, $location);


        //  if(isset($_POST['submit'])){
        // if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        // for($i=0; $i<count($_FILES['upload']['name']); $i++) {
        //Get the temp file path

        $uploadOk = 1;
        $tmpFilePath = $_FILES['upload']['tmp_name'];//[$i];
        $file_path = '';

        //Make sure we have a filepath
        if ($tmpFilePath != "") {

            if ($_FILES["upload"]["size"] < 25000000) {
                //save the filename
                $shortname = $_FILES['upload']['name'];

                //save the url and the file
                $filePath = "$filerootpath" . date('d-m-Y-H-i-s') . '-' . $_FILES['upload']['name'];

                $imageFileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));


                if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "pdf" ||
                    $imageFileType == "PDF" || $imageFileType == "JPG" || $imageFileType == "JPEG" || $imageFileType == "PNG") {

                    //echo $imageFileType;
                    //Upload the file into the temp dir
                    /*if (move_uploaded_file($tmpFilePath, $filePath)) {

                   //     $msg = '<script>alert("DOne.")</script>';
                     //   echo $msg;
                    } else {
                        $msg = '<script>alert("tmp path= ' . $tmpFilePath . '     filepath=  ' . $filePath . '")</script>';
                        echo $msg;

                    }*/
                    move_uploaded_file($tmpFilePath, $filePath);
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
        // }
        //}
        /* echo $tmpFilePath;
         echo $shortname;*/

        //show success message
        // echo "<h1>Uploaded:</h1>";
        /*if(is_array($files)){
            echo "<ul>";
            foreach($files as $file){
                echo "<li>$file</li>";
            }
            echo "</ul>";
        }*/
//}

        /* if(isset($_GET['id'])){
           $id=$_GET['id'];

         $update = mysqli_query($con,"UPDATE complain SET description='$body',Departmentname='$department' ,complainant='$name' WHERE id=$id");
           }else{
         $query =  mysqli_query($con,"INSERT INTO complain (description,complainantmail,status,Departmentname,complainant) values('','$body','$email','Pending','$department','$name')");
          }*/


        // $query =  mysqli_query($con,"INSERT INTO complain (description,complainantmail,status,Departmentname,complainant);


        if ($uploadOk == 1) {

            $datetime = date("Y-m-d H:i:s");
            //$datetime = date("d-M-Y H:i");
            //    $datetime = date('m/d/Y H:i:s ', time());
            echo '
<style>
/* Center the loader */

#loader {
  	position: relative;
	top: 50%;
	margin: 60px auto auto auto;
  border:5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


#myDiv {
  display: none;
  text-align: center;
}
</style>
<script>
document.getElementById("completebody").style.display = "none";
</script>


<h4 style="text-align: center">Processing please wait...</h4>
<div id="loader">

</div>


';


            //UPDATE `user` SET `contactnum` = '9833' WHERE `user`.`id` = 32;
            $sql78 = "UPDATE user SET contactnum = '$contactnumber' WHERE   email='" . $email . "'";
            //echo $sql78;
            mysqli_query($con, $sql78);

            $sql79 = "INSERT into complain(priority,description,complainimg,Departmentname,status,complainant,complainantmail,building,location,complaindate,contactnum) 
                    values('$priority','$body','$file_path','$department','Pending','$name','$email','$building','$location','$datetime','$contactnumber')";
            // echo $sql79;
            mysqli_query($con, $sql79);

            $id = mysqli_insert_id($con);


            //unset($_COOKIE['building']);


            $sql = "SELECT email FROM user where name='$department' ";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $mail_to = $row['email'];


            $var = '<script type="text/javascript">

        
      $.ajax({              
                url:"complain_submit_ajax.php",
                type:"POST",
                data:"id=' . $id . '&department=' . $department . '",
                cache:false,

              
            }).done(function(data){
                console.log(data);
               //window.location.href = "dashboard.php";

            }).fail(function() { 
                alert( "Something went wrong" );
            });
			
	$.ajax({              
                url:"complain_submit_by_ajax.php",
                type:"POST",
                data:"id=' . $id . '&mail_by=' . $email . '",
                cache:false,

              
            }).done(function(data){
				
                console.log(data);
 document.getElementById("loader").style.display = "none";
  document.getElementById("completebody").style.display = "block";
				window.location.href = "dashboard.php";

            }).fail(function() { 
                alert( "something went wrong!" );
            });
			
			
          </script>';
            echo $var;


        } else {
            // $msg='<script>alert("Sorry, Something went wrong.")</script>';
            //echo $msg;
            //header("Location: complain.php?department=$department");

        }
    }


}

?>


<!--/form-->

<script>
    $(".dropdown-item").click(function () {

        /* var se = document.getElementById('dropdownMenuLink');
         se.innerHTML = $(this).text();*/
        var se = document.getElementById('dropCompulsion');
        se.value = $(this).text();

        document.cookie = "building=" + $(this).text();
        // $("#dropdownMenuLink").innerHTML=$(this).text();
        // build = $(this).text();

    });
</script>


</body>
</html>

