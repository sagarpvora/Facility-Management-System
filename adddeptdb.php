<?php

include("config/config.php");
if (!isset($_SESSION['name'])) {

    header("Location: index.php");
    exit();
} else {
    $sql = "SELECT usertype FROM user WHERE email='" . $_SESSION["email"] . "'";
    $res = mysqli_query($con, $sql);
    $row = $res->fetch_assoc();

    if ($row['usertype'] != 'admin') {
        if ($row['usertype'] == 'User') {
            header("Location: dashboard.php");
            exit();
        } else if ($row['usertype'] == 'Department') {
            header("Location: depthome.php");
            exit();
        } else if ($row['usertype'] == 'Manager') {
            header("Location: managerdashboard.php");
            exit();

        }


    }
}


$name = $_POST["departmentname"];
$pass = $_POST["passwrd1"];
$hmail = $_POST["headmail"];
$dimg = $_POST["deptimg"];

if (strpos($hmail, ',') !== false) {
    $dept_email_arr = explode(",", $hmail);
} else {
    $dept_email_arr = array($hmail);
}

$sql = "insert into department (dname,deptimg) values('$name','$dimg')";
mysqli_query($con, $sql);


$arrlength = count($dept_email_arr);
for ($x = 0; $x < $arrlength; $x++) {
    $hmail = $dept_email_arr[$x];
    $sqlque = "select * from user where email='" . $hmail . "' AND usertype='User'";
    $res_u = mysqli_query($con, $sqlque);

//echo mysqli_num_rows($res_u);
    if (mysqli_num_rows($res_u) == 1) {


        $sql = "update  user set name='$name',username='$name',email='$hmail',password='$pass',usertype='Department' where email='$hmail';";

        ///echo $sql;

        mysqli_query($con, $sql);


    } else {


        $sql = "insert into user (name,username,email,password,usertype) values('$name','$name','$hmail','$pass','Department')";
        mysqli_query($con, $sql);


    }

}
echo '

		<html>
        <body>

         <script src="assets/js/plugins/sweetalert2.js"></script>
        <script>
        swal("Department Added","","success");

        setTimeout(function(){

            window.location.href = "./admindashboard.php";

        },1000);
        </script>
        </body>
        </html>

		';

?>