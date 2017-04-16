<?php
	include ("../../../connect_server/connect_server.php");

    $CN = CDB("vip");

    $id = $_POST['ValueArticleByID'];

    if (is_array($CN->getProjectsOnlyById($id))){
    	foreach ($CN->getProjectsOnlyById($id) as $value) {
    		echo $value['contenido'];
    	}
    }
?>