<?php
	$IDProject 	= $_POST['IDProject'];
	$TeamName 	= $_POST['TeamName'];

	if ($TeamName != ""){
		include ("../../../connect_server/connect_server.php");

		$CN = CDB("vip");

		if ($CN->addTeamProject($IDProject, $TeamName))
			echo "OK";
	}
?>