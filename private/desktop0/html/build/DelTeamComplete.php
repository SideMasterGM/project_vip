<?php
	include ("../../../connect_server/connect_server.php");

	$CN_VIP = CDB("vip");
	@session_start();

	$id_team = $_SESSION['id_team'];

	if ($CN_VIP->DelTeamComplete($id_team)){
		echo "OK";
	}
?>