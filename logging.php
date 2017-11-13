
<?php

//require("../config.php");
require("/var/www/html/rpb/src/config.php");
mysqli_query($_db, "set names utf8");

/*
$msg = '{"devid":"Remote_62:01:94:06:62:42","localip":"192.168.1.135","actiontype":"Relay for Power ON","message":"","wdten":true,"status":" Relay for power 
on","serverip":"192.168.1.199","wdttime":10}';

$search = array("\r\n", "\n");
	$msg = str_replace(array("\r\n", "\n", "\r"), '', $msg);

	$arr = json_decode($msg, true);
 
	if( !$arr ){
		//echo "error";
		return;
	}

	$devId = $arr["devid"];
	$actionType = $arr["actiontype"];
	$message = $arr["message"];

	$sql = "insert into ".TBL_LOGGING." set devId='$devId', actionType='$actionType', message='$message', logTime='".date("Y-m-d H:i:s")."'";
	$result = mysqli_query($_db, $sql);

	$devId = $arr["devid"];
	$status = $arr["status"];
	$wdten = ($arr["wdten"]=="")?"0":"1";
	$serverIP = $arr["serverip"];
	$wdttime = $arr["wdttime"];
	$localIP = $arr["localip"];

	$sql = "update ".TBL_STATUS." set status='$status', wdten='$wdten', serverIp='$serverIP', wdttime='$wdttime', localIP='$localIP', statusTime='".date("Y-m-d H:i:s")."' where devId='$devId'";
	//echo $sql;
	$result = mysqli_query($_db, $sql);
echo mysqli_affected_rows($_db);
	if( mysqli_affected_rows($_db) == 0  ){
		$sql = "insert into ".TBL_STATUS." set devId='$devId', status='$status', wdten='$wdten', serverIp='$serverIP', wdttime='$wdttime', localIP='$localIP', statusTime='".date("Y-m-d H:i:s")."'";
echo $sql;
		$result = mysqli_query($_db, $sql);
	}
exit;
*/


require("/var/www/html/rpb/src/reference/phpMQTT/phpMQTT.php");
//$mqtt = new phpMQTT("test.mosquitto.org", 1883, "sdf987dfh76lk34kcvb87"); //Change client name to something unique
$mqtt = new phpMQTT("10.0.5.2", 1883, "sdf987dfh76lk34kcvb87");
//$mqtt = new phpMQTT("localhost", 1883, "sdf987dfh76lk34kcvb87"); //Change client name to something unique		


if(!$mqtt->connect()){
	exit(1);
}

$topics['/remotepower/logging'] = array("qos"=>0, "function"=>"procmsg");
$mqtt->subscribe($topics,0);

while($mqtt->proc()){

}


$mqtt->close();

function procmsg($topic,$msg){
	//echo "Msg Recieved: ".date("r")."\nTopic:{$topic}\n$msg\n";
	//echo $msg;
	global $_db;

	//$search = array("\r\n", "\n");
	$msg = str_replace(array("\r\n", "\n", "\r"), '', $msg);

	$arr = json_decode($msg, true);
 
	if( !$arr ){
		//echo "error-".$msg;
		return;
	}

	$devId = $arr["devid"];
	$actionType = $arr["actiontype"];
	$message = $arr["message"];

	$sql = "insert into ".TBL_LOGGING." set devId='$devId', actionType='$actionType', message='$message', logTime='".date("Y-m-d H:i:s")."'";
	$result = mysqli_query($_db, $sql);

	$devId = $arr["devid"];
	$status = $arr["status"];
	$wdten = ($arr["wdten"]=="")?"0":"1";
	$serverIP = $arr["serverip"];
	$wdttime = $arr["wdttime"];
	$localIP = $arr["localip"];

	$sql = "select * from ".TBL_STATUS." where devId='$devId'";
	$result = mysqli_query($_db, $sql);


	if( mysqli_num_rows($result) == 0  ){
		$sql = "insert into ".TBL_STATUS." set devId='$devId', status='$status', wdten='$wdten', serverIP='$serverIP', wdttime='$wdttime', localIP='$localIP', statusTime='".date("Y-m-d H:i:s")."'";
		$result = mysqli_query($_db, $sql);
	}else{
		$sql = "update ".TBL_STATUS." set status='$status', wdten='$wdten', serverIP='$serverIP', wdttime='$wdttime', localIP='$localIP', statusTime='".date("Y-m-d H:i:s")."' where devId='$devId'";
		$result = mysqli_query($_db, $sql);
	}
	//checkLogTime();
}
?>
