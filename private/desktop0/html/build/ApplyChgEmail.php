<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	// include ("../../connect_server/connect_server.php");
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$new_email = $_POST['new_email_address'];

	$R = $CN->getEmailRowCount($new_email);

	@session_start();

	if ($R > 0){
		echo "Fail";
	} else {
		if ($CN->updateUserEmail($_SESSION['usr'], $new_email))
			echo "OK";
	}
?>