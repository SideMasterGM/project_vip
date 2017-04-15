<?php
	
	@session_start();
	$usr = @$_SESSION['usr'];

	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	#Tabla: vip_proyecto
	$title 					= trim($_POST['pro_title']);
	$content 				= trim($_POST['pro_content']);

	$IDFacCurEsc 			= trim($_POST['pro_fac_cur_esc']);
	$FechaAprobacion 		= trim($_POST['pro_fecha_aprobacion']);
	$CodigoDictamen 		= trim($_POST['pro_cod_dictamen']);
	$IDInstanciaAprobacion 	= trim($_POST['pro_instancia_aprobacion']);
	
	#Tabla: vip_zona_geografica_beneficiarios
	$IDComunidadPoblacion	= trim($_POST['pro_comunidad_poblacion']);
	$PersonasAtendidas 		= trim($_POST['pro_personas_atendidas']);
	$ZonaGeografica 		= trim($_POST['pro_zona_geografica']);

	#Tabla: vip_temporalidad_proyecto
	$DuracionMeses 			= trim($_POST['pro_duracion_meses']);
	$FechaInicio 			= trim($_POST['pro_fecha_inicio']);
	$FechaFinalizacion 		= trim($_POST['pro_fecha_finalizacion']);
	$FechaMonitoreo 		= trim($_POST['pro_fecha_monitoreo']);

	#Tabla: vip_informacion_financiera
	$NombreOrganismo 		= trim($_POST['pro_nombre_organismo']);
	$MontoFinanciado 		= trim($_POST['pro_monto_financiado']);
	$AporteUNAN 			= trim($_POST['pro_aporte_unan']);

	#Tabla: vip_info_resultados_proyecto
	$TipoPublicacion 		= trim($_POST['pro_tipo_publicacion']);
	$DatosPublicacion 		= trim($_POST['pro_datos_publicacion']);
	$OtrosDatos 			= trim($_POST['pro_otros_datos']);

	if ($CN->addProyecto($title, $content, $IDFacCurEsc, $FechaAprobacion, $CodigoDictamen, $IDInstanciaAprobacion)){
		$id_project = $CN->getProyectoOnlyLastID($title);

		if ($CN->addProyectoZonaGeograficaBeneficiarios($id_project, $IDComunidadPoblacion, $PersonasAtendidas, $ZonaGeografica)){

			if ($CN->addProyectoTemporalidad($id_project, $DuracionMeses, $FechaInicio, $FechaFinalizacion, $FechaMonitoreo)){

				if ($CN->addProyectoInformacionFinanciera($id_project, $NombreOrganismo, $MontoFinanciado, $AporteUNAN)){

					if ($CN->addProyectoResultados($id_project, $TipoPublicacion, $DatosPublicacion, $OtrosDatos)){
						#Se hace un valcado de imágenes.

						
						
					} else {
						echo "No se ha podido registrar la información de resultados del proyecto con ID: ".$id_project;
					}

				} else {
					echo "No se ha podido registrar la Información Financiera del proyecto con ID: ".$id_project;
				}

			} else {
				echo "No se ha podido registrar la Temporalidad del proyecto con ID: ".$id_project;
			}

		} else {
			echo "No se ha podido registrar la Zona Geográfica de los beneficiarios del proyecto ID: ".$id_project;
		}

	} else {
		echo "No se ha podido registrar el proyecto.";
	}




	
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