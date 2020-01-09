<?php

//verify and login user from gmail
include("config/config.php");
$myid=123456;
$myname="Sohil Luhar";
$myemail="pranish@somaiya.edu";
$myimgurl="Sohil Luhar";
if (isset($myid)) {
    $_SESSION["id"] = $myid;
    $_SESSION["name"] = $myname;
    $_SESSION["email"] = $myemail;
    $_SESSION["imgurl"] = $myimgurl;

    $sql = "SELECT usertype FROM user WHERE email like '%" . $myemail . "%'";
    $res = mysqli_query($con, $sql);
    $row = $res->fetch_assoc();
    $result = $con->query($sql);
    if ($row["usertype"] == "admin") {
        $sql2 = "UPDATE user SET imgurl='" . $myimgurl . "' WHERE email='" . $myemail . "'";
        $con->query($sql2);
        $usertype = "admin";
        $_SESSION["type"] = "admin";
        echo $usertype;//return value to ajax
    } else if ($row["usertype"] == "Department") {
        $sql2 = "UPDATE user SET imgurl='" . $myimgurl . "' WHERE email='" . $myemail . "'";
//        $sql2 = "UPDATE user SET head_name='" . $myname . "' WHERE email='" . $myemail . "'";
        $con->query($sql2);
        $sql3 = "UPDATE user SET head_name='" . $myname . "' WHERE email='" . $myemail . "'";
        $con->query($sql3);


		 $sql = "SELECT usertype FROM user WHERE email like '%" . $myemail . "%' AND usertype='Manager'";
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
        $sql2 = "UPDATE user SET imgurl='" . $myimgurl . "' WHERE email='" . $myemail . "'";
        $con->query($sql2);
        $usertype = "Manager";

        $_SESSION["type"] = "Manager";
        echo $usertype;//return value to ajax
    } else {
        if (!empty($result->fetch_assoc())) {
            $sql2 = "UPDATE user SET imgurl='" . $myimgurl . "' WHERE email='" . $myemail . "'";
            $usertype = "User";
            $con->query($sql2);

            $_SESSION["type"] = "User";
            echo $usertype;
        } else {
            $sql2 = "INSERT INTO user (name, email,usertype,imgurl) VALUES ('" . $myname . "', '" . $myemail . "', 'User','" . $myimgurl . "')";
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