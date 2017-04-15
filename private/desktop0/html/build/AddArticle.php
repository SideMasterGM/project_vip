<?php
	
	@session_start();
	$usr = @$_SESSION['usr'];

	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$title 					= trim($_POST['pro_title']);
	$content 				= trim($_POST['pro_content']);

	$FacCurEsc 				= trim($_POST['pro_fac_cur_esc']);
	$IDInstanciaAprobacion 	= trim($_POST['pro_instancia_aprobacion']);
	$IDComunidadPoblacion	= trim($_POST['pro_comunidad_poblacion']);

	$DuracionMeses 			= trim($_POST['pro_duracion_meses']);
	$FechaAprobacion 		= trim($_POST['pro_fecha_aprobacion']);
	$FechaInicio 			= trim($_POST['pro_fecha_inicio']);
	$FechaFinalizacion 		= trim($_POST['pro_fecha_finalizacion']);
	$FechaMonitoreo 		= trim($_POST['pro_fecha_monitoreo']);

	$NombreOrganismo 		= trim($_POST['pro_nombre_organismo']);
	$MontoFinanciado 		= trim($_POST['pro_monto_financiado']);
	$AporteUNAN 			= trim($_POST['pro_aporte_unan']);

	$ZonaGeografica 		= trim($_POST['pro_zona_geografica']);

	$CodigoDictamen 		= trim($_POST['pro_cod_dictamen']);

	$TipoPublicacion 		= trim($_POST['pro_tipo_publicacion']);
	$DatosPublicacion 		= trim($_POST['pro_datos_publicacion']);
	$OtrosDatos 			= trim($_POST['pro_otros_datos']);

	$PersonasAtendidas 		= trim($_POST['pro_personas_atendidas']);



	



	
	$Q = "INSERT INTO article (id_art, title, content_es, content_en, price, department, city, local_address, id_agent, business_type, property_type, property_state, bed_room, living_room, parking, kitchen, longitude, latitude, date_log, date_log_unix, username) VALUES ('','".$title."','".$content_es."','".$content_es."','".$price."','".$department."','".$city."','".$local_address."','".$agent."','".$business_type."','".$property_type."','".$property_state."','".$bed_room."','".$living_room."','".$parking."','".(int)$kitchen."','".$coord_longitude."','".$coord_latitude."',NOW(),'".$date_log_unix."','".$username."');";

	if ($Conexion->query($Q)){
		
		$AskIDArticle = $Conexion->query("SELECT id_art FROM article ORDER BY id_art DESC LIMIT 1;")->fetch_array(MYSQLI_ASSOC);

		$tmp_img = $Conexion->query("SELECT * FROM tmp_img;");

		if ($tmp_img->num_rows > 0){
			while ($GetTmpImg = $tmp_img->fetch_array(MYSQLI_ASSOC)){
				$SetData = "INSERT INTO publish_img (id_img, folder, src, date_log, date_log_unix, id_art) VALUES ('','".$GetTmpImg['folder']."','".$GetTmpImg['src']."',NOW(),'".time()."','".$AskIDArticle['id_art']."');";
				if (!$Conexion->query($SetData)){
					echo "Ocurrió un error al intentar insertar: ".$GetTmpImg['src'].", en el artículo con el ID: ".$AskIDArticle['id_art'];
				} else {
					if (!$Conexion->query("DELETE FROM tmp_img WHERE id='".$GetTmpImg['id']."';")){
						echo "Problema al intentar eliminar el registro con id: ".$GetTmpImg['id'].", de la tabla tmp_img.";
					}
				}
			}
		}
	}

	echo "OK";

?>