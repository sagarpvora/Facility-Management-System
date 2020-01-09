<?php
include("config/config.php");
if (isset($_POST['departmentname'])) {
    $deptname = $_POST['departmentname'];

    $deptpasswd = $_POST['passwrd'];
    $deptmail = $_POST['heademail'];
    $deptid = $_POST['deptid'];
    $deptdid = $_POST['deptdid'];
    $deptoldname = $_POST['oldname'];

    $sqlque = "update department set dname='" . $deptname . "' WHERE id=$deptdid;";
    $res_u = mysqli_query($con, $sqlque);

    $sqlque = "update user set name='" . $deptname . "', username='" . $deptname . "' , email='" . $deptmail . "' ,password='" . $deptpasswd . "' WHERE id=$deptid";
    $res_u = mysqli_query($con, $sqlque);


    $sqlque = "update complain set Departmentname='" . $deptname . "' WHERE Departmentname='" . $deptoldname . "'";
    $res_u = mysqli_query($con, $sqlque);


    echo '
		
		<html>
<body>

  <script src="assets/js/plugins/sweetalert2.js"></script>
<script>
swal("Department Updated","","success");

setTimeout(function(){

	window.location.href = "./admindashboard.php";

},1000);			
</script>
</body>
</html>';
} else {
    header("Location: index.php");
    exit();
}


?>