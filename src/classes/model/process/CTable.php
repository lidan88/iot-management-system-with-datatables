<?php
	class CTable
	{   
        public $_db = null;

        
        public function __construct()
        {
			global  $_db;
			$this->_db = $_db;
        }

		public function db_query($query)
		{
			mysqli_query($this->_db, "set names utf8");		
			$result = mysqli_query($this->_db, $query);
			return $result;
		}

		public function chkTblExist($tablename)
		{
			$result = mysql_list_tables( DBNAME );
			$num_rows = mysql_num_rows( $result );

			$exists_table = false;
			for( $i=0; $i<$num_rows; $i++ ){
				$tb_name = mysql_tablename($result, $i);
				if( $tablename == $tb_name ) {
					$exists_table = true;
					continue;
				}
			}
			return $exists_table;

		}


		public function insertRecord($items)
		{
			$insert_key = "(";
			$insert_value = "(";
			foreach($items as $key => $value)
			{
				$insert_key .= "`$key`,";
				$insert_value .= "'".addslashes(trim($value))."',";
			}
			$insert_key = substr($insert_key, 0, -1).")";
			$insert_value = substr($insert_value, 0, -1).")";
			$sql = "insert into ".$this->tbl." $insert_key values $insert_value";
			$result =$this->db_query($sql);
			return $result;
		}
		public function isExistRecordData($items)
		{
			$where_sql = " where ";
			foreach($items as $key => $value)
			{
				$where_sql .= " `$key`='$value' and";
			}
			$where_sql = substr($where_sql, 0, -3);
						
			$sql = "select count(*) from ".$this->tbl.$where_sql;
			
			$result = $this->db_query($sql);
			return mysql_result($result,0,0);
		}
		public function getRecordData($items="")
		{
			if($items !="")
			{
				$where_sql = " where ";
				foreach($items as $key => $value)
				{
					$where_sql .= " `$key`='$value' and";
				}
				$where_sql = substr($where_sql, 0, -3);
			}
			else
				$where_sql ="";
			$sql = "select * from ".$this->tbl.$where_sql;
			$result = $this->db_query($sql);
			return $result;
		
		}

		public function delRecord($id)
		{
			$sql = "delete from ".$this->tbl." where id='".$id."'";
			$res = $this->db_query($sql);
			return $res;
		}

		public function updateRecord($id, $items)
		{
			$update_where = "";

			foreach($items as $key => $value)
			{
				$update_where .= "`$key` = '".addslashes(trim($value))."',";
			}
			$update_where = substr($update_where, 0, -1);
			$sql = "update ".$this->tbl." set ".$update_where." where `id`='$id'";
			$result =$this->db_query($sql);
			return $result;
		}		
		
		
		public function getFilters($filters)
		{
			return $filters;
		}
		
		public function getResponseArray($result_array)
		{
			
			$i = 1;
			$responce = array();
			
			foreach($result_array as $row)
			{
				$responce[] = $row;
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
 			
			$recordsTotal = count($this->getResponseArray($this->db_query("SELECT * FROM ".$this->tbl)));
			
			
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
