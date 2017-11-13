<?php
	class SecData extends CTable
	{
		protected $tbl = TBL_STATUS;
		//protected $tbl_his = TBL_MATERIAL_HISTORY;

		public function __construct()
		{
			parent::__construct();		
		}


		public function getResponseArray($result_array)
		{

			$i = 0;
			$responce = array();
			foreach($result_array as $row)
			{
				$functions  = '<div class="function_buttons">';
				$functions .= '<div class="function_reboot"><a class="btn btn-info btn-xs" title="reboot" data-id="'   . $row['devId'] . '" data-name="' . $row['serverIP'] . '"">reboot</a></div>';
				$functions .= '<div class="function_power"><a class="btn btn-success btn-xs" title ="power" data-id="' . $row['devId'] . '"  data-name="' . $row['localIP'] . '">power</a></div>';
				$functions .= '<div class="function_flash"><a class="btn btn-primary btn-xs" title ="flash" data-id="' . $row['devId'] . '"  data-name="' . $row['localIP'] . '">flash</a></div>';
				$functions .= '</div>';

				$row["devId"] = htmlspecialchars($row["devId"],ENT_QUOTES);
				$row["wdten"] = htmlspecialchars($row["wdten"],ENT_QUOTES);
				$row["status"] = htmlspecialchars($row["status"],ENT_QUOTES);
				$row["serverIP"] = htmlspecialchars($row["serverIP"],ENT_QUOTES);
				$row["wdttime"] = htmlspecialchars($row["wdttime"],ENT_QUOTES);
				$row["localIP"] = htmlspecialchars($row["localIP"],ENT_QUOTES);
				
				if($row['wdten'] =='1')
				{
					$wdt ='<div class="checkbox-container"><button class="btn btn-warning wdten btn-xs" data-name="' . $row['localIP'] . '">enable</button></div>';
                }
                else
                {
                	$wdt ='<div class="checkbox-container"><button class="btn btn-secondary wdten btn-xs" data-name="' . $row['localIP'] . '">disable</button></div>';
                }
                if ($row['status'] =='standby' || $row['status'] =='checking WDT') 
                {
                	$status ='<span style="color:green">'.$row['status'].'</span>';
                }
                else if($row['status'] =='delay power off' || $row['status'] =='booting' || $row['status'] =='Turning on' || $row['status'] =='Turning off')
                {
                	$status ='<span style="color:orange">'.$row['status'].'</span>';	
                } 
                else
                {
                	$status ='<span style="color:red">'.$row['status'].'</span>';	
                }
				$logging = '<div class="checkbox-container"><a class="btn btn-primary btn-xs " href="index.php?b_m=bond&file=index&devId='.$row['devId'].'&location='.$row['alias'].'">logging</a></div>';
				$responce[] = array
				(
				'id'=>$row['id'],	
				'devId'=>$row['devId'],
				'serverIP'=>$row['serverIP'],
				'alias'=>$row['alias'],
				'status'=>$status,
				'action'=>$functions,
				'localIP'=>$row['localIP'],
				'wdten'=>$wdt,
				'alias'=>$row['alias'],
				'firmver'=>$row['firmver'],
				'logging'=>$logging
				//'functions'     => $functions
				);
				$i++;
			}	
			return $responce;

		}
		
		public function getExeSelectQuery($table_name,$filters,$orderBy, $orderType ,$start,$length,$recordsParam)
		{

			if($filters !="")
			{
				$where =array();
				for($i=0 ; $i<count($recordsParam['column']);$i++)
				{
					$column = $recordsParam['column'][$i]['data'];//we get the name of each column using its index from POST request
					if($column !='action' and $column !='id' and $column !='logging')
						$where[]="$column like '%".$filters."%'";
					
				}
				$where = " where ".implode(" OR " , $where);
			}
			else
				$where ="";
			
			if($orderBy =='id')
				$orderBy ='serverIP';
			if($length !='-1')
			{
				$query = "SELECT * FROM ".$table_name."".$where." ORDER BY ".$orderBy." ".$orderType." limit ".$start.",".$length;
			}
			else
			{
				if($orderBy =="serverIP" or $orderBy =="localIP")
				{
					$query = "SELECT * FROM ".$table_name."".$where." ORDER BY INET_ATON (".$orderBy.")".$orderType;
				}
				else
					$query = "SELECT * FROM ".$table_name."".$where." ORDER BY  ".$orderBy." ".$orderType;
			}
			
			return $query;
		}
	}
?>
