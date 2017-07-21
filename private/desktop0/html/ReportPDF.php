<?php
	
	include ("../../../private/connect_server/connect_server.php");
    
	require('fpdf/fpdf.php');

	class PDF extends FPDF {
		// Cabecera de página
		function Header() {
			// Logo
			$this->Image('../../../source/img/logo.png',8,5,16);
			// Times bold 15
			$this->SetFont('Times','B',12);
			// Movernos a la derecha
			$this->Cell(15);
			// Título
			$title = utf8_decode('UNAN - León');
			$this->Cell(30, 15, $title, 'C');


			// Logo
			$this->Image('../../../source/img/page.png',169,8,32);

			$this->SetFont('Times','B',11);
			// Movernos a la derecha
			$this->Cell(134);
			// Título
			#Texto de paginación en color blanco
		    $this->SetTextColor(255,255,255);

			$number_page = $this->PageNo();
			$this->Cell(30, 5, $number_page, 'C');

			// Salto de línea
			$this->Ln(12);
		}

		function TitleDesign(){
			$this->SetFont('Times','B',14);
			// Movernos a la derecha
			$this->Cell(85);
			// Título
			$vip = utf8_decode('VIP - PS');
			$this->Cell(30, 15, $vip, 'C');
			$this->Ln(8);

			$this->SetFont('Times','B',11);
			// Movernos a la derecha
			$this->Cell(25);
			// Título
			$vip = utf8_decode('VICERECTORÍA DE INVESTIGACIÓN, POSTGRADO Y PROYECCIÓN SOCIAL');
			$this->Cell(30, 15, $vip, 'C');
			$this->Ln(2);

			$this->SetFont('Times','B',11);
			// Movernos a la derecha
			$this->Cell(18);
			// Título
			$this->Cell(30, 15, '__________________________________________________________________________________', 'C');
			$this->Ln(6);

			$this->SetFont('Times','B',11);
			// Movernos a la derecha
			$this->Cell(68);
			// Título
			$vip = utf8_decode('Sistema de Gestión de Proyectos');
			$this->Cell(30, 15, $vip, 'C');
			$this->Ln(10);
		}

		function ProjectTitle($ProjectNombre, $fecha_aprobacion){

			$this->SetFont('Times','B',11);
			// Movernos a la derecha
			$this->Cell(1);
			// Título
			$vip = utf8_decode('NOMBRE DEL PROYECTO: ');
			$this->Cell(30, 20, $vip, 'C');
			$this->Ln(7);

			$this->SetFont('Times','B',11);
			// Movernos a la derecha
			$this->Cell(15);
			// Título
			$vip = utf8_decode($ProjectNombre);
			$this->Cell(30, 20, $vip, 'C');

			$this->SetFont('Times','B',11);
			// Movernos a la derecha
			$this->Cell(75);
			// Título
			$vip = utf8_decode('FECHA DE APROBACIÓN: ');
			$this->Cell(30, 6, $vip, 'C');
			// $this->Ln(7);

			$this->SetFont('Times','B',11);
			// Movernos a la derecha
			$this->Cell(-15);
			// Título
			$vip = utf8_decode($fecha_aprobacion);
			$this->Cell(30, 20, $vip, 'C');

			$this->Ln(25);
		}

		function TableIDProject($id, $ProjectIDFacCurEsc, $ProjectFechaAprobacion, $ProjectCodDictamenEcon, $ProjectIDInstanciaApro){
			// Identificación del proyecto
			$this->Image('../../../source/img/id_project.png',9.8,72.5,70.6);
			// Anchuras de las columnas
		    $this->SetFont('Times','B',9);
		    $w = array(50, 20);
		   
		    $this->Cell($w[0],6,'Identificador','LR');
		    $this->Cell($w[1],6,utf8_decode($id),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($w),0,'','T');


		    $x = array(50, 20);
		   	
		    $this->Ln();
		    $this->Cell($x[0],6,'ID Facultar | CUR | Escuela','LR');
		    $this->Cell($x[1],6,utf8_decode($ProjectIDFacCurEsc),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($x),0,'','T');

		    $c = array(50, 20);
		   	
		    $this->Ln();
		    $this->Cell($c[0],6,utf8_decode('Fecha de Aprobación'),'LR');
		    $this->Cell($c[1],6,utf8_decode($ProjectFechaAprobacion),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($c),0,'','T');

		    $a = array(50, 20);
		   	
		    $this->Ln();
		    $this->Cell($a[0],6,utf8_decode('Código de Dictámen Económico'),'LR');
		    $this->Cell($a[1],6,utf8_decode($ProjectCodDictamenEcon),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($a),0,'','T');

		    $b = array(50, 20);
		   	
		    $this->Ln();
		    $this->Cell($b[0],6,utf8_decode('ID de Instancia de Aprobación'),'LR');
		    $this->Cell($b[1],6,utf8_decode($ProjectIDInstanciaApro),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($b),0,'','T');
			$this->Ln(15);
		}

		function TableTeamLink($id_project, $ProjectTeams){
			// Identificación del proyecto
			$this->Image('../../../source/img/TeamLink.png',9.8,117.5,70.6);

            $ProjectTeamsCount = 0;
            if (is_array($ProjectTeams)){
                foreach ($ProjectTeams as $value) { 
                    if ($value['id_project'] == $id_project){
                        $ProjectTeamsCount++;
                       
                        if ($ProjectTeamsCount <= 1){
							// Anchuras de las columnas
						    $this->SetFont('Times','B',9);
						    $w = array(20, 50);
						   
						    $this->Cell($w[0],6,'Equipo '.$ProjectTeamsCount,'LR');
						    $this->Cell($w[1],6,utf8_decode($value['nombre']),'LR');

						    $this->Ln();
						    $this->Cell(array_sum($w),0,'','T');
                        } else if ($ProjectTeamsCount > 1){
						    $x = array(20, 50);
						   	
						    $this->Ln();
						    $this->Cell($x[0],6,'Equipo '.$ProjectTeamsCount,'LR');
						    $this->Cell($x[1],6,utf8_decode($value['nombre']),'LR');

						    $this->Ln();
						    $this->Cell(array_sum($x),0,'','T');
                        }                                   
                    }
                }
            }

			$this->Ln(15);
		}

		function TableTeamCoordsLink($Counter, $ValTeam, $ValMember){
            if ($Counter <= 1){
            	$this->Image('../../../source/img/TeamCoords.png',9.8,155.5,70.6);
				// Anchuras de las columnas
			    $this->SetFont('Times','B',9);
			    $w = array(40, 30);
			   
			    $this->Cell($w[0],6,$ValTeam,'LR');
			    $this->Cell($w[1],6,utf8_decode($ValMember),'LR');

			    $this->Ln();
			    $this->Cell(array_sum($w),0,'','T');
            } else if ($Counter > 1){
			    $x = array(40, 30);
			   	
			    $this->Ln();
			    $this->Cell($x[0],6,$ValTeam,'LR');
			    $this->Cell($x[1],6,utf8_decode($ValMember),'LR');

			    $this->Ln();
			    $this->Cell(array_sum($x),0,'','T');
            }                                   
		}

		function ProjectDetailsFacCurEsc($ProjectIDFacCurEsc){
			$this->Image('../../../source/img/FacCurEsc.png',83,72.6,62);

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(73);
			// Título
			$vip = utf8_decode($ProjectIDFacCurEsc);
			$this->Cell(30, -80, $vip, 'C');
		}

		function ProjectDetailsInstanciaAprobacion($InstanciaAprobacion){
			$this->Image('../../../source/img/InstanciaAprobacion.png',135,72.6,62);

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(30);
			// Título
			$vip = utf8_decode($InstanciaAprobacion);
			$this->Cell(30, -80, $vip, 'C');
		}

		function ProjectDetailsInformacionFinanciera($IFnombre_organismo, $IFmonto_financiado, $IFaporte_unan, $IFPro_Moneda){
			$this->Image('../../../source/img/InformacionFinanciera.png',83,94,62);

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-90);
			// Título
			$vip = utf8_decode("Nombre del organismo: ");
			$this->Cell(30, -40, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-25);
			// Título
			$vip = utf8_decode($IFnombre_organismo);
			$this->Cell(30, -30, $vip, 'C');

			####################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-35);
			// Título
			$vip = utf8_decode("Monto financiado: ");
			$this->Cell(30, -20, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-1);
			// Título
			$vip = utf8_decode($IFPro_Moneda.number_format($IFmonto_financiado, 2, '.', ','));
			$this->Cell(30, -20, $vip, 'C');

			####################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-59);
			// Título
			$vip = utf8_decode("Aporte UNAN: ");
			$this->Cell(30, -10, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-1);
			// Título
			$vip = utf8_decode($IFPro_Moneda.number_format($IFaporte_unan, 2, '.', ','));
			$this->Cell(30, -10, $vip, 'C');
		}

		function ProjectDetailsTemporalidad($Tmpduracion_meses, $Tmpfecha_inicio, $Tmpfecha_finalizacion, $Tmpfecha_monitoreo){
			$this->Image('../../../source/img/Temporalidad.png',135,94,62);

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(1);
			// Título
			$vip = utf8_decode("Duración en meses: ");
			$this->Cell(30, -40, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(5);
			// Título
			$vip = utf8_decode($Tmpduracion_meses);
			$this->Cell(30, -40, $vip, 'C');

			#################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-65);
			// Título
			$vip = utf8_decode("Fecha de inicio: ");
			$this->Cell(30, -30, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(5);
			// Título
			$vip = utf8_decode($Tmpfecha_inicio);
			$this->Cell(30, -30, $vip, 'C');

			#################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-65);
			// Título
			$vip = utf8_decode("Fecha de finalización: ");
			$this->Cell(30, -20, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(5);
			// Título
			$vip = utf8_decode($Tmpfecha_finalizacion);
			$this->Cell(30, -20, $vip, 'C');

			#################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-65);
			// Título
			$vip = utf8_decode("Fecha de monitoreo: ");
			$this->Cell(30, -10, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(5);
			// Título
			$vip = utf8_decode($Tmpfecha_monitoreo);
			$this->Cell(30, -10, $vip, 'C');

		}

		function ProjectDetailsComunidadPoblacion($ZGPersonasAtendidas, $ZGNombreZonaGeografica, $ProjectComunidadPoblacion){
			$this->Image('../../../source/img/InformacionFinanciera.png',83,130,62);

			#################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-125);
			// Título
			$vip = utf8_decode("Nº de personas atendidas: ");
			$this->Cell(30, 35, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-20);
			// Título
			$vip = utf8_decode($ZGPersonasAtendidas);
			$this->Cell(30, 45, $vip, 'C');

			#################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-40);
			// Título
			$vip = utf8_decode("Comunidad: ");
			$this->Cell(30, 55, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-22);
			// Título
			$vip = utf8_decode($ProjectComunidadPoblacion);
			$this->Cell(30, 65, $vip, 'C');

			#################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-38);
			// Título
			$vip = utf8_decode("Zona geográfica: ");
			$this->Cell(30, 75, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-20);
			// Título
			$vip = utf8_decode($ZGNombreZonaGeografica);
			$this->Cell(30, 85, $vip, 'C');
		}

		function ProjectDetailsResultados($RTipoPublicacion, $Rdatos_publicacion, $Rotros_resultados){
			$this->Image('../../../source/img/Resultados.png',135,130,62);

			#################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(20);
			// Título
			$vip = utf8_decode("Tipo de publicación: ");
			$this->Cell(30, 35, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-25);
			// Título
			$vip = utf8_decode($RTipoPublicacion);
			$this->Cell(30, 45, $vip, 'C');

			#################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-35);
			// Título
			$vip = utf8_decode("Datos de publicación: ");
			$this->Cell(30, 55, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-25);
			// Título
			$vip = utf8_decode($Rdatos_publicacion);
			$this->Cell(30, 65, $vip, 'C');

			#################################################

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-35);
			// Título
			$vip = utf8_decode("Otros resultados: ");
			$this->Cell(30, 75, $vip, 'C');

			$this->SetFont('Times','B',9);
			// Movernos a la derecha
			$this->Cell(-25);
			// Título
			$vip = utf8_decode($Rotros_resultados);
			$this->Cell(30, 85, $vip, 'C');

		}
		
		// Pie de página
		function Footer() {
			// Posición: a 1,5 cm del final
			$this->SetY(-15);
			// Times italic 8
			$this->SetFont('Times','I',8);
			// Número de página
			$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
		}
	}

	$id = 3;
	$CN_VIP = CDB("vip");
    
    if (is_array($CN_VIP->getProjectsOnlyById($id))){
        $ProjectInfo = $CN_VIP->getProjectsOnlyById($id);

        foreach ($ProjectInfo as $value) { 
            $ProjectNombre          = $value['nombre']; 
            $ProjectIDFacCurEsc     = $value['id_facultad_cur_escuela']; 
            $ProjectFechaAprobacion = $value['fecha_aprobacion']; 
            $ProjectCodDictamenEcon = $value['cod_dictamen_economico']; 
            $ProjectIDInstanciaApro = $value['id_instancia_aprobacion']; 
        }
    }

    $ProjectFacCurEsc = $CN_VIP->getOnlyFacCurEsc($ProjectIDFacCurEsc);

    #Expulsar la información de Instancia de Aprobación
    if (!is_bool($CN_VIP->getOnlyInstanciaAprobacion($ProjectIDInstanciaApro))){
        $InstanciaAprobacion = $CN_VIP->getOnlyInstanciaAprobacion($ProjectIDInstanciaApro);
    } else {
        $InstanciaAprobacion = "No hay información";
    }

    $ProjectTeams = $CN_VIP->getTeamProject();
	
    #Información Financiera
    $ProjectInfoFinanciera = $CN_VIP->getProyectoFinancieraOnlyById($id);
    if (is_array($ProjectInfoFinanciera)){
        
        foreach ($ProjectInfoFinanciera as $value) { 
            $IFnombre_organismo = $value['nombre_organismo'];
            $IFmonto_financiado = $value['monto_financiado'];
            $IFaporte_unan      = $value['aporte_unan'];
            $IFPro_Moneda       = $value['moneda'];
        }
    }

    #Datos de Temporalidad
	$ProjectTemporalidad = $CN_VIP->getProyectoTemporalidadOnlyById($id);
    if (is_array($ProjectTemporalidad)){
        foreach ($ProjectTemporalidad as $value) { 
            $Tmpduracion_meses      = $value['duracion_meses'];
            $Tmpfecha_inicio        = $value['fecha_inicio'];
            $Tmpfecha_finalizacion  = $value['fecha_finalizacion'];
            $Tmpfecha_monitoreo     = $value['fecha_monitoreo'];
        }
    }

    #Datos de zonas geográficas.
    $ProjectZonaGeografica = $CN_VIP->getProyectoZonaGeoBeneficiariosOnlyById($id);
                                                                                        
    if (is_array($ProjectZonaGeografica)){
        foreach ($ProjectZonaGeografica as $value) {
            $ZGidComunidadPoblacion = $value['id_comunidad_poblacion'];
            $ZGPersonasAtendidas    = $value['cantidad_personas_atendidas'];
            $ZGNombreZonaGeografica = $value['nombre_zona_geografica'];
        
            $ProjectComunidadPoblacion = $CN_VIP->getOnlyComunidadPoblacion($ZGidComunidadPoblacion);
        }
    }

    #Datos de Resultados
    $ProjectResultados = $CN_VIP->getProyectoResultadosOnlyById($id);
                                                                                        
    if (is_array($ProjectResultados)){
        foreach ($ProjectResultados as $value) {
            $RTipoPublicacion   = $value['tipo_publicacion'];
            $Rdatos_publicacion = $value['datos_publicacion'];
            $Rotros_resultados  = $value['otros_resultados'];        
        }
    }

	// Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->TitleDesign();
	$pdf->ProjectTitle($ProjectNombre, $ProjectFechaAprobacion);
	$pdf->TableIDProject($id, $ProjectIDFacCurEsc, $ProjectFechaAprobacion, $ProjectCodDictamenEcon, $ProjectIDInstanciaApro);
	$pdf->ProjectDetailsFacCurEsc($ProjectFacCurEsc);
	$pdf->ProjectDetailsInstanciaAprobacion($InstanciaAprobacion);

	$pdf->ProjectDetailsInformacionFinanciera($IFnombre_organismo, $IFmonto_financiado, $IFaporte_unan, $IFPro_Moneda);
	$pdf->ProjectDetailsTemporalidad($Tmpduracion_meses, $Tmpfecha_inicio, $Tmpfecha_finalizacion, $Tmpfecha_monitoreo);
	$pdf->ProjectDetailsComunidadPoblacion($ZGPersonasAtendidas, $ZGNombreZonaGeografica, $ProjectComunidadPoblacion);
	$pdf->ProjectDetailsResultados($RTipoPublicacion, $Rdatos_publicacion, $Rotros_resultados);

	$pdf->Ln(-1);
	$pdf->TableTeamLink($id, $ProjectTeams);
	// for($i=1;$i<=40;$i++)
	// 	$pdf->Cell(0,10,'Imprimiendo línea número '.$i,1,1);

    $ProjectTeamsCoords = $CN_VIP->getTeamProject();
    $Counter = 0;                                                         
    if (is_array($ProjectTeamsCoords)){
        foreach ($ProjectTeamsCoords as $ValTeam) {
            if ($ValTeam['id_project'] == $id){

                $ProjectTeamsMember = $CN_VIP->getTeamMembersAll($ValTeam['id_team']);

                if (is_array($ProjectTeamsMember)){
                    foreach ($ProjectTeamsMember as $ValMember) {

                        $ProjectTeamsCoord = $CN_VIP->getCoordinators();

                        if (is_array($ProjectTeamsCoord)){
                            foreach ($ProjectTeamsCoord as $ValCoord) {

                                if ($ValCoord['id_member'] == $ValMember['id_member']){
                                	$Counter++;
                                   	$pdf->TableTeamCoordsLink($Counter, $ValTeam['nombre'], $ValMember['firts_name']);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    $pdf->Ln(5);
	
	$pdf->Output();
?>