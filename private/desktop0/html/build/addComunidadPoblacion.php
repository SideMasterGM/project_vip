<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("all");

	$Enter = $_POST['writeComunidadPoblacion'];

	if ($CN->addComunidadPoblacion($Enter)){
        if (is_array($CN->getProjectComunidadPoblacion())){
            foreach ($CN->getProjectComunidadPoblacion() as $value) {
                ?>
                    <span class="label label-primary" style="font-size: 16px; background-color: #353D47; text-align: left; padding:10px; width:100%; margin: 10px 10px 0 0; display: inline-table;" ><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <?php echo $value['nombre_muni']; ?>
                        <i class="fa fa-times" style="margin: 0 5px; position: absolute; right: 8%; cursor: pointer;" title="Eliminar <?php echo $value['nombre_muni']; ?>" aria-hidden="true" onclick="javascript: DeleteTagComunidadPoblacion('<?php echo $value['cod_muni'] ?>');" ></i>
                    </span>
                <?php
            }
        } else if (is_bool($CN->getProjectComunidadPoblacion())){
            #Opcional para agregar un diálogo.
        }
    }
?>