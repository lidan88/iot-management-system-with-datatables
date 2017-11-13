<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Remote Power Button</title>


<!-- Bootstrap Core CSS -->
<link href="<?php echo $_path?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="<?php echo $_path?>bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link href="<?php echo $_path?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="<?php echo $_path?>bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="<?php echo $_path?>dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="<?php echo $_path?>bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="<?php echo $_path?>css/default.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/ico" href="favicon.ico">

</head>
<body>
<!-- start header -->

<?php
	$first_selected = ($file == "index")?"active":"";
	$second_selected = ($file == "second")?"active":"";
	$thr_selected = ($file == "thr")?"active":"";
?>
<div id="header">
	<div id="logo">
		<a href="#"><img src='<?php echo $_path?>logo.png' style='width:80px;'></a>
		<div id='logo_text'>
			<h1>OCEAN</h1>
			<h4>Mining Group LLC</h4>
		</div>	
	</div>
	<div id="menu">
		<!--ul>
			<li class="<?php echo $first_selected;?>"><a href="?">Logs</a></li>
			<li class="<?php echo $second_selected;?>"><a href="?b_m=bond&file=second">State Management</a></li>
		</ul!-->
	</div>
</div>

<!-- end header -->

<script src="<?php echo $_path?>bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $_path?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo $_path?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo $_path?>bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $_path?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $_path?>bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo $_path?>dist/js/sb-admin-2.js"></script>


