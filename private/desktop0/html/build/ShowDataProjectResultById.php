<?php
	include ("../../../connect_server/connect_server.php");

	@session_start();
	$id_project = @$_SESSION['id_project_selected'];
    
    $CN = CDB("vip");

    if (is_array($CN->getProjectsResultById($id_project))){
    	foreach ($CN->getProjectsResultById($id_project) as $value) {
    		echo $value['otros'];
    	}
    }
?>