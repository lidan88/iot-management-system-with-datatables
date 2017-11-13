<?php
require("../phpMQTT.php");
$mqtt = new phpMQTT("test.mosquitto.org", 1883, "dd4937912d491c9a9eb0d705641a8bd5"); //Change client name to something unique	


if(!$mqtt->connect()){
	exit(1);
}

$topics['/remotepower/status'] = array("qos"=>0, "function"=>"procmsg");
$mqtt->subscribe($topics,0);

while($mqtt->proc()){

}


$mqtt->close();

function procmsg($topic,$msg){
		echo "Msg Recieved: ".date("r")."\nTopic:{$topic}\n$msg\n";
}
?>