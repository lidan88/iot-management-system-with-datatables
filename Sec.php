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
			$connection = ssh2_connect($postParam['localip'], 22);

			if (ssh2_auth_password($connection, $postParam['username'], $postParam['password']))
			{
			  //echo "Success";
			  ssh2_exec($connection,'sudo /sbin/reboot');
				echo " Reboot Success!";		
			}
			else
			{
			  echo "Failed";
			}
		}
		public function settings()
		{

			$devId = $_POST['devId'];
			$wdten = $_POST['wdten'];
			$serverIP = $_POST['serverIP'];
			$wdttime= $_POST['wdttime'];
			
		}	
	}
?>
