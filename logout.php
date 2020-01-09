<?php
//require_once "finalconfig.php";


//Unset token and user data from session

//unset($_SESSION['type']);

//Reset OAuth access token
//$client = new Google_Client();
//$client->revokeToken();
session_start();
//Destroy entire session
session_destroy();


$helper = array_keys($_SESSION);
foreach ($helper as $key) {
    unset($_SESSION[$key]);
}


echo '
	<script>
	window.location.href = ("index.php");		
	</script>
 
	';


?>