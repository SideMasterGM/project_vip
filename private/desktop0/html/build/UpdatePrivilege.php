<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$usr 		= $_POST['InputUsrPrivilege'];
	$privilege 	= $_POST['InputPrivilege'];

	if ($CN->UpdateUserPrivilege($usr, $privilege))
		echo "OK";
	else
		echo "Fail";
?>