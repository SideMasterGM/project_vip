<?php
	include ("../../../connect_server/connect_server.php");

    $CN = CDB("vip");

    $id = $_POST['ValueArticleByID'];

    if (is_array($CN->getProjectsOnlyById($id))){
    	foreach ($CN->getProjectsOnlyById($id) as $value) {
    		echo $value['contenido'];
    	}
    }

    include ("../../connect_server/connect_server.php");
    include ("CalcDate.php");


    $Data = $Conexion->query("SELECT * FROM article WHERE id_art='".$id."';");
    
    if ($Data->num_rows == 1){
      $Data = $Data->fetch_array(MYSQLI_ASSOC);

      echo $Data['content_es'];

    }

?>