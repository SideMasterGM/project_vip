<?php
	
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$Enter = $_POST['writeFacCutEsc'];

	if ($CN->addInstanciaAprobacion($Enter)){
		if (is_array($CN->getProjectInstanciaAprobacion())){
            foreach ($CN->getProjectInstanciaAprobacion() as $value) {
                ?>
                    <span class="label label-primary" style="font-size: 16px; margin: 10px 10px 0 0; display: inline-table;" ><?php echo $value['nombre_instancia_aprobacion']; ?>
                    	<i class="fa fa-times" style="margin: 0 5px; cursor: pointer;" title="Eliminar" aria-hidden="true" onclick="javascript: DeleteTagInstanciaAprobacion('<?php echo $value['id'] ?>');" ></i>
                    </span>
                <?php
            }
        } else if (is_bool($CN->getProjectInstanciaAprobacion())){
            #Opcional para agregar un diálogo.
        }
	}
?>