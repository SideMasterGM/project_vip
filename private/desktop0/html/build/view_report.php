<?php
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */
    include ("private/desktop0/html/build/modals.php");

    if (!isset($_POST['GenerateReportArticleID'])){
        ?>
            <div class="side-body padding-top" style="margin-left: 25%;">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">
                                            <i class="fa fa-pencil"></i> Estado de informe
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>Para poder mostrar un reporte, usted debe seleccionar un proyecto. Para lograrlo, vaya al menú "Proyectos" y luego haga click en "Listar proyectos", sino haga click en <a href="./projects" style="background-color: tail;" >Ver Proyectos</a>.</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="javascript: GenerateReportGoProjects();">Ver Proyectos</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php
    } else {
        ?>
            <div class="container-fluid">
                <div class="side-body padding-top">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card">
                                
                                <?php
                                    $id = $_POST['GenerateReportArticleID'];
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

                                        $ProjectFacCurEsc = $CN_VIP->getOnlyFacCurEsc($ProjectIDFacCurEsc);

                                        ?>
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <div class="title">
                                                        <i class="fa fa-pencil-square-o"></i> <?php echo $ProjectNombre; ?>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary" style="float: right; margin: 12px;" onclick="javascript: GenerateReport();" title="Generar un reporte completo del proyecto">Descargar en PDF</button>
                                            </div>
                                            <div class="card-body">
                                                
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="background-color: #353D47; color: #fff;">
                                                                <h3 class="panel-title">Identificación del proyecto
                                                            </div>
                                                            <div class="panel-body">
                                                                <div>
                                                                    <div class="row">
                                                                        <div class="col-xs-8">
                                                                            <p>
                                                                                <b>Identificador</b>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-xs-4">
                                                                             <p>
                                                                                <?php echo $id; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-xs-8">
                                                                            <p>
                                                                                <b>ID Facultad | CUR | Escuela</b>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-xs-4">
                                                                             <p>
                                                                                <?php echo $ProjectIDFacCurEsc; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-xs-8">
                                                                            <p>
                                                                                <b>Fecha de aprobación</b>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-xs-4">
                                                                             <p>
                                                                                <?php echo $ProjectFechaAprobacion; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-xs-8">
                                                                            <p>
                                                                                <b>Código de Dictámen Económico</b>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-xs-4">
                                                                             <p>
                                                                                <?php echo $ProjectCodDictamenEcon; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-xs-8">
                                                                            <p>
                                                                                <b>ID de Instancia de Aprobación</b>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-xs-4">
                                                                             <p>
                                                                                <?php echo $ProjectIDInstanciaApro; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="background-color: #353D47; color: #fff;">
                                                                <h3 class="panel-title">Personas atendidas
                                                            </div>
                                                            <div class="panel-body">
                                                                <div>
                                                                    <div class="row">
                                                                        <div class="col-xs-8">
                                                                            <p>
                                                                                <b>Identificador</b>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-xs-4">
                                                                             <p>
                                                                                <?php echo $id; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-xs-8">
                                                                            <p>
                                                                                <b>ID Facultad | CUR | Escuela</b>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-xs-4">
                                                                             <p>
                                                                                <?php echo $ProjectIDFacCurEsc; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-8">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" style="background-color: #353D47; color: #fff;">
                                                                <h3 class="panel-title">Redacción | Recursos
                                                            </div>
                                                            <div class="panel-body">
                                                                <div>
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <div class="panel">
                                                                                <div class="panel-heading" role="tab" id="headingGenerateReport_Objects" style="background-color: #5587CB;">
                                                                                    <span class="panel-title">
                                                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseGenerateReport_Objects" aria-expanded="false" aria-controls="collapseGenerateReport_FacCurEs" style="color: #fff;"><span class="icon fa fa-user"></span>
                                                                                            Objetivos Generales, Específicos y resultados esperados
                                                                                        </a>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div id="collapseGenerateReport_Objects" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGenerateReport_Objects">
                                                                                <div class="panel-body">
                                                                                    <div class="row">
                                                                                        <div class="col-xs-12">
                                                                                            <?php 
                                                                                                $ProjectContentObjects = $CN_VIP->getProjectsOnlyById($id);
                                                                                                if (is_array($ProjectContentObjects)){
                                                                                                    
                                                                                                    foreach ($ProjectContentObjects as $value) { 
                                                                                                        echo $value['contenido'];
                                                                                                    }

                                                                                                } else {
                                                                                                    echo "-";
                                                                                                }

                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <div class="panel">
                                                                                <div class="panel-heading" role="tab" id="headingGenerateReport_ResourcesImages" style="background-color: #5587CB;">
                                                                                    <span class="panel-title">
                                                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseGenerateReport_ResourcesImages" aria-expanded="false" aria-controls="collapseGenerateReport_FacCurEs" style="color: #fff;"><span class="icon fa fa-user"></span>
                                                                                            Imágenes almacenadas
                                                                                        </a>
                                                                                    </span>
                                                                                </div>
                                                                            </div>

                                                                            <div id="collapseGenerateReport_ResourcesImages" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGenerateReport_ResourcesImages">
                                                                                <div class="panel-body">
                                                                                    <div class="row">
                                                                                        <div class="col-xs-12">
                                                                                            <div class="row">
                                                                                                    <?php 
                                                                                                        $getProjectImages = $CN_VIP->getProjectImgOnlyById($id);
                                                                                                        $CountParts = count($getProjectImages);
                                                                                                        $FirstPart  = floor($CountParts / 2);
                                                                                                        $SecondPart = $CountParts - $FirstPart;

                                                                                                        if (is_array($getProjectImages)){
                                                                                                            $CounterInit = 0;
                                                                                                            foreach ($getProjectImages as $value) {

                                                                                                                if ($CounterInit < $FirstPart){
                                                                                                                    if ($CounterInit == 0){
                                                                                                                        ?>
                                                                                                                            <div class="col-xs-6">
                                                                                                                                <div class="container_imgnowtest">
                                                                                                                                    <img onclick="javascript: SelectImgArticle(this);" src="<?php echo "private/desktop0/".$value['folder'].$value['src']; ?>" />
                                                                                                                                </div>
                                                                                                                        <?php
                                                                                                                    } else {
                                                                                                                        ?>
                                                                                                                            <div class="container_imgnowtest">
                                                                                                                                <img onclick="javascript: SelectImgArticle(this);" src="<?php echo "private/desktop0/".$value['folder'].$value['src']; ?>" />
                                                                                                                            </div>
                                                                                                                        <?php
                                                                                                                    }
                                                                                                                } else if ($CounterInit == $FirstPart) {

                                                                                                                    ?>
                                                                                                                        </div>
                                                                                                                        <div class="col-xs-6">
                                                                                                                            <div class="container_imgnowtest">
                                                                                                                                <img onclick="javascript: SelectImgArticle(this);" src="<?php echo "private/desktop0/".$value['folder'].$value['src']; ?>" />
                                                                                                                            </div>
                                                                                                                    <?php
                                                                                                                } else if ($CounterInit > $FirstPart && $CounterInit < $CountParts){
                                                                                                                    ?>
                                                                                                                        <div class="container_imgnowtest">
                                                                                                                            <img onclick="javascript: SelectImgArticle(this);" src="<?php echo "private/desktop0/".$value['folder'].$value['src']; ?>" />
                                                                                                                        </div>
                                                                                                                    <?php
                                                                                                                } else {
                                                                                                                    ?>
                                                                                                                        </div>
                                                                                                                    <?php
                                                                                                                }

                                                                                                                $CounterInit++;
                                                                                                            }
                                                                                                        }
                                                                                                    ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" style="background-color: #353D47; color: #fff;">
                                                            <h3 class="panel-title">Identificación del proyecto
                                                        </div>
                                                        <div class="panel-body">
                                                            <div>
                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                        <div class="panel">
                                                                            <div class="panel-heading" role="tab" id="headingGenerateReport_FacCurEsc" style="background-color: #5587CB;">
                                                                                <span class="panel-title">
                                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseGenerateReport_FacCurEs" aria-expanded="false" aria-controls="collapseGenerateReport_FacCurEs" style="color: #fff;"><span class="icon fa fa-user"></span>
                                                                                        Facultad | CUR | Escuela
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <div id="collapseGenerateReport_FacCurEs" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGenerateReport_FacCurEsc">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <div class="col-xs-12">
                                                                                        <?php 
                                                                                            echo $ProjectFacCurEsc;
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <div class="panel">
                                                                            <div class="panel-heading" role="tab" id="headingGenerateReport_InstanciaAprob" style="background-color: #5587CB;">
                                                                                <span class="panel-title">
                                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseGenerateReport_InstanciaAprob" aria-expanded="false" aria-controls="collapseGenerateReport_FacCurEs" style="color: #fff;"><span class="icon fa fa-user"></span>
                                                                                        Instancia de aprobación
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <div id="collapseGenerateReport_InstanciaAprob" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGenerateReport_InstanciaAprob">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <div class="col-xs-12">
                                                                                        <?php 

                                                                                            if (!is_bool($CN_VIP->getOnlyInstanciaAprobacion($ProjectIDInstanciaApro))){
                                                                                                echo $CN_VIP->getOnlyInstanciaAprobacion($ProjectIDInstanciaApro);
                                                                                            } else {
                                                                                                echo "-";
                                                                                            }

                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-xs-6">
                                                                       <div class="panel">
                                                                            <div class="panel-heading" role="tab" id="headingGenerateReport_InfoFinanciera" style="background-color: #5587CB;">
                                                                                <span class="panel-title">
                                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseGenerateReport_InfoFinanciera" aria-expanded="false" aria-controls="collapseGenerateReport_FacCurEs" style="color: #fff;"><span class="icon fa fa-user"></span>
                                                                                        Información financiera
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <div id="collapseGenerateReport_InfoFinanciera" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGenerateReport_InfoFinanciera">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <?php 
                                                                                        $ProjectInfoFinanciera = $CN_VIP->getProyectoFinancieraOnlyById($id);
                                                                                        if (is_array($ProjectInfoFinanciera)){
                                                                                            
                                                                                            foreach ($ProjectInfoFinanciera as $value) { 
                                                                                                $IFnombre_organismo = $value['nombre_organismo'];
                                                                                                $IFmonto_financiado = $value['monto_financiado'];
                                                                                                $IFaporte_unan      = $value['aporte_unan'];
                                                                                            }

                                                                                            ?>
                                                                                                <div class="col-xs-6">
                                                                                                    <p><b>Nombre del organismo </b></p>
                                                                                                    <p><b>Monto financiado </b></p>
                                                                                                    <p><b>Aporte UNAN </b></p>
                                                                                                </div>

                                                                                                <div class="col-xs-6">
                                                                                                    <p><?php echo $IFnombre_organismo; ?></p>

                                                                                                    <p><?php echo $IFmonto_financiado; ?></p>

                                                                                                    <p><?php echo $IFaporte_unan; ?></p>
                                                                                                </div>

                                                                                            <?php
                                                                                        } else {
                                                                                            echo "-";
                                                                                        }

                                                                                    ?>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <div class="panel">
                                                                            <div class="panel-heading" role="tab" id="headingGenerateReport_Temporalidad" style="background-color: #5587CB;">
                                                                                <span class="panel-title">
                                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseGenerateReport_Temporalidad" aria-expanded="false" aria-controls="collapseGenerateReport_FacCurEs" style="color: #fff;"><span class="icon fa fa-user"></span>
                                                                                        Temporalidad
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <div id="collapseGenerateReport_Temporalidad" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGenerateReport_Temporalidad">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <?php 
                                                                                        $ProjectTemporalidad = $CN_VIP->getProyectoTemporalidadOnlyById($id);
                                                                                        if (is_array($ProjectTemporalidad)){
                                                                                            
                                                                                            foreach ($ProjectTemporalidad as $value) { 
                                                                                                $Tmpduracion_meses      = $value['duracion_meses'];
                                                                                                $Tmpfecha_inicio        = $value['fecha_inicio'];
                                                                                                $Tmpfecha_finalizacion  = $value['fecha_finalizacion'];
                                                                                                $Tmpfecha_monitoreo     = $value['fecha_monitoreo'];
                                                                                            }

                                                                                            ?>
                                                                                                <div class="col-xs-8">
                                                                                                    <p><b>Duración en meses </b></p>
                                                                                                    <p><b>Fecha de inicio </b></p>
                                                                                                    <p><b>Fecha de finalización </b></p>
                                                                                                    <p><b>Fecha de monitoreo </b></p>
                                                                                                </div>

                                                                                                <div class="col-xs-4">
                                                                                                    <p><?php echo $Tmpduracion_meses; ?></p>
                                                                                                    <p><?php echo $Tmpfecha_inicio; ?></p>
                                                                                                    <p><?php echo $Tmpfecha_finalizacion; ?></p>
                                                                                                    <p><?php echo $Tmpfecha_monitoreo; ?></p>
                                                                                                </div>

                                                                                            <?php
                                                                                        } else {
                                                                                            echo "-";
                                                                                        }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-6">
                                                                        <div class="panel">
                                                                            <div class="panel-heading" role="tab" id="headingGenerateReport_ComunidadPoblacion" style="background-color: #5587CB;">
                                                                                <span class="panel-title">
                                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseGenerateReport_ComunidadPoblacion" aria-expanded="false" aria-controls="collapseGenerateReport_FacCurEs" style="color: #fff;"><span class="icon fa fa-user"></span>
                                                                                        Comunidad | Población
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <div id="collapseGenerateReport_ComunidadPoblacion" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGenerateReport_ComunidadPoblacion">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <?php 
                                                                                        $ProjectZonaGeografica = $CN_VIP->getProyectoZonaGeoBeneficiariosOnlyById($id);
                                                                                        
                                                                                        if (is_array($ProjectZonaGeografica)){
                                                                                            foreach ($ProjectZonaGeografica as $value) {
                                                                                                $ZGidComunidadPoblacion = $value['id_comunidad_poblacion'];
                                                                                                $ZGPersonasAtendidas    = $value['cantidad_personas_atendidas'];
                                                                                                $ZGNombreZonaGeografica = $value['nombre_zona_geografica'];
                                                                                            
                                                                                                $ProjectComunidadPoblacion = $CN_VIP->getOnlyComunidadPoblacion($ZGidComunidadPoblacion);
                                                                                                
                                                                                                if (!is_bool($ProjectComunidadPoblacion)){

                                                                                                    ?>
                                                                                                        <div class="col-xs-8">
                                                                                                            <p><b>Cantidad de personas atendidas </b></p>
                                                                                                            <p><b>Comunidad </b></p>
                                                                                                            <p><b>Zona geográfica </b></p>
                                                                                                        </div>

                                                                                                        <div class="col-xs-4">
                                                                                                            <p><?php echo $ZGPersonasAtendidas; ?></p>
                                                                                                            <p><?php echo $ProjectComunidadPoblacion; ?></p>
                                                                                                            <p><?php echo $ZGNombreZonaGeografica; ?></p>
                                                                                                        </div>
                                                                                                    <?php
                                                                                                }
                                                                                            }
                                                                                        } else {
                                                                                            echo "-";
                                                                                        }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-6">
                                                                        <div class="panel">
                                                                            <div class="panel-heading" role="tab" id="headingGenerateReport_Resultados" style="background-color: #5587CB;">
                                                                                <span class="panel-title">
                                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseGenerateReport_Resultados" aria-expanded="false" aria-controls="collapseGenerateReport_FacCurEs" style="color: #fff;"><span class="icon fa fa-user"></span>
                                                                                        Resultados
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <div id="collapseGenerateReport_Resultados" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGenerateReport_Resultados">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <?php 
                                                                                        $ProjectResultados = $CN_VIP->getProyectoResultadosOnlyById($id);
                                                                                        
                                                                                        if (is_array($ProjectResultados)){
                                                                                            foreach ($ProjectResultados as $value) {
                                                                                                $RTipoPublicacion   = $value['tipo_publicacion'];
                                                                                                $Rdatos_publicacion = $value['datos_publicacion'];
                                                                                                $Rotros_resultados  = $value['otros_resultados'];
                                                                                            
                                                                                                ?>
                                                                                                    <div class="col-xs-6">
                                                                                                        <p><b>Tipo de publicación </b></p>
                                                                                                        <p><b>Datos de publicación </b></p>
                                                                                                        <p><b>Otros resultados </b></p>
                                                                                                    </div>

                                                                                                    <div class="col-xs-6">
                                                                                                        <p><?php echo $RTipoPublicacion; ?></p>
                                                                                                        <p><?php echo $Rdatos_publicacion; ?></p>
                                                                                                        <p><?php echo $Rotros_resultados; ?></p>
                                                                                                    </div>
                                                                                                <?php
                                                                                            }
                                                                                        } else {
                                                                                            echo "-";
                                                                                        }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" style="background-color: #353D47; color: #fff;">
                                                            <h3 class="panel-title">Identificación del proyecto
                                                        </div>
                                                        <div class="panel-body">
                                                            <div>
                                                                <div class="row">
                                                                    <div class="col-xs-12">
                                                                        <div class="panel">
                                                                            <div class="panel-heading" role="tab" id="headingGenerateReport_FacCurEsc" style="background-color: #5587CB;">
                                                                                <span class="panel-title">
                                                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseGenerateReport_FacCurEsc" aria-expanded="false" aria-controls="collapseGenerateReport_FacCurEs" style="color: #fff;"><span class="icon fa fa-user"></span>
                                                                                        Redacción de resultados finales
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                        <div id="collapseGenerateReport_FacCurEsc" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingGenerateReport_FacCurEsc">
                                                                            <div class="panel-body">
                                                                                <div class="row">
                                                                                    <div class="col-xs-12">
                                                                                        <?php 
                                                                                            echo $ProjectFacCurEsc;
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    } else {
                                        exit();
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
?>