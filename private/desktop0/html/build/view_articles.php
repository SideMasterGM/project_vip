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
                                    $GetArticle = $Conexion->query("SELECT * FROM article;");

                                    while ($RArticle = $GetArticle->fetch_array(MYSQLI_ASSOC)){
                                        ?>
                                            <tr onclick="javascript: OnItemClickTrArticle(this);">
                                                <td><?php echo $RArticle['id_art']; ?></td>
                                                <td><?php echo $RArticle['title']; ?></td>
                                                <td><?php echo number_format($RArticle['price'], 2, '.', ','); ?></td>
                                                <td><?php echo $RArticle['city']; ?></td>
                                                <?php
                                                    $RArt = $Conexion->query("SELECT names FROM agents WHERE id_agent='".$RArticle['id_agent']."';")->fetch_array(MYSQLI_ASSOC);
                                                ?>
                                                <td><?php echo $RArt['names']; ?></td>
                                                <td><?php echo $RArticle['bed_room']." - ".$RArticle['living_room']." - ".$RArticle['parking']." - ".$RArticle['kitchen']; ?></td>
                                            </tr>
                                        <?php
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