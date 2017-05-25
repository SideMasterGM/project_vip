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
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title">
                                            <i class="fa fa-pencil-square-o"></i> <?php echo "Título del proyecto"; ?>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" style="float: right; margin: 12px;" onclick="javascript: GenerateReport();" title="Generar un reporte completo del proyecto">Descargar en PDF</button>
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php
    }

?>