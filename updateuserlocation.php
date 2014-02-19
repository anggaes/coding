<?php
	include 'user.php';
	
	$User = new users();
	
	$User->setUsername($_POST["sUsername"]);
	$User->setLocation($_POST["sLocation"]);
	
	$Connection = new UserConnection();
	$Connection->UpdateLocationUser($User);
?>