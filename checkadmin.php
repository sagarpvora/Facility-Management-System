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

        } else {
            header("Location: index.php");
            exit();
        }
    }

}
?>