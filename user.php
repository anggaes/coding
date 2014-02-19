<?php

	class users{
	
		var $strMemberID; 
		var $strUsername; 
		var $strPassword; 
		var $strEmail; 
		var $strName; 
		var $strAddress; 
		var $strBirthDate;
		var $strMobile;
		var $strTwitterAcc;
		var $strSex;
		var $strSkill;
		var $strLocation;
		var $strURI;
		
		function getID(){
			return $this->strMemberID;
		}
		function getUsername(){
			return $this->strUsername;
		}
		function getPassword(){
			return $this->strPassword;
		}
		function getEmail(){
			return $this->strEmail;
		}
		function getName(){
			return $this->strName;
		}
		function getAddress(){
			return $this->strAddress;
		}
		function getBirthDate(){
			return $this->strBirthDate;
		}
		function getMobile(){
			return $this->strMobile;
		}
		function getTwitterAcc(){
			return $this->strTwitterAcc;
		}
		function getSex(){
			return $this->strSex;
		}
		function getSkill(){
			return $this->strSkill;
		}
		function getURI(){
			return $this->strURI;
		}
		function getLocation(){
			return $this->strLocation;
		}
		
		
		function setID($ID){
			$this->strMemberID = $ID;
		}
		function setUsername($username){
			$this->strUsername = $username;
		}
		function setPassword($Pass){
			$this->strPassword = $Pass;
		}
		function setEmail($Email){
			$this->strEmail = $Email;
		}
		function setName($Name){
			$this->strName = $Name;
		}
		function setAddress($Address){
			$this->strAddress = $Address;
		}
		function setBirthDate($Date){
			$this->strBirthDate = $Date;
		}
		function setMobile($Mobile){
			$this->strMobile = $Mobile;
		}
		function setTwitterAcc($TwitAcc){
			$this->strTwitterAcc = $TwitAcc;
		}
		function setSex($Sex){
			$this->strSex = $Sex;
		}
		function setSkill($Skill){
			$this->strSkill = $Skill;
		}
		function setURI($URI){
			$this->strURI = $URI;
		}
		function setLocation($Location){
			$this->strLocation = $Location;
		}
	}
	
	class UserConnection{
		
		function configuration(){
			mysql_connect("localhost", "root", "") or die(mysql_error());
			mysql_select_db("helpme") or die(mysql_error());
		}
		
		//$User = new users;
		
		function insertDataUser($User){
			$this->configuration();
			$strSQL = "INSERT INTO user (Username,Password,Email,Name,Address,Born,Hp,Twitter_Account,Gender,Skill,Location,Uri) VALUES(
			'".$User->getUsername()."'
			,'".$User->getPassword()."'
			,'".$User->getEmail()."'
			,'".$User->getName()."'
			,'".$User->getAddress()."'
			,'".$User->getBirthdate()."'
			,'".$User->getMobile()."'
			,'".$User->getTwitterAcc()."'
			,'".$User->getSex()."'
			,'".$User->getSkill()."'
			,'".$User->getLocation()."'
			,'".$User->getUri."'
			)";
		
			$objQuery = mysql_query($strSQL);
			if(!$objQuery){
				echo "0|Cannot save data!";
				echo mysql_error();
			}else{
				echo "1| SUCCESS";
			}
			mysql_close();
		}
		
		function UpdateDataUser($User){
			$this->configuration();
			$strSQL = "UPDATE USER set
			username = '".$User->getUsername()."'
			,Password = '".$User->getPassword()."'
			,email = '".$User->getEmail()."'
			,name = '".$User->getName()."'
			,Address = '".$User->getAddress()."'
			,born = '".$User->getBirthDate()."'
			,hp = '".$User->getMobile()."'
			,Twitter_Account = '".$User->getTwitterAcc()."'
			,Gender = '".$User->getSex()."'
			,Skill = '".$User->getSkill()."'
			,location = '".$User->getLocation()."'
			,URI = '".$User->getURI()."'
			WHERE MemberID = '".$User->getID()."'";
		
			$objQuery = mysql_query($strSQL);
			if(!$objQuery){
				echo "0|Cannot save data!";
				echo mysql_error();
			}else{
				echo "1| SUCCESS";
			}
			mysql_close();
		}
		
		function UpdateLocationUser($User){
			$this->configuration();
			$strSQL = "UPDATE USER set
			location = '".$User->getLocation()."'
			WHERE username = '".$User->getUsername()."'";
		
			$objQuery = mysql_query($strSQL);
			if(!$objQuery){
				echo "0|Cannot save data!";
				echo mysql_error();
			}else{
				echo "1| SUCCESS";
			}
			mysql_close();
		}
		
		function CheckUserExist($User){
			$this->configuration();
			
			
			$strSQL = "SELECT * FROM user WHERE 1 
			AND username = '".$User->getUsername()."'  
			AND password = '".$User->getPassword()."'  
			";
			/*$strSQL = "SELECT * FROM user WHERE 1 
			AND username = 'anggaes'  
			AND password = 'ganas'  
			";*/
			$objQuery = mysql_query($strSQL);
			$objResult = mysql_fetch_array($objQuery);
			$intNumRows = mysql_num_rows($objQuery);
			if($intNumRows==0){
				echo "0|0|Incorrect Username and Password";
				echo mysql_error();
			}else{
				echo "1|".$objResult["MemberID"]."|";
			}
			mysql_close();
		}
		
		function getIDUserFromDB($User){
			$this->configuration();
			$strSQL = "SELECT MemberID FROM user WHERE 1 
			AND username = '".$User->getUsername()."'  
			AND password = '".$User->getPassword()."'  
			";
			
			
			$objQuery = mysql_query($strSQL);
			$objResult = mysql_fetch_array($objQuery);
			$intNumRows = mysql_num_rows($objQuery);
			if($intNumRows==0){
				echo "0|0|Incorrect Username and Password";
				echo mysql_error();
			}else{
				echo "1|".$objResult["MemberID"]."|";
			}
			mysql_close();
		}
		
		
	}

?>