<?php
	#Se llama a la conexión.
	include ("../../../connect_server/connect_server.php");

	#Se utiliza la base de datos VIP.
	$CN = CDB("vip");

	#Este identifica el proyecto.
	$id_project = $_POST['newidimgdel'];

	#Nombre del recurso de tipo imagen.
	$src 		= $CN->CleanString(trim(urldecode($_POST['MynImgDel'])));

	//echo "ID: ".$id_project.", SRC: ".$src;

	#Se verifica que devuelva el array que contiene la información.
	if (is_array($CN->getProjectImg())){
		#Recorrer las filas que contiene la tabla donde se encuentran almacenadas las imágenes.
		foreach ($CN->getProjectImg() as $R) {

			#Si es igual al ID de proyecto y SRC que se busca.
			if ($R['id_project'] == $id_project && $R['src'] == $src){

				#Se cambian los modos para tener permisos de escritura.
				chmod("../../".$R['folder'].$R['src'], 0777);

				#Con los permisos asignados se puede pasar a eliminar el recurso.
				unlink("../../".$R['folder'].$R['src']);

				#Se verifica que la fila o el registro específico se elimine.
				if ($CN->deleteProjectImgBySrc($id_project, $src)){
					echo "OK";
				}
			}
		}
	} else if (is_bool($CN->getProjectImg())){
		#En caso de que falle desde el inicio, se retorna un mensaje "Fail".
		echo "Fail";
	}
?>