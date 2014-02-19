<?php
	include 'help.php';
	
	$Help = new helps();
	/*$Help->setMemberID($_GET["sMemberID"]);
	$Help->setCaption($_GET["sCaption"]);
	$Help->setCategory($_GET["sCategory"]);
	$Help->setLocation($_GET["sLocation"]);*/
	
	/*$Help->setMemberID($_POST["sMemberID"]);
	$Help->setCaption($_POST["sCaption"]);
	$Help->setCategory($_POST["sCategory"]);
	$Help->setLocation($_POST["sLocation"]);*/
	
	$Help->setMemberID(2);
	$Help->setCaption("TOLONG AKU MAKAN KECOA !");
	$Help->setCategory("minum");
	$Help->setLocation("3.56747,98.65881");
	
	$HConnection = new HelpConnection();
	$HConnection->insertDataHelp($Help);
	$HConnection->searchCanHelp($Help);
?>