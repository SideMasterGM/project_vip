<?php
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */

	include ("../../../connect_server/connect_server.php");

    $id = $_POST['ValueArticleByID'];

	@session_start();
	@$_SESSION['id_project_selected'] = $id;
    
    $CN = CDB("vip");


    if (is_array($CN->getProjectsOnlyById($id))){
    	foreach ($CN->getProjectsOnlyById($id) as $value) {
    		echo $value['contenido'];
    	}
    }
?>