<?php
  include ("../../../connect_server/connect_server.php");

  $id_project = $_POST['ValueArticleByID'];
?>

<div class="row">
    <div class="col-xs-4">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Facultad | CUR | Escuela
                <!-- <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: AddNewFacCurEsc();" aria-hidden="true" title="Agregar Facultad | CUR | Escuela" ></i></h3> -->
            </div>
            <div class="panel-body">
                <div>
                    <?php
                        $CN_VIP = CDB("vip");
                        $CN_ALL = CDB("all");

                        ?>
                            <select id="select_fac_cur_esc" style="width: 100%;">
                                <optgroup label="Lista de centros">
                        <?php

                            if (is_array($CN_VIP->getProjectsOnlyById($id_project))){
                              foreach ($CN_VIP->getProjectsOnlyById($id_project) as $ProjectValue) {
                                
                                if (is_array($CN_ALL->getProjectFacCurEsc())){
                                  foreach ($CN_ALL->getProjectFacCurEsc() as $ProjectFacCurEsc) {
                                    
                                    if ($ProjectValue['id_facultad_cur_escuela'] == $ProjectFacCurEsc['codigo_facultad']){
                                      ?>
                                        <option selected="selected" value="<?php echo $ProjectFacCurEsc['codigo_facultad']; ?>"><?php echo $ProjectFacCurEsc['nombrefac']; ?></option>
                                      <?php 
                                    } else {
                                      ?>
                                        <option value="<?php echo $ProjectFacCurEsc['codigo_facultad']; ?>"><?php echo $ProjectFacCurEsc['nombrefac']; ?></option>
                                      <?php 
                                    }
                                  }
                                }
                              }
                            }
                        ?>
                                </optgroup>
                            </select>
                        
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Temporalidad</h3>
            </div>
            <div class="panel-body">
                 <div class="input-group">
                  <div class="input-group-addon">Duración</div>
                  <input type="number" class="form-control" id="duracion_meses" name="duracion_meses" placeholder="* Nº de meses" style="z-index: 1;" />
                  <div class="input-group-addon"></div>
                </div><br/>

                  <input type="text" class="form-control" id="fecha_aprobacion" placeholder="* Fecha de aprobación" onfocus="javascript: Calldatepicker();"/><br/>  
                 <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="* Fecha inicial" onfocus="javascript: CalldatepickerFechaInicio();"/><br/>
                 <input type="text" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" placeholder="* Fecha de finalización" onfocus="javascript: CalldatepickerFechaFin();"/><br/>
                 <input type="text" class="form-control" id="fecha_monitoreo" name="fecha_monitoreo" placeholder="* Fecha de monitoreo" onfocus="javascript: CalldatepickerFechaMonitoreo();"/><br/>
                 
            </div>
        </div>

     </div>

     <div class="col-xs-4">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Instancia de aprobación
                <!-- <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: AddNewInstanciaAprobacion();" aria-hidden="true" title="Agregar Instancia de Aprobación" ></i> -->
                </h3>
            </div>
            <div class="panel-body">
                
                <div>

                    <?php
                        $CNEx = CDB("vip");

                        ?>
                            <select id="select_instancia_aprobacion" style="width: 100%;">
                                <optgroup label="Instancias de aprobación">
                        <?php

                        foreach ($CNEx->getProjectInstanciaAprobacion() as $value) {
                            ?>
                                <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre_instancia_aprobacion']; ?></option>
                            <?php                                                              
                        }

                        ?>
                                </optgroup>
                            </select>
                        <?php
                    ?>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Información financiera</h3>
            </div>
            <div class="panel-body">
                
                 <input type="text" class="form-control" id="nombre_organismo" name="nombre_organismo" placeholder="* Nombre del organismo"/><br/>
                 <div class="input-group">
                  <div class="input-group-addon">C$</div>
                  <input type="number" class="form-control" id="monto_financiado" name="monto_financiado" placeholder="* C$"/>
                  <div class="input-group-addon">Monto</div>
                </div><br/>
                 <input type="text" class="form-control" id="aporte_unan" name="aporte_unan" placeholder="* Aporte de la UNAN" /><br/>
                 
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Comunidad | Población
                <!-- <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: AddNewComunidadPoblacion();" aria-hidden="true" title="Agregar Comunidad | Población" ></i></h3> -->
            </div>
            <div class="panel-body">
            
                <div>

                <?php
                    $CNEx = CDB("all");
                    ?>
                        <select id="select_comunidad_poblacion" style="width: 100%;">
                            <optgroup label="Lista de centros">
                    <?php

                        foreach ($CNEx->getProjectComunidadPoblacion() as $value) {
                            ?>
                                <option value="<?php echo $value['cod_muni']; ?>"><?php echo $value['nombre_muni']; ?></option>
                            <?php                                                              
                        }
                    ?>
                            </optgroup>
                        </select>
                    <?php
                ?>
                    <br/><br/>
                    <div class="input-group">
                      <div class="input-group-addon">Nombre</div>
                      <input type="text" class="form-control" id="zona_geografica" name="zona_geografica" placeholder="Zona geográfica"/>
                      <div class="input-group-addon"></div>
                    </div>
                </div>
            </div>
        </div>
        
     </div>

     <div class="col-xs-4">
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dictamen económico</h3>
            </div>
            <div class="panel-body">
                <div class="input-group">
                  <div class="input-group-addon">Código</div>
                  <input type="number" class="form-control" id="cod_dictamen" name="cod_dictamen" placeholder="* #"/>
                  <div class="input-group-addon"></div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Resultados</h3>
            </div>
            <div class="panel-body">
                
                 <input type="text" class="form-control" id="tipo_publicacion" name="tipo_publicacion" placeholder="* Tipo de publicación"/><br/>
                 <input type="text" class="form-control" id="datos_publicacion" name="datos_publicacion" placeholder="* Datos de publicación" /><br/>
                 <input type="text" class="form-control" id="otros_datos" name="otros_datos" placeholder=" Otros resultados" /><br/>
                 
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Personas atendidas</h3>
            </div>
            <div class="panel-body">
                <div class="input-group">
                  <div class="input-group-addon">Cantidad</div>
                  <input type="number" class="form-control" id="personas_atendidas" name="personas_atendidas" placeholder="* #"/>
                  <div class="input-group-addon"></div>
                </div>
            </div>
        </div>

    </div>
</div>