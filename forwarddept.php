<?php


include("config/config.php");

$deptn = $_GET['dept'] . ',';
$deptnm = $_GET['dept'];
$id = $_GET['id'];

$query = mysqli_query($con, "UPDATE complain SET Departmentname=concat( '$deptn',Departmentname)  WHERE id='$id'");
$result1 = mysqli_query($con, $query);


$var = '
<html lang="en">
<head>
</head>
<body>
<h4 style="text-align: center">Please wait</h4>
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
<script type="text/javascript">


    $.ajax({
        url: "complain_assign_ajax.php",
        type: "POST",
        data: "id=' . $id . '&department=' . $deptnm . '",
        cache: false,


    }).done(function (data) {
        console.log(data);
        window.location.href = "admindashboard.php";

    }).fail(function () {
        alert("Something went wrong");
    });


</script>
</body>
</html>
';
echo $var;


?>



