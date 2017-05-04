<?php
	include ("../../../connect_server/connect_server.php");

	$CN_VIP = CDB("vip");
	@session_start();

	$id_team = $_SESSION['id_team'];

	$id_member 	= $_POST['InputTextCoordinateIdMember'];
	$CBValue 	= $_POST['InputTextMemberCBValue'];

	if ($CBValue){

		if ($CN_VIP->addCoordinator($id_member)){
			echo "OK";
		}

	} else {

		if ($CN_VIP->delCoordinator($id_member)){
			echo "OK";
		}

	}

?>