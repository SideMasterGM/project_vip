<?php
	include ("../../../connect_server/connect_server.php");

	@session_start();
	$id_project = @$_SESSION['id_project_selected'];
    
    $CN = CDB("vip");

    if (is_array($CN->getProjectsOnlyById($id))){
    	foreach ($CN->getProjectsOnlyById($id) as $value) {
    		echo $value['contenido'];
    	}
    }
?>