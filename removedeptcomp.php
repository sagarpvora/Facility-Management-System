<?php


include("config/config.php");

$deptn = $_GET['dept'];
$id = $_GET['id'];

$query = "UPDATE complain SET 
	 Departmentname = replace(Departmentname , '$deptn,','')
	 WHERE id='$id'";
$result1 = mysqli_query($con, $query);


$query = "UPDATE complain SET 
	 Departmentname = replace(Departmentname , ',$deptn','')
	 WHERE id='$id'";
$result1 = mysqli_query($con, $query);

header("Location: admindashboard.php");
exit();

?>