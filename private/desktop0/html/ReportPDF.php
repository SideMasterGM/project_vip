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

			$this->Ln(30);
		}

		function TableIDProject($id, $ProjectIDFacCurEsc, $ProjectFechaAprobacion, $ProjectCodDictamenEcon, $ProjectIDInstanciaApro){
			// Identificación del proyecto
			$this->Image('../../../source/img/id_project.png',9.8,77,75.5);
			// Anchuras de las columnas
		    $this->SetFont('Times','B',9);
		    $w = array(50, 25);
		   
		    $this->Cell($w[0],6,'Identificador','LR');
		    $this->Cell($w[1],6,utf8_decode($id),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($w),0,'','T');


		    $x = array(50, 25);
		   	
		    $this->Ln();
		    $this->Cell($x[0],6,'ID Facultar | CUR | Escuela','LR');
		    $this->Cell($x[1],6,utf8_decode($ProjectIDFacCurEsc),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($x),0,'','T');

		    $c = array(50, 25);
		   	
		    $this->Ln();
		    $this->Cell($c[0],6,utf8_decode('Fecha de Aprobación'),'LR');
		    $this->Cell($c[1],6,utf8_decode($ProjectFechaAprobacion),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($c),0,'','T');

		    $a = array(50, 25);
		   	
		    $this->Ln();
		    $this->Cell($a[0],6,utf8_decode('Código de Dictámen Económico'),'LR');
		    $this->Cell($a[1],6,utf8_decode($ProjectCodDictamenEcon),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($a),0,'','T');

		    $b = array(50, 25);
		   	
		    $this->Ln();
		    $this->Cell($b[0],6,utf8_decode('ID de Instancia de Aprobación'),'LR');
		    $this->Cell($b[1],6,utf8_decode($ProjectIDInstanciaApro),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($b),0,'','T');
			$this->Ln(5);
		}

		function TableDetailsFinances($id, $ProjectIDFacCurEsc, $ProjectFechaAprobacion, $ProjectCodDictamenEcon, $ProjectIDInstanciaApro){
			// Identificación del proyecto
			$this->Image('../../../source/img/id_project.png',9.8,77,75.5);
			// Anchuras de las columnas
		    $this->SetFont('Times','B',9);
		    $w = array(50, 25);
		   
		    $this->Cell($w[0],6,'Identificador','LR');
		    $this->Cell($w[1],6,utf8_decode($id),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($w),0,'','T');

		    $x = array(50, 25);
		   	
		    $this->Ln();
		    $this->Cell($x[0],6,'ID Facultar | CUR | Escuela','LR');
		    $this->Cell($x[1],6,utf8_decode($ProjectIDFacCurEsc),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($x),0,'','T');

		    $c = array(50, 25);
		   	
		    $this->Ln();
		    $this->Cell($c[0],6,utf8_decode('Fecha de Aprobación'),'LR');
		    $this->Cell($c[1],6,utf8_decode($ProjectFechaAprobacion),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($c),0,'','T');

		    $a = array(50, 25);
		   	
		    $this->Ln();
		    $this->Cell($a[0],6,utf8_decode('Código de Dictámen Económico'),'LR');
		    $this->Cell($a[1],6,utf8_decode($ProjectCodDictamenEcon),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($a),0,'','T');

		    $b = array(50, 25);
		   	
		    $this->Ln();
		    $this->Cell($b[0],6,utf8_decode('ID de Instancia de Aprobación'),'LR');
		    $this->Cell($b[1],6,utf8_decode($ProjectIDInstanciaApro),'LR');

		    $this->Ln();
		    $this->Cell(array_sum($b),0,'','T');
			
			$this->Ln(20);

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


	// Creación del objeto de la clase heredada
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->TitleDesign();
	$pdf->ProjectTitle($ProjectNombre, $ProjectFechaAprobacion);
	$pdf->TableIDProject($id, $ProjectIDFacCurEsc, $ProjectFechaAprobacion, $ProjectCodDictamenEcon, $ProjectIDInstanciaApro);
	$pdf->TableDetailsFinances($id, $ProjectIDFacCurEsc, $ProjectFechaAprobacion, $ProjectCodDictamenEcon, $ProjectIDInstanciaApro);

	// for($i=1;$i<=40;$i++)
	// 	$pdf->Cell(0,10,'Imprimiendo línea número '.$i,1,1);

	$pdf->Output();
?>
