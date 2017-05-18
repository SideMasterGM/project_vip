<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	include ("../../../connect_server/connect_server.php");

	$CN = CDB("vip");

	@session_start();

	$username = $_POST['new_user_perfil'];

	$R = $CN->getUserRowCount($username);

	if ($R > 0){
		echo "Fail";
	} else {
		if ($CN->updateUser($username, $_SESSION['usr'])){
			$_SESSION['username'] = $username;
			echo "OK";
		}
	}
?>