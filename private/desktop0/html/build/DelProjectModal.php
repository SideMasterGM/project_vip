<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$id_project = $_POST['ValueArticleByID'];

	if ($CN->deleteProject($id_project)){
		echo "OK";
	}
?>