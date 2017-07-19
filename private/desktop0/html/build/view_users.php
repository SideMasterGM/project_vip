<?php
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */
 ?>

<div class="container-fluid">
    <div class="side-body padding-top">
    	<div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="title">
                                <i class="fa fa-pencil"></i> Registro de usuarios
                                <button type="button" class="btn btn-primary" style="position: absolute; top: 7px; right: 15px;" onclick="javascript: CreateUserNow();" title="Crear un nuevo usuario"><span class="fa fa-user-md"></span> Nuevo usuario</button>
                            </div>
                        	
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <table class="datatable table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nombre de usuario</th>
                                    <th>Correo electrónico</th>
                                    <th>Fecha de registro</th>
                                    <th>Registrado</th>
                                    <th>Contraseña cifrada</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Nombre de usuario</th>
                                    <th>Correo electrónico</th>
                                    <th>Fecha de registro</th>
                                    <th>Registrado</th>
                                    <th>Contraseña cifrada</th>
                                </tr>
                            </tfoot>
                            <?php include ("private/desktop0/html/build/CalcDate.php"); ?>
                            <tbody id="tbody_listArticle">
                                <?php
                                    foreach ($CN->getUsersAll() as $value) {

                                        $LastStartSession = $CN->getActivityLastStartSession($value['username']);
                                        foreach ($LastStartSession as $LSS) {
                                            $LastSS = $LSS['date_log_unix'];
                                        }

                                        $LastCloseSession = $CN->getActivityLastCloseSession($value['username']);
                                        foreach ($LastCloseSession as $LCS) {
                                            $LastCS = $LCS['date_log_unix'];
                                        }

                                        ?>
                                            <tr onclick="javascript: OnItemClickTrUser(this);">
                                                <td>
                                                    <?php
                                                        if ($LastSS > $LastCS){
                                                            ?>
                                                                <span class="fs11 text-muted ml10" title="Conectado"><i class="fa fa-circle text-info fs12 pr5"></i></span> 
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <span class="fs11 text-muted ml10" title="Desconectado"><i class="fa fa-circle text-alert fs12 pr5"></i></span> 
                                                            <?php
                                                        }
                                                        echo $value['username'];
                                                    ?>
                                                </td>
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