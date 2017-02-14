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
		echo "OK";
	} else {
	    @$_SESSION['session'] = "No";
		echo "Error";
	}
?>