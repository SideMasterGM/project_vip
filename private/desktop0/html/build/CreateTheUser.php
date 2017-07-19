<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	include ("../../../connect_server/connect_server.php");
	
	$CN = CDB("vip");
	@session_start();

	$username 		= $_POST['Enter_UserName'];
	$email 			= $_POST['Enter_Email'];
	$PassOne 		= $_POST['Enter_PassWord'];
	$PassTwo 		= $_POST['Enter_RepeatPassWord'];
	$date_log 		= date('Y-n-j');
	$date_log_unix	= time();
	$privilege		= $_POST['ValuePrivilege'];

	if ($username == "" || $email == "" || $PassOne == "" || $PassTwo == ""){
		echo "Rellene todos los campos!.";
	} else {
		if ($PassOne == $PassTwo){
			if ($CN->addNewUser($username, $PassTwo, $email, @$_SESSION['usr'], $privilege)){
				echo "OK";
			} else {
				echo "Fail";
			}
		} else{
			echo "Verifique la contraseña.";
		}
	}
?>