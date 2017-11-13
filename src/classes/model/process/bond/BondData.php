<?php
	class BondData extends CTable
	{
		protected $tbl = TBL_LOGGING;
		
		public function __construct()
		{
			parent::__construct();		
		}			
		
		public function getResponseArray($result_array)
		{
			
			$i = 1;
			$responce = array();
			foreach($result_array as $row)
			{

				
				$id ='<input type="checkbox" data-id="'   . $row['id'] . '">';
				$responce[] = array
				(
				'id'=>$id,	
				'devId'=>$row['devId'],
				'actionType'=>$row['actionType'],
				'message'=>$row['message'],
				'logTime'=>$row['logTime']
				
			);
				$i++;
				
			}
			return $responce;
					
		}
		
		public function getExeSelectQuery($table_name,$filters,$orderBy, $orderType ,$start,$length,$recordsParam)
		{

			$wh = " devId='".$recordsParam['devId']."'";
			if($filters !="")
			{
				$where =array();
				for($i=0 ; $i<count($recordsParam['column']);$i++)
				{
					$column = $recordsParam['column'][$i]['data'];//we get the name of each column using its index from POST request
					if($column !='action' and $column !='id' and $column !='logging')
						$where[]="$column like '%".$filters."%'";
					
				}
				$where = " ".implode(" OR " , $where);
				$wh .= "and (".$where.")";
			}
			else
				$wh .="";
			
			if($orderBy =='id')
				$orderType ='DESC';
			
			if($length !='-1')
			{
				$query = "SELECT * FROM ".$table_name." where ".$wh." ORDER BY ".$orderBy." ".$orderType." limit ".$start.",".$length;
			}
			else
			{
				if($orderBy =="serverIP" or $orderBy =="localIP")
				{
					$query = "SELECT * FROM ".$table_name." where ".$wh." ORDER BY INET_ATON (".$orderBy.")".$orderType;
				}
				else
					$query = "SELECT * FROM ".$table_name." where".$wh." ORDER BY  ".$orderBy." ".$orderType;
			}
			return $query;
		}

		public function getRecords($recordsParam)
		{
			$draw = $recordsParam["draw"];
			$start = $recordsParam["start"];
			$length = $recordsParam["length"];
			$orderBy = $recordsParam["orderBy"];
			$orderType = $recordsParam["orderType"];
			$orderType = $recordsParam["orderType"];
			$filter =  $recordsParam["filters"];


			$table_name = $this->tbl;
						
			$query = $this->getExeSelectQuery($table_name,$filter,$orderBy, $orderType ,$start,$length,$recordsParam,"count");
			
			$result_array = $this->db_query($query);
 			
			$recordsTotal = count($this->getResponseArray($this->db_query("SELECT * FROM ".$this->tbl." where devId='".$recordsParam['devId']."'")));
			
			
			$returned_responce = $this->getResponseArray($result_array);
			
			if($filter !="")
				$recordsFiltered =count($returned_responce); 
			else
				$recordsFiltered =$recordsTotal;

			$response = array
			(
				"draw" => intval($draw),
				"recordsTotal" => $recordsTotal,
				"recordsFiltered" => intval($recordsFiltered),
				"data" => $returned_responce
			);
			return json_encode($response);			
		}
	}
?>
