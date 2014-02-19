<?php
include'pushnotif.php';
include 'getDistance.php';

class helps{
	
		var $strHelpID; 
		var $strMemberID; 
		var $strCaption; 
		var $strCategory; 
		var $strLocationhelp;
		
		function getHelpID(){
			return $this->strHelpID;
		}
		function getMemberID(){
			return $this->strMemberID;
		}
		function getCaption(){
			return $this->strCaption;
		}
		function getCategory(){
			return $this->strCategory;
		}
		function getLocation(){
			return $this->strLocationhelp;
		}
		
		
		
		function setHelpID($ID){
			$this->strHelpID = $ID;
		}
		function setMemberID($MemberID){
			$this->strMemberID = $MemberID;
		}
		function setCaption($Caption){
			$this->strCaption = $Caption;
		}
		function setCategory($Category){
			$this->strCategory = $Category;
		}
		function setLocation($Location){
			$this->strLocationhelp = $Location;
		}
		
	}
	
	class HelpConnection{
		
		function configuration(){
			mysql_connect("localhost", "root", "") or die(mysql_error());
			mysql_select_db("helpme") or die(mysql_error());
		}
		
		
		
		function insertDataHelp($Help){
			$this->configuration();
			$strSQL = "INSERT INTO helplist (MemberID,Caption,Category,helptime,locationhelp) VALUES(
			".$Help->getMemberID()."
			,'".$Help->getCaption()."'
			,'".$Help->getCategory()."'
			,now()
			,'".$Help->getLocation()."'
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
		
		function searchCanHelp($Help){
			$this->configuration();
			//echo $Help->getCategory();
			//echo $Help->getMemberID();
			//$strSQL = "SELECT * FROM user WHERE skill='".$Help->getCategory()."'";
			$strSQL = "SELECT name,uri,location FROM user WHERE skill='MAKAN'";
			
			$objQuery = mysql_query($strSQL);
			while ($obResult=mysql_fetch_array($objQuery)){
				
				$rawPeoples[] = $obResult;
				//echo $obResult["uri"];
				//echo $obResult["location"];
			}
			
			
			$strSQL2 = "SELECT username,name,YEAR(curdate()) - YEAR(born) AS age,hp,Gender,hp FROM user WHERE MemberID='".$Help->getMemberID()."'";
			$objQuery2 = mysql_query($strSQL2);
			$obResult2 = mysql_fetch_array($objQuery2);
			if($obResult2){
				$username = $obResult2["username"];
				$name = $obResult2["name"];
				$age = $obResult2["age"];
				$sex = $obResult2["Gender"];
				$phonenumber = $obResult2["hp"];
				
			}else{
				echo mysql_error();
			}
			
			foreach($rawPeoples as $people){
				if(distHaversine($people["location"],$Help->getLocation())<=1){
					$device = new WindowsPhonePushClient($people["uri"]);
					$device->send_toast($username." Need Your Help !!", $Help->getCaption(),$name,$phonenumber,$age,$sex, $priority = WindowsPhonePushPriority::ToastImmediately);
					echo $people["name"];
					echo $people["uri"];
					
					
				}else{
					
				}
			}
			
			
			
			
			
		}
		
			
		
		
		
	}
	
?>