<?php
/*
$historicalSheetUrl = "http://real-chart.finance.yahoo.com/table.csv?s=FNCL&d=7&e=12&f=2016&g=d&a=7&b=11&c=2015&ignore=.csv";
if(get_headers($historicalSheetUrl, 1)[0] == 'HTTP/1.1 200 OK')
{
	file_put_contents('spreadsheet.txt', trim(str_replace("Date,Open,High,Low,Close,Volume,Adj Close", "", file_get_contents($historicalSheetUrl))));
}
*/
	session_start();
	require_once 'src/config.php';	
	
	$header = "rest";
	$footer = "rest";

	$big_menu = (isset($_GET['b_m']) && $_GET['b_m'] != "")? $_GET['b_m']: "bond";	//big_menu
	$file = (isset($_GET['file']) && $_GET['file'] != "")? $_GET['file']: "second";

	

	require_once FPATH_BASE.'/src/header/'.$header.'.php';
	require_once FPATH_BASE."/".$big_menu."/".$file.".php";
	require_once FPATH_BASE.'/src/footer/'.$footer.'.php';
?>
