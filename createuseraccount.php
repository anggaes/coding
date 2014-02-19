<?php
	include 'user.php';
	
	$User = new users();
	
	/*$User->setUsername("anggaesa");
	$User->setPassword("hahahah");
	$User->setEmail("anggaes12@gmail.com");
	$User->setName("Angga Eriansyah S");
	$User->setAddress("RANTAU");
	$User->setBirthDate("1992-10-17");
	$User->setMobile("081370482532");
	$User->setTwitterAcc("@anggaes");
	$User->setSex("MALE");
	$User->setSkill("MAKAN");
	$User->setLocation("");
	$User->setURI("");*/
	
	
	
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
	$User->setLocation($_POST["sLocation"]);
	$User->setURI($_POST["sURI"]);
	
	$Connection = new UserConnection();
	$Connection->insertDataUser($User);

?>