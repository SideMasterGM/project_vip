<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("all");

	$Enter = $_POST['writeFacCutEsc'];

	if ($CN->addFacCurEsc($Enter)){
        if (is_array($CN->getProjectFacCurEsc())){
            foreach ($CN->getProjectFacCurEsc() as $value) {
                ?>
                    <span class="label label-primary" style="font-size: 16px; text-align: left; padding:10px; width:100%; margin: 10px 10px 0 0; display: inline-table;" ><?php echo $value['nombrefac']; ?>
                        <i class="fa fa-times" style="margin: 0 5px; position: absolute; right: 8%; cursor: pointer;" title="Eliminar <?php echo $value['nombrefac']; ?>" aria-hidden="true" onclick="javascript: DeleteTagFacCurEsc('<?php echo $value['codigo_facultad'] ?>');" ></i>
                    </span>
                <?php
            }
        } else if (is_bool($CN->getProjectFacCurEsc())){
            #Opcional para agregar un diálogo.
        }
    }
?>