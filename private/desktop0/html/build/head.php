<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	include ("private/desktop0/connect_server/connect_server.php");
	include ("private/connect_server/connect_server.php");
    
	$CN = CDB("vip");

    $getUserPrivilege = $CN->getUserPrivilege(@$_SESSION['usr']);
	if (!is_bool($getUserPrivilege))
	  	@$_SESSION['privilege'] = $getUserPrivilege;

	if (@$_SESSION['privilege'] == "Suspendido"){
		header("Location: private/desktop0/php/logout.php");
	}

    ?>
        <title><?php echo @$_SESSION['usr']; ?> | VIP-PS </title>
    <?php
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="source/img/logo.png" rel="shortcut icon" type="image/png">
<!-- Fonts -->
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
<!-- CSS Libs -->
<link rel="stylesheet" type="text/css" href="private/desktop0/lib/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="private/desktop0/js/jquery-ui.css">

<!-- <link rel="stylesheet" type="text/css" href="private/desktop0/lib/css/font-awesome.min.css"> -->
<link rel="stylesheet" type="text/css" href="private/desktop0/lib/css/fa/css/font-awesome.css">

<link rel="stylesheet" type="text/css" href="private/desktop0/lib/css/animate.min.css">
<link rel="stylesheet" type="text/css" href="private/desktop0/lib/css/bootstrap-switch.min.css">
<link rel="stylesheet" type="text/css" href="private/desktop0/lib/css/checkbox3.min.css">
<link rel="stylesheet" type="text/css" href="private/desktop0/lib/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="private/desktop0/lib/css/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="private/desktop0/lib/css/select2.min.css">
<!-- CSS App -->
<link rel="stylesheet" type="text/css" href="private/desktop0/css/style.css">
<link rel="stylesheet" type="text/css" href="private/desktop0/css/themes/flat-blue.css">