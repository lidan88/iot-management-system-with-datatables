<?php
	class Sec extends CControl
	{
		private $o_materialdata;

		public function __construct()
		{
			$this->o_bonddata = new SecData;
		}

		
		public function getRecords()
		{

			$recordsParam = $this->getRecordsParam();
			return $this->o_bonddata->getRecords($recordsParam);
		}	
		public function updateRecord()
		{
			$postParam = $this->getGetParam();
			$id = $_GET['id'];
			return $this->o_bonddata->updateRecord($id,$postParam);
		}
		public function reboot()
		{
			$postParam = $this->getGetParam();
			//$connection = ssh2_connect($postParam['localip'], 22);

			//if (ssh2_auth_password($connection, $postParam['username'], $postParam['password']))
			//{
				$remember= (isset($postParam['remember_me']))?$postParam['remember_me']:""; 
				if($remember !="")
				{
					session_start();
					$_SESSION['username'] =  $postParam['username'];
					$_SESSION['password'] =  $postParam['password'];
					
				}
					
			  	//ssh2_exec($connection,'sudo /sbin/reboot');
				//echo " Reboot Success!";
				//$this->settings($postParam['devId']);
				$logging = new Bond();
				$param= array();
				$param['devId']= $postParam['devId'];
				$param['actionType'] = "Reboot Server";
				$param['logTime'] = date("Y-m-d H:i:s");
				$param['message'] = $postParam['localip'];
				$logging->insertRecord($param);
			//}
			//else
			//{
			  //echo "Failed";
			//}
		}
		public function flash()
		{
			$postParam = $this->getGetParam();
			$logging = new Bond();
			$param= array();
			$param['devId']= $postParam['devId'];
			$param['actionType'] = "Image Updated";
			$param['logTime'] = date("Y-m-d H:i:s");
			$logging->insertRecord($param);
			
		}
		public function settings($devId)
		{

		
			include("/var/www/html/rpb/src/reference/phpMQTT/phpMQTT.php");
		
			$setStr = '{"devid":"'.$devId.'", "rebooting":true}';
			$mqtt = new phpMQTT("10.0.5.2", 1883, generateRandomString()); //Change client name to something unique
			if ($mqtt->connect()) {
				$mqtt->publish("/remotepower/setting", $setStr,0);
				$mqtt->close();
			}
			else
			{
				echo generateRandomString();
			}
			
		}	
	}
?>
