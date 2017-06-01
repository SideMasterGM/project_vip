<?php
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */

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
                                                    </div>

                                                    <div class="col-xs-8">
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
                                                                                        <div class="col-xs-6">
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
                                                                                        <div class="col-xs-6">
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
                                                                            <p>
                                                                                <b>ID Facultad | CUR | Escuela</b>
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-xs-6">
                                                                             <p>
                                                                                <?php foreach ($ProjectInfo as $value) { echo $value['id_facultad_cur_escuela']; } ?>
                                                                            </p>
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