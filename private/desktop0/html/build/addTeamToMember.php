<?php
	include ("../../../connect_server/connect_server.php");

  	$CN_VIP = CDB("vip");

  	@session_start();
  	$id_team = $_SESSION['id_team'];

  	$firstname 					= $_POST['dataSendIDs_firstname'];
  	$lastnames 					= $_POST['dataSendIDs_lastname'];

  	$grado_academico 			= $_POST['dataSendIDs_grado_academico'];
  	$dependencia_academica 		= $_POST['dataSendIDs_dependencia_academica'];

  	$tipo_contratacion 			= $_POST['dataSendIDs_tipo_contratacion'];
  	$hrs_semanales_dedicacion 	= $_POST['dataSendIDs_hrs_semanales_dedicacion'];

  	if ($CN_VIP->updateTeamMemberDataById($id_team, $firstname, $lastnames, $grado_academico, $dependencia_academica, $tipo_contratacion, $hrs_semanales_dedicacion)){
  		echo "OK";
  	} else {
  		echo "Fail";
  	}

?>