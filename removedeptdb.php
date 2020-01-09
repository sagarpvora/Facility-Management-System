<?php
include("config/config.php");
if (isset($_POST['deptname'])) {

    $sql = "SELECT usertype FROM user WHERE email='" . $_SESSION["email"] . "'";
    $res = mysqli_query($con, $sql);
    $row = $res->fetch_assoc();

    if ($row['usertype'] = 'admin') {
        $deptname = $_POST['deptname'];

        $sqlque = "DELETE FROM department WHERE dname ='" . $deptname . "'";

        $res_u = mysqli_query($con, $sqlque);

        $sqlque = "DELETE FROM user WHERE name ='" . $deptname . "'";

        $res_u = mysqli_query($con, $sqlque);


        //header("Location: admindashboard.php");
        //exit();
    } else {
        echo "error";
    }
} else {
    echo "error";
}


?>