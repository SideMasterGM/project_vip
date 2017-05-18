<!-- 
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */
 -->

<div class="container-fluid">
    <div class="side-body padding-top">
    	<div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                        	<div class="title">
                        		Registro de proyectos
                        	</div>
                        	<div class="icon-addAgent-right">
                        		<i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" title="Crear un nuevo proyecto" onclick="javascript: window.location.href='./project'" ></i>
                                <i class="fa fa-users fa-2x" aria-hidden="true" title="Equipos" onclick="javascript: window.location.href='./team'" ></i>
                        	</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="datatable table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Facultad | CUR | Escuela</th>
                                    <th title="Código de Dictamen económico" >Dictamen económico</th>
                                    <th>Instancia de aprobación</th>
                                    <th title="Fecha de aprobación" >Fecha</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Facultad | CUR | Escuela</th>
                                    <th title="Código de Dictamen económico" >Dictamen económico</th>
                                    <th>Instancia de aprobación</th>
                                    <th title="Fecha de aprobación" >Fecha</th>
                                </tr>
                            </tfoot>

                            <tbody id="tbody_listArticle">
                                <?php

                                    $Connect_VIP = CDB("vip");
                                    $Connect_ALL = CDB("all");

                                    if (is_array($Connect_VIP->getProjects())){
                                        foreach ($Connect_VIP->getProjects() as $value) {
                                            
                                            ?>
                                                <tr onclick="javascript: OnItemClickTrProject(this);">
                                                    <td><?php echo $value['id_project']; ?></td>
                                                    <td><?php echo $value['nombre']; ?></td>
                                                    <td><?php echo $Connect_ALL->getOnlyFacCurEsc($value['id_facultad_cur_escuela']); ?></td>
                                                    <td><?php echo $value['cod_dictamen_economico']; ?></td>
                                                    <td><?php echo $Connect_VIP->getOnlyInstanciaAprobacion($value['id_instancia_aprobacion']); ?></td>
                                                    <td><?php echo $value['fecha_aprobacion']; ?></td>
                                                </tr>
                                            <?php
                                        }
                                    }                                   
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<?php include ("private/desktop0/html/build/modals.php"); ?>
        </div>
    </div>
</div>