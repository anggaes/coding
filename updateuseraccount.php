<?php
	include 'user.php';
	
	/*$User = new users();
	$User->setID($_POST["sMemberID"]);
	$User->setUsername($_POST["sUsername"]);
	$User->setPassword($_POST["sPassword"]);
	$User->setEmail($_POST["sEmail"]);
	$User->setName($_POST["sName"]);
	$User->setAddress($_POST["sAddress"]);
	$User->setBirthDate($_POST["sBirthDate"]);
	$User->setMobile($_POST["sMobile"]);
	$User->setTwitterAcc($_POST["sTwitterAcc"]);
	$User->setSex($_POST["sSex"]);
	$User->setSkill($_POST["sSkill"]);
	$User->setURI($_POST["sURI"]);
	$User->setLocation($_POST["sLocation"]);*/
	
	$User = new users();
	$User->setID(5);
	$User->setUsername(jakaka);
	$User->setPassword(granas);
	$User->setEmail("hahahh@hahha.com");
	$User->setName();
	$User->setAddress();
	$User->setBirthDate();
	$User->setMobile();
	$User->setTwitterAcc();
	$User->setSex();
	$User->setSkill();
	$User->setURI();
	$User->setLocation("3.56227,98.65864");
	
	$Connection = new UserConnection();
	$Connection->UpdateDataUser($User);
?>