<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	include ("../../../connect_server/connect_server.php");

	$CN = CDB("vip");
	@session_start();
	$firstname_lastname = $_POST['new_user_firstname_lastname'];

	if ($CN->updateUserFirstname_Lastname($firstname_lastname, $_SESSION['usr'])){
		echo "OK";
	} else {
		echo "Fail";
	}
?>