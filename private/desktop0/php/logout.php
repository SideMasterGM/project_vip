<?php
	include ("../../connect_server/connect_server.php");
	$CN = CDB("vip");
	$CN->sessionDestroy();

	header("Location: ../../../");
?>