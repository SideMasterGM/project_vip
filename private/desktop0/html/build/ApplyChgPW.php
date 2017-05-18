<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	include ("../../../connect_server/connect_server.php");
	
	$CN = CDB("vip");
	@session_start();
	
	$PassOld = $_POST['old_password'];
	$PassOne = $_POST['new_passwordUser'];
	$PassTwo = $_POST['repeat_new_passwordUser'];

	$Multi = strlen($PassOld) * strlen($PassOne) * strlen($PassTwo);

	if ($Multi == 0){
		echo "Rellene todos los campos";
	} else {
		if ($PassOne == $PassTwo){
			$USP = $CN->updateUserPassword($_SESSION['usr'], $PassOld, $PassOne);

			if ($USP == 1)
				echo "OK";
			else if ($USP == "-1")
				echo "La contraseña actual no es correcta.";
			else if ($USP == "-2")
				echo "Ha ocurrido un problema al intentar actualizar la contraseña. Vuelva a intentarlo.";

		} else {
			echo "Por favor, confirme las nuevas claves.";
		}
	}

?>