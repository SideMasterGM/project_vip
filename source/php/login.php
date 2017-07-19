<?php
	$un = $_POST['tb_usr'];
	$pw = $_POST['tb_pwd'];
	
	include ("../../private/connect_server/connect_server.php");
	$CN = CDB("vip");

	$Login = $CN->LoginUser($un, $pw);

	@session_start();
	if ($Login){
	    @$_SESSION['session'] = "Yes";
	    @$_SESSION['usr'] = $un;

	    $getUserPrivilege = $CN->getUserPrivilege($un);
	    if (!is_bool($getUserPrivilege))
	    	@$_SESSION['privilege'] = $getUserPrivilege;

		echo "OK";
	} else {
	    @$_SESSION['session'] = "No";
		echo "Error";
	}
?>