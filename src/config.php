<?php
	//$document_root = "/var/www/html";
	$document_root = "C:/xampp/htdocs";
	$server_name = "localhost";

	define('FPATH_BASE', $document_root."/rpb");
	define('APATH_BASE', $server_name."/");
	
	define('SERVER_HOST',"http://".$server_name);
	define('INCLUDE_PATH',  FPATH_BASE . "include/" );

	function __autoload($class_name) //if tmp is not used del acsrview
    {
		$dir_array = array("bond", "sec");
		foreach($dir_array as $dir)
		{
			if(file_exists(FPATH_BASE.'/src/classes/control/'.$dir.'/'.$class_name.'.php'))
				require_once FPATH_BASE.'/src/classes/control/'.$dir.'/'.$class_name.'.php';
			else if(file_exists(FPATH_BASE.'/src/classes/model/process/'.$dir.'/'.$class_name.'.php'))
				require_once FPATH_BASE.'/src/classes/model/process/'.$dir.'/'.$class_name.'.php';
			else if(file_exists(FPATH_BASE.'/src/classes/control/'.$class_name.'.php'))
				require_once FPATH_BASE.'/src/classes/control/'.$class_name.'.php';
			else if(file_exists(FPATH_BASE.'/src/classes/model/process/'.$class_name.'.php'))
				require_once FPATH_BASE.'/src/classes/model/process/'.$class_name.'.php';
		}
        clearstatcache();
    }

	$_404_page = str_replace($_SERVER["DOCUMENT_ROOT"],'', FPATH_BASE).'/404.php';	

	/* contents path */
	$_path = 'contents/';
	$_path_img = $_path.'images/';
	$_path_css = $_path.'css/';
	$_path_js = $_path.'js/';
	/********/
	
	require FPATH_BASE.'/src/constant.php';
	require FPATH_BASE.'/src/reference/library.php';

	define('DBHOST', 'localhost');
	define('DBNAME', 'rpb');
	define('DBUSER', 'root');
	//define('DBPASSWD', 'blueflame');
	define('DBPASSWD', '');

	define('TBL_LOGGING', 'logging');
	define('TBL_STATUS', 'status');

	$_db = mysqli_connect(DBHOST, DBUSER, DBPASSWD) or die('Fail DB Server Connection.');
	mysqli_select_db($_db, DBNAME);
	
?>
