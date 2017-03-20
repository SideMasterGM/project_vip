<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$usr = $_POST['nombre_de_usuario'];

	if ($CN->deleteUser($usr))
		echo "OK";
	else
		echo "Fail";
?>