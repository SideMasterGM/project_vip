<?php
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */

	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$Enter = $_POST['writeComunidadPoblacion'];

	if ($CN->addComunidadPoblacion($Enter)){
        if (is_array($CN->getProjectComunidadPoblacion())){
            foreach ($CN->getProjectComunidadPoblacion() as $value) {
                ?>
                    <span class="label label-primary" style="font-size: 16px; background-color: #353D47; text-align: left; padding:10px; width:47.5%; margin: 10px 10px 0 0; display: inline-table;" ><i class="fa fa-map-marker" aria-hidden="true"></i>
                        <?php 
                            $NombreMunicipio = trim($value['nombre_muni']);
                            if (iconv_strlen($NombreMunicipio) >= 17){
                                $NombreMunicipio = substr($NombreMunicipio, 0, 17)."...";
                            }

                            echo $NombreMunicipio;
                        ?>
                        <i class="fa fa-times" style="margin: -15px 5px 10px 0px; float: right; cursor: pointer;" title="Eliminar <?php echo $value['nombre_muni']; ?>" aria-hidden="true" onclick="javascript: DeleteTagComunidadPoblacion('<?php echo $value['cod_muni'] ?>');" ></i>
                    </span>
                <?php
            }
        } else if (is_bool($CN->getProjectComunidadPoblacion())){
            #Opcional para agregar un diálogo.
        }
    }
?>