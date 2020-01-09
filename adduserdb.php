<?php

//set  password and username for new user (first time user) to database

include("checkuser.php");

$name = $_POST["username"];
$pass = $_POST["passwrd1"];
$mail = $_SESSION['email'];

echo $name;
echo $mail;

$sqlque = "select * from user where username='" . $_POST["username"] . "'";
$res_u = mysqli_query($con, $sqlque);
echo mysqli_num_rows($res_u);


if (mysqli_num_rows($res_u) == 1) {
    //	echo "updating..";
    $sql = "Update user SET   password='$pass' WHERE email like '%$mail%';";
    mysqli_query($con, $sql);

    header('Location: admindashboard.php');
    exit();

} else {


    //echo'<script>alert("Username already exists.\nChoose different username");
    //window.location.href = "adminprofile.php";

    //</script>
    //';

}

?>