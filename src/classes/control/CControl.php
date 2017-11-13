<?php
	class CControl
	{   
    	public function getRecordsParam()
		{
						
			 /* Useful $_POST Variables coming from the plugin */
			$draw = $_POST["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
			$orderByColumnIndex  = $_POST['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
			$orderBy = $_POST['columns'][$orderByColumnIndex]['data']?$_POST['columns'][$orderByColumnIndex]['data']:"id";//Get name of the sorting column from its index
			$orderType = $_POST['order'][0]['dir']; // ASC or DESC
			$start  = $_POST["start"]?$_POST["start"]:0;//Paging first record indicator.
			$length = $_POST["length"]?$_POST["length"]:10;//Number of records that the table can display in the current draw	
			$column =$_POST['columns'];
			
			$filters = "";
			if(isset($_POST['search']['value']))
				$filters = $_POST['search']['value'];

			//$array = array("page"=>$page, "limit"=>$limit, "sidx"=>$sidx, "sord"=>$sord, "filters"=>$filters);
			$array = array("draw"=>$draw, "start"=>$start, "length"=>$length,"orderBy"=>$orderBy,"orderType"=>$orderType,"filters"=>$filters,"column"=>$column);

			return $array;
		}


		public function getPostParam()
		{
			$post_array = array();
			foreach($_POST as $key=>$value){
				if($key=="oper" || $key=="id") continue;				
				$post_array[$key] = $value;
			}
			
			return $post_array;
		}

		public function getGetParam()
		{
			$post_array = array();
			foreach($_GET as $key=>$value){
				if($key=="oper" || $key=="id" || $key=="cmd" || $key=="type" || $key =="_") continue;				
				$post_array[$key] = $value;
			}
			return $post_array;
		}


	}
?>
