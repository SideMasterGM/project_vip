<?php
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */

    include ("private/desktop0/html/build/modals.php");

    if (!isset($_POST['GenerateReportArticleID'])){
        ?>
            <script>
                alert("No hay algo seleccionado");
            </script>
        <?php   
    }

?>

<div class="container-fluid">
    <div class="side-body padding-top">
    	<div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                        	<div class="title">
                        		<i class="fa fa-pencil"></i> <?php echo "Título del proyecto"; ?>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" style="float: right; margin: 12px;" onclick="javascript: GenerateReport();" title="Generar un reporte completo del proyecto">Descargar en PDF</button>
                    </div>
                    <div class="card-body">
                        
                    </div>
                    <form id="ShowImgPerfilUser">
                    	<input type="hidden" name="nombre_de_usuario" id="nombre_de_usuario" />
                    </form>
                </div>
            </div>
			
        </div>
    </div>
</div>