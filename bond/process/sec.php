<?php
	include("../../src/config.php");
	$cmd = isset($_GET['cmd'])?$_GET['cmd']:"";

	$o_bond = new Sec();
	switch($cmd)
	{		
		case "settings":
			include("../../src/reference/phpMQTT/phpMQTT.php");

			$devId = $_POST['devId'];
			$wdten = $_POST['wdten'];
			$serverIP = $_POST['serverIP'];
			$wdttime = $_POST['wdttime'];
			$mp = $_POST['mp'];

			$setStr = '{"devid":"'.$devId.'", "wdten":"'.$wdten.'", "serverip":"'.$serverIP.'", "wdttime":"'.$wdttime.'", "manual":"'.$mp.'"}';
//echo $setStr;
			//$mqtt = new phpMQTT("test.mosquitto.org", 1883, generateRandomString()); //Change client name to something unique
			$mqtt = new phpMQTT("localhost", 1883, generateRandomString()); //Change client name to something unique
			if ($mqtt->connect()) {
				$mqtt->publish("/remotepower/setting", $setStr,0);
				$mqtt->close();
			}else{
				//echo generateRandomString();
			}

			break;
		case "update":
			echo $o_bond->updateRecord();
			break;
		case "reboot":
			echo $o_bond->reboot();
			break;
		case "flash":
			echo $o_bond->flash();
			break;
			
		default:
			//checkLogTime();
			echo $o_bond->getRecords();
			break;
	}
?>
