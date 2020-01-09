<?php
include("config/config.php");

//if(isset($_POST['user_from'])){

$user_to = $_POST['user_to'];
$user_from = $_POST['user_from'];
$mbody = $_POST['message_body'];

$tf = date("Y-m-d H:i:s");
$sq = "INSERT into messages values('','$user_to','$user_from','$mbody','$tf')";
mysqli_query($con, $sq);
$id = mysqli_insert_id($con);

//		header("Location: ./deptchat.php?user=".$user_to);


// }


?>