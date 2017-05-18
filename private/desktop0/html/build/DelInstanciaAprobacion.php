<?php
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */

	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$id = $_POST['DelTagInstanciaAprobacion'];

	if ($CN->deleteInstanciaAprobacion($id)){
		if (is_array($CN->getProjectInstanciaAprobacion())){
            foreach ($CN->getProjectInstanciaAprobacion() as $value) {
                ?>
                    <span class="label label-primary" style="font-size: 16px; background-color: #353D47; text-align: left; padding:10px; width:47.5%; margin: 10px 10px 0 0; display: inline-table;" >
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                        <?php 
                            $NombreInstanciaAprobacion = trim($value['nombre_instancia_aprobacion']);
                            if (iconv_strlen($NombreInstanciaAprobacion) >= 20){
                                $NombreInstanciaAprobacion = substr($NombreInstanciaAprobacion, 0, 20)."...";
                            }

                            echo $NombreInstanciaAprobacion;
                        ?>
                        <i class="fa fa-times" style="margin: -15px 5px 10px 0px; float: right; cursor: pointer;" title="Eliminar <?php echo $value['nombre_instancia_aprobacion']; ?>" aria-hidden="true" onclick="javascript: DeleteTagInstanciaAprobacion('<?php echo $value['id'] ?>');" ></i>
                    </span>
                <?php
            }
        } else if (is_bool($CN->getProjectInstanciaAprobacion())){
            #Opcional para agregar un diálogo.
        }
	}
?>