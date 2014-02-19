<?php

	include 'user.php';
	
	$User = new users();
	$_POST["sUsername"] = "hjj";
	$_POST["sPassword"] = "";
	
	//$User->setUsername("haha");
	///$User->setPassword("baka");
	
	//$User->setUsername($_POST["sUsername"]);
	//$User->setPassword($_POST["sPassword"]);
	
	$User->setUsername($_POST["sUsername"]);
	$User->setPassword($_POST["sPassword"]);
	
	
	$Connection = new UserConnection();
	$Connection->CheckUserExist($User);
?>