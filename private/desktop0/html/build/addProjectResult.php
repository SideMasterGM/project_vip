<?php
	/**
		* --------------------------------------------- *
		* @author: Jerson A. Martínez M. (Side Master)  *
		* --------------------------------------------- *
	*/

	$idp_result 	= $_POST['idp_result'];
	$fpr_content 	= $_POST['fpr_content'];

	if ($fpr_content != ""){
		include ("../../../connect_server/connect_server.php");

		$CN = CDB("vip");

		if ($CN->addProjectResult($idp_result, $fpr_content))
			echo "OK";
	}
?>