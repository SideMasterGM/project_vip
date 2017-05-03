<?php
	include ("../../../connect_server/connect_server.php");

  	$CN_VIP = CDB("vip");

  	@session_start();
  	$id_team = $_SESSION['id_team'];

  	$id_img = $_POST['InputTextIDTeamMemberSend'];

  	if ($CN_VIP->delMemberTeamById($id_team, $id_img)){
  		echo "OK";
  	} else {
  		echo "Fail";
  	}
?>