<div class="container-fluid">
    <div class="side-body padding-top">
    	<div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                        	<div class="title">
                        		<i class="fa fa-pencil"></i> Registro de equipos
                                <?php
                                    $CNEx = CDB("vip");

                                    ?>
                                        <select id="select_project" onchange="javascript: CreateTeam();">
                                            <optgroup label="Lista de proyectos">
                                    <?php

                                        foreach ($CNEx->getProjects() as $value) {
                                            ?>
                                                <option value="<?php echo $value['id_project']; ?>"><?php echo $value['nombre']; ?></option>
                                            <?php                                                              
                                        }

                                    ?>
                                            </optgroup>
                                        </select>
                                    <?php
                                ?>
                        	</div>

                        	<div class="icon-addAgent-right">
                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" title="Crear un nuevo proyecto" onclick="javascript: window.location.href='./project';" ></i>
                                
                                <i class="fa fa-users fa-2x" aria-hidden="true" title="Crear un nuevo equipo" onclick="javascript: CreateTeam();" ></i>
                                
                                <i class="fa fa-sitemap fa-2x" aria-hidden="true" title="Coordinación" onclick="javascript: CreateUserNow();" ></i>
                        		
                                <i class="fa fa-refresh fa-2x" aria-hidden="true" title="Recargar" onclick="javascript: window.location.reload();" ></i>
                        	</div>
                        </div>
                    </div>
    

                    <div class="card-body">
                        <table class="datatable table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del equipo</th>
                                    <th>Fecha de registro</th>
                                    <th>Registrado</th>
                                    <th>Proyecto vinculado</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del equipo</th>
                                    <th>Fecha de registro</th>
                                    <th>Registrado</th>
                                    <th>Proyecto vinculado</th>
                                </tr>
                            </tfoot>
                            <?php include ("private/desktop0/html/build/CalcDate.php"); ?>
                            <tbody id="tbody_listArticle">
                                <?php
                                    foreach ($CN->getUsersAll() as $value) {
                                        ?>
                                            <tr onclick="javascript: OnItemClickTrUser(this);">
                                                <td><?php echo $value['username']; ?></td>
                                                <td><?php echo $value['email']; ?></td>
                                                <td><?php echo $value['date_log']; ?></td>
                                                <td><?php echo nicetime(date("Y-m-d H:i", $value['date_log_unix'])); ?></td>
                                                <td><?php echo $CN->getUserPwd($value['username']); ?></td>
                                             </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <form id="ShowImgPerfilUser">
                    	<input type="hidden" name="nombre_de_usuario" id="nombre_de_usuario" />
                    </form>
                </div>
            </div>
			<?php include ("private/desktop0/html/build/modals.php"); ?>
        </div>
    </div>
</div>