<?php

//verify and login user from gmail
include("config/config.php");
if (isset($_POST["id"])) {
    $_SESSION["id"] = $_POST["id"];
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["imgurl"] = $_POST["imgurl"];

    $sql = "SELECT usertype FROM user WHERE email like '%" . $_POST["email"] . "%'";
    $res = mysqli_query($con, $sql);
    $row = $res->fetch_assoc();
    $result = $con->query($sql);
    if ($row["usertype"] == "admin") {
        $sql2 = "UPDATE user SET imgurl='" . $_POST["imgurl"] . "' WHERE email='" . $_POST["email"] . "'";
        $con->query($sql2);
        $usertype = "admin";
        $_SESSION["type"] = "admin";
        echo $usertype;//return value to ajax
    } else if ($row["usertype"] == "Department") {
        $sql2 = "UPDATE user SET imgurl='" . $_POST["imgurl"] . "' WHERE email='" . $_POST["email"] . "'";
//        $sql2 = "UPDATE user SET head_name='" . $_POST["name"] . "' WHERE email='" . $_POST["email"] . "'";
        $con->query($sql2);
        $sql3 = "UPDATE user SET head_name='" . $_POST["name"] . "' WHERE email='" . $_POST["email"] . "'";
        $con->query($sql3);


		 $sql = "SELECT usertype FROM user WHERE email like '%" . $_POST["email"] . "%' AND usertype='Manager'";
    $res = mysqli_query($con, $sql);
    $row = $res->fetch_assoc();
	if(mysqli_num_rows($res)>0){
        $usertype = "Manager";
        $_SESSION["type"] = "Manager";
	}else{
		$usertype = "Department";																					   
	$_SESSION["type"] = "Department";
	}
        echo $usertype;//return value to ajax
    } else if ($row["usertype"] == "Manager") {
        $sql2 = "UPDATE user SET imgurl='" . $_POST["imgurl"] . "' WHERE email='" . $_POST["email"] . "'";
        $con->query($sql2);
        $usertype = "Manager";

        $_SESSION["type"] = "Manager";
        echo $usertype;//return value to ajax
    } else {
        if (!empty($result->fetch_assoc())) {
            $sql2 = "UPDATE user SET imgurl='" . $_POST["imgurl"] . "' WHERE email='" . $_POST["email"] . "'";
            $usertype = "User";
            $con->query($sql2);

            $_SESSION["type"] = "User";
            echo $usertype;
        } else {
            $sql2 = "INSERT INTO user (name, email,usertype,imgurl) VALUES ('" . $_POST["name"] . "', '" . $_POST["email"] . "', 'User','" . $_POST["imgurl"] . "')";
            $usertype = "Firstuser";
            $con->query($sql2);

            $_SESSION["type"] = "User";
            echo $usertype;
        }
    }

} else {
    header("Location: index.php");
    exit();
}
?>