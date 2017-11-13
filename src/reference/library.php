	<?php
	function array2json(array $arr)
	{
		//if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
		$parts = array();
		$is_list = false;

		if (count($arr)>0){
			//Find out if the given array is a numerical array
			$keys = array_keys($arr);
			$max_length = count($arr)-1;
			if(($keys[0] === 0) and ($keys[$max_length] === $max_length)) {//See if the first key is 0 and last key is length - 1
				$is_list = true;
				for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
					if($i !== $keys[$i]) { //A key fails at position check.
						$is_list = false; //It is an associative array.
						break;
					}
				}
			}

			foreach($arr as $key=>$value) {
				$str = ( !$is_list ? '"' . $key . '":' : '' );
				if(is_array($value)) { //Custom handling for arrays
					$parts[] = $str . array2json($value);
				} else {
					//Custom handling for multiple data types
					if (is_numeric($value) && !is_string($value)){
						$str .= $value; //Numbers
					} elseif(is_bool($value)) {
						$str .= ( $value ? 'true' : 'false' );
					} elseif( $value === null ) {
						$str .= 'null';
					} else {
						$str .= '"' . addslashes($value) . '"'; //All other things
					}
					$parts[] = $str;
				}
			}
		}
		$json = implode(',',$parts);

		if($is_list) return '[' . $json . ']';//Return numerical JSON
		return '{' . $json . '}';//Return associative JSON
	}

	function json2array($json)
	{
		if(get_magic_quotes_gpc())
			$json = stripslashes($json);

		$json = substr($json, 1, -1);
		$json_array = str_replace(array(":", "{", "[", "}", "]"), array("=>", "array(", "array(", ")", ")"), $json);
		@eval("\$json_array = array({$json_array});");
		return $json_array;
	}

	function quote_smart($value)
	{
		// Stripslashes
		if (get_magic_quotes_gpc()) {
			$value = stripslashes($value);
		}
		// Quote if not a number or a numeric string
		if (!is_numeric($value)) {
			$value = mysql_real_escape_string($value);
		}
		return $value;
	}

	function get_parameter ( $para, $only = '' ) {
        global $_GET;
		
        $parameters = '';
        $ampersand = '';
        $i = 1;
        
		if($only != '')
		{
			$parameters = $only.'='.$_GET[$only];
		}else{
			$tmp_arr = explode(',', $para);
			$para_arr = array();
			foreach($tmp_arr as $arr)
			{
				$para_arr[] = trim($arr);
			}
			
			if ( 0 < count ($_GET) ) {
				reset($_GET);
				while (list($key, $val) = each($_GET)) {
					if ( $i == count ($_GET)) $ampersand = '';
					else $ampersand = '&';
					
					if ( $para != "") {
						if ( !in_array($key, $para_arr)) {
							$parameters .= $key."=".$val.$ampersand;
						}
					} else {
                        $parameters .= $key."=".$val.$ampersand;
					}
					$i++; 
				}
			}
			
			$parameters = (substr($parameters,-1) == '&')? substr($parameters,0,-1): $parameters;
		}
        return $parameters;
    }

	function exeSelectQuery($table_name,$fields="",$filters = "",$sort_type = "",$sel=0,$monsel=0){
		//fields array("email","key_string")
		////$_REQUEST['filters']='{"groupOp":"AND","rules":[{"field":"UserID","op":"cn","data":"test"}]}';

		$where_sql		= "";
		$order_by_sql	= "";
		$limit_sql		= "";
		$fields_select = "*"; 
		/*
		if($sel==1)
		{
			$mount="amount";
			$money="money";
		}
		if($sel==2)
		{
		$mount="amount";
			$money="sellMoney";
			$sel=1;
		
		}
		if($sel==3)
		{
			$mount="realAmount";
			$money="buyingMoney";
			$sel=1;
		}
		if($sel==1) 
		{
			if($monsel==0)
			$fields_select = "*,sum($mount) as mount1,sum($money*usd/eur*kpw) as money1,sum($money*usd1/eur1*kpw1) as money2";
			else if($monsel==1)
				$fields_select = "*,sum($mount) as mount1,sum($money*usd/eur) as money1,sum($money*usd/eur) as money2";
			else
				$fields_select = "*,sum($mount) as mount1,sum($money) as money1,sum($money) as money2";
		}
		*/
		
		if($fields!=""){
			$fields_select = "";
			foreach($fields as $value){
				$fields_select .= $value.",";
			}
			$fields_select = substr($fields_select,0,-1);
		}
		
		
		if( $filters != "" )
		{
			$searchstr = Strip($filters);
			$wh= constructWhere($searchstr);

			$where_sql  = "where 1=1 ".$wh;
		}
		if( $sort_type != ""){
			$sidx		= $sort_type["sidx"];
			$sord		= $sort_type["sord"];
			$limit_start = $sort_type["limit_start"];
			$limit_count = $sort_type["limit_count"];	
			

			$order_by_sql	= " ORDER BY $sidx $sord ";
			$limit_sql = "";
			if($limit_start!="" || $limit_count!=0)
				$limit_sql		= " LIMIT $limit_start , $limit_count ";
		}
		return array("fields_select"=>$fields_select, "table_name"=>$table_name, "where_sql"=>$where_sql, "order_by_sql"=>$order_by_sql, "limit_sql"=>$limit_sql);
	}
	function exeQuery($sql){	
		global $_db;
		mysqli_query($_db, "set names utf8");
		$result = mysqli_query($_db, $sql);
		return $result;
	}

	function checkLogTime(){
		global $_db;		
		$tempDate = date('Y-m-d H:i:s', time() - 600);
		$result = mysqli_query($_db, "DELETE FROM ".TBL_STATUS." WHERE statusTime < '".$tempDate."'");
		return $result;
	}

	function getResult($sql){
	
		$result = exeQuery($sql);
		$array = array();

		if(!$result) {return array();}

		if(mysqli_num_rows($result)==0){
			return array();
		}
		else{
			$nameArray=array();
			$j=0;				
			while ($j < mysqli_num_fields($result)) {
				$nameArray[$j] = mysqli_fetch_field_direct($result, $j);					
				$j++;
			}

			$i=0;	
			while($row= mysqli_fetch_array($result)){
				$array[$i] = array();

				foreach($nameArray as $name_obj){
					$name = $name_obj->name;					
					if($name=="RNUM")continue;	
					if($name=="description" && count($nameArray)>10)continue;	
					//$array[$i][$name] = str_replace("\r\n","<br>",$row[$name]);
					$array[$i][$name] = $row[$name];
				
				}
				$i++;
			}
			return $array;
		}	
		
		return $array;	
	}
	function ToSql ($field, $oper, $val) {
		// we need here more advanced checking using the type of the field - i.e. integer, string, float
		switch ($field) {
			case 'id':
				return intval($val);
				break;
			case 'amount':
			case 'tax':
			case 'total':
				return floatval($val);
				break;
			default :
	/*
				if($oper=='ge'){ 
					return "to_date('$val','YYYY-MM-DD')";
				}
				if($oper=='le'){
					return "DATE_ADD('$val',INTERVAL 1 DAY)";
				}
	*/
				
				if($oper=='bw' || $oper=='bn') return "'" . addslashes($val) . "%'";
				else if ($oper=='ew' || $oper=='en') return "'%" . addcslashes($val) . "'";
				else if ($oper=='cn' || $oper=='nc') return "'%" . addslashes($val) . "%'";
				else return "'" . addslashes($val) . "'";
				
		}
	}

	function Strip($value)
	{
		if(get_magic_quotes_gpc() != 0)
		{
			if(is_array($value))  
				if ( array_is_associative($value) )
				{
					foreach( $value as $k=>$v)
						$tmp_val[$k] = stripslashes($v);
					$value = $tmp_val; 
				}				
				else  
					for($j = 0; $j < sizeof($value); $j++)
						$value[$j] = stripslashes($value[$j]);
			else
				$value = stripslashes($value);
		}
		return $value;
	}

	function array_is_associative ($array)
	{
		if ( is_array($array) && ! empty($array) )
		{
			for ( $iterator = count($array) - 1; $iterator; $iterator-- )
			{
				if ( ! array_key_exists($iterator, $array) ) { return true; }
			}
			return ! array_key_exists(0, $array);
		}
		return false;
	}

	function constructWhere($s){
		$qwery = "";
		//['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
		$qopers = array(
					  'sy'=>" = ",
					  'eq'=>" = ",
					  'ne'=>" <> ",
					  'lt'=>" < ",
					  'le'=>" <= ",
					  'gt'=>" > ",
					  'ge'=>" >= ",
					  'bw'=>" LIKE ",
					  'bn'=>" NOT LIKE ",
					  'in'=>" IN ",
					  'ni'=>" NOT IN ",
					  'ew'=>" LIKE ",
					  'en'=>" NOT LIKE ",
					  'cn'=>" LIKE " ,
					  'nc'=>" NOT LIKE " );
		if ($s) {
			$jsona = json2array($s,true);

			if(is_array($jsona)){
				
				$gopr = $jsona['groupOp'];
				$rules = $jsona['rules'];
				$i =0;
				foreach($rules as $key=>$val) {
					$field = $val['field'];
					$op = $val['op'];
					$v = $val['data'];

					//customize
					$original_v = $v;
					
					if(isset($v) && $op) {

						
						$i++;
						// ToSql in this case is absolutley needed
						$v = ToSql($field,$op,$v);

						//customize construct where
						if( $field == "DatedDate" || $field=="MaturityDate" )
						{
							$dm_date_arr = explode("/", $original_v);

							$count_dt = count( $dm_date_arr );
							if( $count_dt == 1 ){
								$v = $dm_date_arr[0];
							}else if( $count_dt == 2 ){
								if( trim($dm_date_arr[1]) !="" ){
									$v = $dm_date_arr[0]."-".$dm_date_arr[1];
								}
								else
									$v = $dm_date_arr[0];
							}else if( $count_dt == 3 ){
								if( trim($dm_date_arr[2]) !="" )
									$v = $dm_date_arr[2]."-".$dm_date_arr[0]."-".$dm_date_arr[1];
								else
									$v = $dm_date_arr[0]."-".$dm_date_arr[1];
							}	
							$v = "'%".$v."%'";
						}
						
						/////

						if ($i == 1) $qwery = " AND ";
						else $qwery .= " " .$gopr." ";
						switch ($op) {
							// in need other thing
							case 'in' :
							case 'ni' :
								$qwery .= $field.$qopers[$op]." (".$v.")";
								break;
							case 'cn' :
								$qwery .= "upper($field)".$qopers[$op]." upper(".$v.")";
								break;
							default:
								$qwery .= $field.$qopers[$op].$v;
						}
					}
				}
			}
		}	

		return $qwery;
	}

	function go_page_ref($url = "")
	{
		if($url == ""){
			echo "<script language=javascript>
					top.location.href = top.location.href;
				</script>";
		}else{
			echo "<script language=javascript>
					top.location.href = '{$url}';
				</script>";
		}
	}

	function alert($msg)
	{
		echo "<script>alert('".$msg."');</script>";
	}
	
	function pop_array($origin_array,$pop_key){
		$new_array = array();
		foreach($origin_array as $key=>$value)
		{
			if(!in_array($key,$pop_key))
				$new_array[$key] = $value; 
		}
		return $new_array;
	}
	
	function fill_select_number( $start=0, $end=0, $value=0, $empty=false )
	{
		$str = "";
		if( $empty ){
			$str .= "<option value=\"\"></option>";
		}
		for( $i=$start; $i<=$end; $i++ ){
			if( $i == $value )
				$str .= "<option value=\"$i\" selected>$i</option>";
			else
				$str .= "<option value=\"$i\">$i</option>";
		}

		return $str;
	}

	function isLogIn()
	{
		if(isset($_SESSION['userName']) && $_SESSION['userName']!="")
			return true;
		else
			return false;
	}

	function logOut()
	{
		session_destroy();
		echo '<script>location.href="/real/rest/";</script>';
	}

	function display_format_number ( $number, $point_num=0 )
	{
		return ( $number == 0 ) ? "0" : round($number, $point_num);
	}

	function remCommutation($str,$rem)
	{
		
		$news = array();
		$news_str = "";
		$mys = explode("#",$str);
		
		$k = 0;
		foreach($mys as $v)
		{
			if($v == $rem && $k==0){
				$k++;
			}else{
				$news[] = $v;
				$news_str .= $v."#";
			}
		}
		$news_str = substr($news_str, 0, -1);
		return array($news, $news_str);
	}

	function addCommutation($str,$rem)
	{
		if($str == "")
			return $rem;
		else
			return $str."#".$rem;
	}

	function filedelete($targetPath){	
		if(file_exists($targetPath)) 
		{
		unlink($targetPath);
		}
	}
	function thumbnail($tmpfile, $thumbfile, $thumb_width, $thumb_height=0) {
		$file = $thumbfile;

		$img_info = getimagesize($tmpfile);

		$x = $thumb_width;
		$y = $img_info[1]/($img_info[0]/$thumb_width);

		if ($thumb_height && $y > $thumb_height) {
			$x = round ( ($thumb_height) * ($img_info[0]) / $img_info[1]);
			$y = $thumb_height;
		}

		$newImg = imagecreatetruecolor($x, $y);

		switch ($img_info[2]) {
			case 1:
				$src = imagecreatefromgif($tmpfile);
				break;
			case 2:
				$src = imagecreatefromjpeg($tmpfile);
				break;
			case 3:
				$src = imagecreatefrompng($tmpfile);
				break;
			default:
				$src = imagecreatefromjpeg($tmpfile);
		}

		imagecopyresampled($newImg, $src, 0, 0, 0, 0, $x, $y, $img_info[0], $img_info[1]);
		imageinterlace ( $newImg );

		if($img_info[2]==1) imagegif($newImg, $file);
		else if($img_info[2]==2) imagejpeg($newImg,$file, 100 );
		else if($img_info[2]==3) imagepng($newImg, $file);
		else imagejpeg  ( $newImg, $file, 100 );
	}

	function isFileExist($filePath){	
		if(file_exists($filePath)) 
		{
			return true;
		}else
			return false;
	}

	function mkdirect($dir_nm){

		if(!is_dir($dir_nm))
			mkdir( $dir_nm, 0777, true);
	}

	function saveAsExcel($fname){		
		if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
		{
			header("Pragma: public");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		}
		header("Content-Type: application/x-msexcel");
		header("Content-Length: ".@filesize($fname));
		header('Content-disposition: attachment; filename="Reports.xls"');
		$fh=fopen($fname, "rb");
		fpassthru($fh);
	}
	
	function checkTblExist($tbl_name)
	{
		
		$result = mysql_list_tables( DBNAME );
		$num_rows = mysql_num_rows( $result );

		$exists_table = false;
		
		for( $i=0; $i<$num_rows; $i++ ){
			$tb_name = mysql_tablename($result, $i);
			
			if( $tbl_name == $tb_name ) {
				$exists_table = true;
			}
		}
		return $exists_table;
		
	}

	function getTblInPeriodMonth($from, $to, $tbl)
	{

		$sel_dates = explode("-", $to);
		$my_ori = mktime (0,0,0,$sel_dates[1]  ,1,$sel_dates[0]);

		$i=1;
		$sel_dates = explode("-", $from);

		$return_arr = array();
		for(;;){
			
			$my = mktime (0,0,0,$sel_dates[1]+$i  ,1,$sel_dates[0]);
			$date_str = date ("Y-m-d",$my);
			if($my_ori > $my)
				$return_arr[] = substr($date_str, 0, -3);
			else
				break;
			$i++;
		}

		$new_return_arr = array();
		
		$result = mysql_list_tables( DBNAME );
		$num_rows = mysql_num_rows( $result );

		$exists_table = false;

		for($k=0; $k<count($return_arr); $k++)
		{
			for( $i=0; $i<$num_rows; $i++ ){
				$tb_name = mysql_tablename($result, $i);
				$sel_dates = explode("-", $return_arr[$k]);
				$my_tb_name = $tbl.'_'.$sel_dates[0].'_'.$sel_dates[1];

				if( $my_tb_name == $tb_name ) {
					$new_return_arr[] = $my_tb_name;

				}
			}
		}
		return $new_return_arr;

	}


	function getTblInPeriod($from, $to,$tbl)
	{
		$sel_dates = explode("-", $to);
		$my_ori = mktime (0,0,0,1  ,1,$sel_dates[0]);

		$i=1;
		$sel_dates = explode("-", $from);

		$return_arr = array();
		for(;;){
			
			$my = mktime (0,0,0,1  ,1,$sel_dates[0]+$i);
			$date_str = date ("Y",$my);

			if($my_ori > $my)
				$return_arr[] = $date_str;
			else
				break;
			$i++;
		}
//print_r($return_arr);
		$new_return_arr = array();
		
		$result = mysql_list_tables( DBNAME );
		$num_rows = mysql_num_rows( $result );

		$exists_table = false;

		for($k=0; $k<count($return_arr); $k++)
		{
			for( $i=0; $i<$num_rows; $i++ ){
				$tb_name = mysql_tablename($result, $i);
//echo $tb_name."<br>";
				$my_tb_name = $tbl.'_'.$return_arr[$k];

				if( $my_tb_name == $tb_name ) {
					
					$new_return_arr[] = $my_tb_name;

				}
			}
		}

		return $new_return_arr;

	}

	function getYearTableName($date,$tbl)
	{
		$sel_date_array = explode("-", $date);
		$sel_month_table = $sel_date_array[0];
		$tablename = $tbl."_".$sel_month_table;
		return $tablename;
	}

	function getMax($arr){
		$max = 0;
		foreach($arr as $v){
			$max = ($max<$v)?$v:$max;
		}
		return $max;
	}

	function convertDateDisplay($standard_date)
	{
		if($standard_date == "0000-00-00"){
			return "";
		}else if($standard_date == ""){
			return "";
		}
		else{
			$dates = explode('-', $standard_date);
			return substr($dates[0],2,4)."/".$dates[1] . "/" . $dates[2];
		}
	}

	function g_file_download( $filePath ){
		if( ereg( '[^-a-zA-Z0-9\.]', $filePath ) ){
			$fileName = basename( $filePath );
		}else{
			$fileName = 'download' . basename( $filePath );
		}

		header('Pragma: ');
		header('Cache-Control: cache');
		header('Content-Disposition: attachment; filename="' . $fileName . '"');
		header('Content-Type: application/octet-stream; name="' . $fileName . '"');

		return readfile( $filePath );
	}

	function getAMonthPeriod($registerDate){
		
		$sel_dates = explode("-", $registerDate);

		$days = date( 't', mktime( 0, 0, 0, $sel_dates[1],1, $sel_dates[0]) );	

		/*if( $sel_dates[2] >25 ){*/
			$from = mktime (0,0,0,$sel_dates[1] ,1, $sel_dates[0]);
			$to = mktime (0,0,0,$sel_dates[1] , $days, $sel_dates[0]);
		/*}else{
			$from = mktime (0,0,0,$sel_dates[1]-1 ,26, $sel_dates[0]);
			$to = mktime (0,0,0,$sel_dates[1] , 25, $sel_dates[0]);
		}*/
		
		$from_date = date ("Y-m-d", $from);
		$to_date = date ("Y-m-d", $to);

		return array( $from_date, $to_date );
	}


	function round_digit( $val, $digit){
		return round($val, $digit);
	}

	function thousandsSeparator($output)
	{
		$output_array= explode(".",$output);
		$nDot = strlen($output_array[0]);
		$nDot = ($nDot > -1) ? $nDot : strlen($output_array[0]);
	

	}	

	function changeNewLine($message, $change_str){
		$message = str_replace("\r\n",$change_str, $message);
		$message = str_replace("\r",$change_str, $message);
		$message = str_replace("\n",$change_str, $message);
		return $message;
	}

	function generateRandomString($length = 32) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

?>
