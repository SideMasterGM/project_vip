<?php
	@session_start();
	$usr = @$_SESSION['usr'];

	include ("../../../connect_server/connect_server.php");
	$CN_VIP = CDB("vip");
	$CN_ALL = CDB("all");

	#Identificador del proyecto.
	$id_project 			= $_POST['pro_id_project'];

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

	if ($CN_VIP->updateProject($id_project, $title, $content, $IDFacCurEsc, $FechaAprobacion, $CodigoDictamen, $IDInstanciaAprobacion)){

		if ($CN_VIP->updateProyectoZonaGeograficaBeneficiarios($id_project, $IDComunidadPoblacion, $PersonasAtendidas, $ZonaGeografica)){

			if ($CN_VIP->updateProyectoTemporalidad($id_project, $DuracionMeses, $FechaInicio, $FechaFinalizacion, $FechaMonitoreo)){

				if ($CN_VIP->updateProyectoInformacionFinanciera($id_project, $NombreOrganismo, $MontoFinanciado, $AporteUNAN)){

					if ($CN_VIP->updateProyectoResultados($id_project, $TipoPublicacion, $DatosPublicacion, $OtrosDatos)){
						echo "OK";
					} else {
						echo "No se ha podido actualizar los resultados de un proyecto con ID: ".$id_project;
					}

				} else {
					echo "No se ha podido actualizar la información financiera del proyecto con ID: ".$id_project;
				}

			} else {
				echo "No se ha podido actualizar la temporalidad del proyecto con ID: ".$id_project;
			}

		} else {
			echo "No se ha podido actualizar la zona geográfica del proyecto con ID: ".$id_project;
		}

	} else {
		echo "No se ha podido actualizar la información del proyecto con ID: ".$id_project;
	}

?>