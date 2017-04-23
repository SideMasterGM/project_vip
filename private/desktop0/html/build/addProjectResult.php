<?php
	$idp_result 	= $_POST['idp_result'];
	$fpr_content 	= $_POST['fpr_content'];

	if ($fpr_content == ""){
		$fpr_content = "Nada que agregar";
	}

	include ("../../../connect_server/connect_server.php");

	$CN = CDB("vip");

	if ($CN->addProjectResult($idp_result, $fpr_content))
		echo "OK";
?>