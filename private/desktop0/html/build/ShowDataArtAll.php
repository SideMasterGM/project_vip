<?php
  /**
    * --------------------------------------------- *
    * @author: Jerson A. Martínez M. (Side Master)  *
    * --------------------------------------------- *
  */

  include ("../../../connect_server/connect_server.php");
  
  $CN_VIP = CDB("vip");
  $CN_ALL = CDB("all");
  
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
                            <select id="select_fac_cur_esc" style="width: 100%;">
                                <optgroup label="Lista de centros">
                        <?php

                            if (is_array($CN_VIP->getProjectsOnlyById($id_project))){
                              foreach ($CN_VIP->getProjectsOnlyById($id_project) as $ProjectValue) {
                                
                                $fecha_aprobacion       = $ProjectValue['fecha_aprobacion'];
                                $cod_dictamen_economico = $ProjectValue['cod_dictamen_economico'];

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
                
                <?php
                  if (is_array($CN_VIP->getProyectoTemporalidadOnlyById($id_project))){
                    foreach ($CN_VIP->getProyectoTemporalidadOnlyById($id_project) as $ValueTemp) {
                      $duracion_meses     = $ValueTemp['duracion_meses'];
                      $fecha_inicio       = $ValueTemp['fecha_inicio'];
                      $fecha_finalizacion = $ValueTemp['fecha_finalizacion'];
                      $fecha_monitoreo    = $ValueTemp['fecha_monitoreo'];
                    }
                  }
                ?>

                 <div class="input-group">
                  <div class="input-group-addon">Duración</div>
                  <input type="number" class="form-control" id="duracion_meses" name="duracion_meses" value="<?php echo $duracion_meses; ?>" placeholder="* Nº de meses" style="z-index: 1;" />
                  <div class="input-group-addon"></div>
                </div><br/>

                  <input type="text" class="form-control" id="fecha_aprobacion" value="<?php echo $fecha_aprobacion; ?>" placeholder="* Fecha de aprobación" onfocus="javascript: Calldatepicker();"/><br/>  
                 <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>"  placeholder="* Fecha inicial" onfocus="javascript: CalldatepickerFechaInicio();"/><br/>
                 <input type="text" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" value="<?php echo $fecha_finalizacion; ?>" placeholder="* Fecha de finalización" onfocus="javascript: CalldatepickerFechaFin();"/><br/>
                 <input type="text" class="form-control" id="fecha_monitoreo" name="fecha_monitoreo" value="<?php echo $fecha_monitoreo; ?>" placeholder="* Fecha de monitoreo" onfocus="javascript: CalldatepickerFechaMonitoreo();"/><br/>
                 
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
                    <select id="select_instancia_aprobacion" style="width: 100%;">
                      <optgroup label="Instancias de aprobación">

                    <?php
                      if (is_array($CN_VIP->getProjectsOnlyById($id_project))){
                        foreach ($CN_VIP->getProjectsOnlyById($id_project) as $InstanciaID) {
                          
                          if (is_array($CN_VIP->getProjectInstanciaAprobacion())){
                            foreach ($CN_VIP->getProjectInstanciaAprobacion() as $ProjectInstanciaAprobacion) {
                              
                              if ($InstanciaID['id_instancia_aprobacion'] == $ProjectInstanciaAprobacion['id']){
                                ?>
                                  <option selected="selected" value="<?php echo $ProjectInstanciaAprobacion['id']; ?>"><?php echo $ProjectInstanciaAprobacion['nombre_instancia_aprobacion']; ?></option>
                                <?php 
                              } else {
                                ?>
                                  <option value="<?php echo $ProjectInstanciaAprobacion['id']; ?>"><?php echo $ProjectInstanciaAprobacion['nombre_instancia_aprobacion']; ?></option>
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
                <h3 class="panel-title">Información financiera</h3>
            </div>
            <div class="panel-body">
                
                  <?php
                    if (is_array($CN_VIP->getProyectoFinancieraOnlyById($id_project))){
                      foreach ($CN_VIP->getProyectoFinancieraOnlyById($id_project) as $InfoFinanciera) {
                        $nombre_organismo = $InfoFinanciera['nombre_organismo'];
                        $monto_financiado = $InfoFinanciera['monto_financiado'];
                        $aporte_unan      = $InfoFinanciera['aporte_unan'];
                      }
                    }
                  ?>

                 <input type="text" class="form-control" id="nombre_organismo" name="nombre_organismo" value="<?php echo $nombre_organismo; ?>" placeholder="* Nombre del organismo"/><br/>
                 <div class="input-group">
                  <div class="input-group-addon">C$</div>
                  <input type="number" class="form-control" id="monto_financiado" name="monto_financiado" value="<?php echo $monto_financiado; ?>" placeholder="* C$"/>
                  <div class="input-group-addon">Monto</div>
                </div><br/>
                 <input type="text" class="form-control" id="aporte_unan" name="aporte_unan" value="<?php echo $aporte_unan; ?>" placeholder="* Aporte de la UNAN" /><br/>
                 
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Comunidad | Población
                <!-- <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: AddNewComunidadPoblacion();" aria-hidden="true" title="Agregar Comunidad | Población" ></i></h3> -->
            </div>
            <div class="panel-body">
            
                <div>

                  <select id="select_comunidad_poblacion" style="width: 100%;">
                      <optgroup label="Lista de centros">
                        <?php

                            if (is_array($CN_VIP->getProyectoZonaGeoBeneficiariosOnlyById($id_project))){
                              foreach ($CN_VIP->getProyectoZonaGeoBeneficiariosOnlyById($id_project) as $ProjectZonaGeoBeneficiario) {
                                
                                $ZonaGeografica     = $ProjectZonaGeoBeneficiario['nombre_zona_geografica'];
                                $PersonasAtendidas  = $ProjectZonaGeoBeneficiario['cantidad_personas_atendidas'];

                                if (is_array($CN_ALL->getProjectComunidadPoblacion())){
                                  foreach ($CN_ALL->getProjectComunidadPoblacion() as $ProjectComunidadPoblacion) {
                                    
                                    if ($ProjectZonaGeoBeneficiario['id_comunidad_poblacion'] == $ProjectComunidadPoblacion['cod_muni']){
                                      ?>
                                        <option selected="selected" value="<?php echo $ProjectComunidadPoblacion['cod_muni']; ?>"><?php echo $ProjectComunidadPoblacion['nombre_muni']; ?></option>
                                      <?php 
                                    } else {
                                      ?>
                                        <option value="<?php echo $ProjectComunidadPoblacion['cod_muni']; ?>"><?php echo $ProjectComunidadPoblacion['nombre_muni']; ?></option>
                                      <?php 
                                    }
                                  }
                                }
                              }
                            }
                        ?>
                      </optgroup>
                    </select>

                    <br/><br/>
                    <div class="input-group">
                      <div class="input-group-addon">Nombre</div>
                      <input type="text" class="form-control" id="zona_geografica" name="zona_geografica" value="<?php echo $ZonaGeografica; ?>" placeholder="Zona geográfica"/>
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
                  <input type="number" class="form-control" id="cod_dictamen" name="cod_dictamen" value="<?php echo $cod_dictamen_economico; ?>" placeholder="* #"/>
                  <div class="input-group-addon"></div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Resultados</h3>
            </div>
            <div class="panel-body">
                  
                  <?php
                    if (is_array($CN_VIP->getProyectoResultadosOnlyById($id_project))){
                      foreach ($CN_VIP->getProyectoResultadosOnlyById($id_project) as $Resultados) {
                        $tipo_publicacion   = $Resultados['tipo_publicacion'];
                        $datos_publicacion  = $Resultados['datos_publicacion'];
                        $otros_resultados   = $Resultados['otros_resultados'];
                      }
                    }
                  ?>

                 <input type="text" class="form-control" id="tipo_publicacion" name="tipo_publicacion" value="<?php echo $tipo_publicacion; ?>" placeholder="* Tipo de publicación"/><br/>
                 <input type="text" class="form-control" id="datos_publicacion" name="datos_publicacion" value="<?php echo $datos_publicacion; ?>" placeholder="* Datos de publicación" /><br/>
                 <input type="text" class="form-control" id="otros_datos" name="otros_datos" value="<?php echo $otros_resultados; ?>" placeholder=" Otros resultados" /><br/>
                 
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Personas atendidas</h3>
            </div>
            <div class="panel-body">
                <div class="input-group">
                  <div class="input-group-addon">Cantidad</div>
                  <input type="number" class="form-control" id="personas_atendidas" name="personas_atendidas" value="<?php echo $PersonasAtendidas; ?>" placeholder="* #"/>
                  <div class="input-group-addon"></div>
                </div>
            </div>
        </div>

    </div>
</div>