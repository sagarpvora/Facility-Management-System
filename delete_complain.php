<?php

include("config/config.php");


$cl = $_POST['cancel_id'];
if(isset($_POST['cancel_id'])){

$query = mysqli_query($con, "SELECT * FROM complain WHERE id='$cl'");

$row = mysqli_fetch_array($query);

$body = $row['description'];

$file_path = $row['complainimg'];

$department = $row['Departmentname'];
$name = $row['complainant'];
$email = $row['complainantmail'];
$building = $row['building'];

$location = $row['location'];
$datetime = $row['complaindate'];
$contactnum = $row['contactnum'];


$sq = "INSERT into cancelcomplain(description,complainimg,Departmentname,status,complainant,complainantmail,building,location,complaindate,complain_id,contactnum)
 values('$body','$file_path','$department','Pending','$name','$email','$building','$location','$datetime','$cl','$contactnum')";
//echo $sq;
mysqli_query($con, $sq);
$it = mysqli_insert_id($con);
$sql = "SELECT email FROM user where name='$department' ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$mail_to = $row['email'];


$var = '
	    <script src="assets/js/core/jquery.min.js"></script>

	    <script type="text/javascript">
        
      $.ajax({              
                url:"cancel_complain_ajax.php",
                type:"POST",
                data:"id=' . $it . '&mail_to=' . $mail_to . '",
                cache:false,

              
            }).done(function(data){
                console.log(data);   
                window.location.href = "index.php";
                
            }).fail(function() { 
                alert( "Something went wrong" );
            });
            </script>';


echo $var;

}
// header("Location: index.php");

?>
    <!DOCTYPE html>
    <html>
    <head>
        <link href="https://getbootstrap.com/docs/4.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                crossorigin="anonymous"></script>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <title> F M S S </title>
    </head>
    <body>
    <div class="wrapper" id="completebody" style="width:100% ; height:100%;">
        <b>Processing Please Wait...</b>
        <div class="d-flex justify-content-center" style="margin: 200px 200px">
            <div class="spinner-border" role="status" style="width:80px ; height:80px;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    </body>
    </html>

<?php
$sql9 = "DELETE FROM complain WHERE id='$cl'";
mysqli_query($con, $sql9);
?>