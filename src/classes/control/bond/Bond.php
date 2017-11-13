<?php
	class Bond extends CControl
	{
		private $o_materialdata;

		public function __construct()
		{
			$this->o_bonddata = new BondData;
		}

		
		public function getRecords()
		{

			$recordsParam = $this->getRecordsParam();// array [page, limit, sidx, sord, filters]
			$recordsParam['devId'] = $_GET['devId'] ? $_GET['devId']:"";
			return $this->o_bonddata->getRecords($recordsParam);
		}
		public function deleteRecord()
		{

			foreach($_GET['info'] as $row)
			{
				$this->o_bonddata->delRecord($row);
			}
			

		}
		public function insertRecord($param)
		{
			$query =$this->o_bonddata->insertRecord($param);
			
		}
	}
?>