<?php
    
   include ("../../../connect_server/connect_server.php");

    include ("../../connect_server/connect_server.php");
    $id = $_POST['ValueArticleByID'];

    $AllData = $Conexion->query("SELECT * FROM article WHERE id_art='".$id."';")->fetch_array(MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-xs-4">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Facultad | CUR | Escuela
                <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: AddNewFacCurEsc();" aria-hidden="true" title="Agregar Facultad | CUR | Escuela" ></i></h3>
            </div>
            <div class="panel-body">
                <div>
                    <?php
                        $CNEx = CDB("all");

                        ?>
                            <select id="select_fac_cur_esc" style="width: 100%;">
                                <optgroup label="Lista de centros">
                        <?php

                            foreach ($CNEx->getProjectFacCurEsc() as $value) {
                                ?>
                                    <option value="<?php echo $value['codigo_facultad']; ?>"><?php echo $value['nombrefac']; ?></option>
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
                <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: AddNewInstanciaAprobacion();" aria-hidden="true" title="Agregar Instancia de Aprobación" ></i>
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
                <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: AddNewComunidadPoblacion();" aria-hidden="true" title="Agregar Comunidad | Población" ></i></h3>
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






 <div class="row">
          <div class="col-xs-4">

              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Precio</h3>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                      <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control" id="precio_dolar" name="precio_dolar" placeholder="Cantidad en dólares" onkeyup="javascript: ConvertToDolar(this);" value="<?php echo $AllData['price']; ?>">
                        <div class="input-group-addon"></div>
                      </div><br>

                      <div class="input-group">
                        <div class="input-group-addon">C$</div>
                        <input type="number" class="form-control" id="cantidad_dolar" placeholder="¿A cuánto?" onkeyup="javascript: ConvertToCD(this);" />
                        <div class="input-group-addon">$1</div>
                      </div><br>

                      <div class="input-group">
                        <div class="input-group-addon">C$</div>
                        <input type="number" class="form-control" id="cantidad_cordoba" placeholder="Cantidad en córdobas" onkeyup="javascript: ConvertToCordoba(this);">
                        <div class="input-group-addon"></div>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Localización</h3>
                  </div>
                  <div class="panel-body">
                       <input type="text" class="form-control" id="departamento_local" placeholder="* Ciudad departamental" value="<?php echo $AllData['department'] ?>" /><br/>
                       <input type="text" class="form-control" id="ciudad_local" value="<?php echo $AllData['city'] ?>" placeholder="* Ciudad o municipio" /><br/>
                       <input type="text" class="form-control" id="direccion_local" value="<?php echo $AllData['local_address'] ?>" placeholder="* Dirección del local" /><br/>
                  </div>
              </div>
           </div>

           <div class="col-xs-4">

              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Seleccionar Agente
                     <!--  <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: addAgentNow();" aria-hidden="true" title="Agregar agente" ></i> -->
                      </h3>
                  </div>
                  <div class="panel-body">
                      <div>

                      <?php
                          $ExAgentUser = $Conexion->query("SELECT DISTINCT username FROM agents;");

                          ?>
                              <select id="select_agent" style="width: 100%;">
                          <?php

                          while ($RExAgentUser = $ExAgentUser->fetch_array(MYSQLI_ASSOC)){
                              ?>
                                  <optgroup label="Registrado por <?php echo $RExAgentUser['username']; ?>">

                                  <?php
                                      $NewQAgents = $Conexion->query("SELECT * FROM agents WHERE username='".$RExAgentUser['username']."';");

                                      while ($RNewQAgents = $NewQAgents->fetch_array(MYSQLI_ASSOC)){

                                        if ($RNewQAgents['id_agent'] == $AllData['id_agent']){
                                          ?>
                                            <option selected="selected" value="<?php echo $RNewQAgents['id_agent']; ?>"><?php echo $RNewQAgents['names']; ?></option>
                                          <?php
                                        } else {
                                          ?>
                                              <option value="<?php echo $RNewQAgents['id_agent']; ?>"><?php echo $RNewQAgents['names']; ?></option>
                                          <?php
                                        }
                                      }
                                  ?>
                                  </optgroup>
                              <?php
                          }

                          ?>
                              </select>
                          <?php
                      ?>
                      </div>
                  </div>
              </div>

              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Tipo de negocio</h3>
                  </div>
                  <div class="panel-body">
                      <div>
                          <select id="select_business_type" style="width: 100%;">
                              <optgroup label="Tipo de negocio">

                              <?php
                                if ($AllData['business_type'] == "Venta"){
                                    ?>
                                    <option selected="selected" value="Venta">Venta</option>
                                    <option value="Alquiler">Alquiler</option>
                                    <?php
                                  } else {
                                     ?>
                                      <option value="Venta">Venta</option>
                                      <option selected="selected" value="Alquiler">Alquiler</option>
                                    <?php
                                  }
                              ?>
                              </optgroup>
                          </select>
                      </div>
                  </div>
              </div>

              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Tipo de propiedad 
                      <!-- <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: AddNewPropertyType();" aria-hidden="true" title="Agregar nuevo tipo de propiedad" ></i> -->
                      </h3>
                  </div>
                  <div class="panel-body">
                      <div>
                          <select id="select_property_type" style="width: 100%;">
                              
                              <?php
                                  $getObjTypeProperty = $Conexion->query("SELECT * FROM property_type;");

                                  if ($getObjTypeProperty->num_rows > 0){
                                      ?>
                                          <optgroup label="Tipo de propiedad">
                                      <?php
                                        while ($getDataPT = $getObjTypeProperty->fetch_array(MYSQLI_ASSOC)){
                                            if ($getDataPT['name_type'] == $AllData['property_type']){
                                              ?>
                                                <option selected="selected" value="<?php echo $getDataPT['name_type']; ?>"><?php echo $getDataPT['name_type']; ?></option>
                                              <?php
                                            } else {
                                              ?>
                                                  <option value="<?php echo $getDataPT['name_type']; ?>"><?php echo $getDataPT['name_type']; ?></option>
                                              <?php
                                            }
                                        }
                                      ?>
                                           </optgroup>
                                      <?php
                                  }
                              ?>
                          </select>
                      </div>
                  </div>
              </div>

              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Estado de la propiedad</h3>
                  </div>
                  <div class="panel-body">
                      <div>
                          <select id="select_property_state" style="width: 100%;">
                              <optgroup label="Tipo de propiedad">
                                  <?php
                                    if ($AllData['property_state'] == "En proceso"){
                                      ?>
                                        <option selected="selected" value="En proceso">En proceso</option>
                                      <?php
                                    } else {
                                       ?>
                                        <option value="En proceso">En proceso</option>
                                      <?php
                                    }

                                   if ($AllData['property_state'] == "Vendido"){
                                      ?>
                                        <option selected="selected" value="Vendido">Vendido</option>
                                      <?php
                                    } else {
                                       ?>
                                        <option value="Vendido">Vendido</option>
                                      <?php
                                    }

                                    if ($AllData['property_state'] == "Alquilado"){
                                      ?>
                                        <option selected="selected" value="Alquilado">Alquilado</option>
                                      <?php
                                    } else {
                                       ?>
                                        <option value="Alquilado">Alquilado</option>
                                      <?php
                                    }
                                  ?>
                              </optgroup>
                          </select>
                      </div>
                  </div>
              </div>
           </div>

           <div class="col-xs-4">

              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Recamaras</h3>
                  </div>
                  <div class="panel-body">
                      <div>
                          <select id="select_bed_room" style="width: 100%;">
                              <optgroup label="Recamaras">

                                <?php
                                  for ($i = 0; $i < 11; $i++){
                                    if ($i == ((int)$AllData['bed_room'])){
                                      ?>
                                        <option selected="selected" value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                      <?php
                                    } else {
                                      ?>
                                        <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                      <?php
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
                      <h3 class="panel-title">Salas</h3>
                  </div>
                  <div class="panel-body">
                      <div>
                          <select id="select_living_room" style="width: 100%;">
                              <optgroup label="Salas">
                                 <?php
                                  for ($i = 0; $i < 11; $i++){
                                    if ($i == ((int)$AllData['living_room'])){
                                      ?>
                                        <option selected="selected" value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                      <?php
                                    } else {
                                      ?>
                                        <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                      <?php
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
                      <h3 class="panel-title">Estacionamientos</h3>
                  </div>
                  <div class="panel-body">
                      <div>
                          <select id="select_parking" style="width: 100%;">
                              <optgroup label="Estacionamientos">
                                 <?php
                                  for ($i = 0; $i < 11; $i++){
                                    if ($i == ((int)$AllData['parking'])){
                                      ?>
                                        <option selected="selected" value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                      <?php
                                    } else {
                                      ?>
                                        <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                      <?php
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
                      <h3 class="panel-title">Cocinas</h3>
                  </div>
                  <div class="panel-body">
                      <div>
                          <select id="select_kitchen_now" style="width: 100%;">
                              <optgroup label="Cocinas">
                                 <?php
                                  for ($i = 0; $i < 11; $i++){
                                    if ($i == ((int)$AllData['kitchen'])){
                                      ?>
                                        <option selected="selected" value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                      <?php
                                    } else {
                                      ?>
                                        <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                      <?php
                                    }
                                  }
                                 ?>
                              </optgroup>
                          </select>
                      </div>
                  </div>
              </div>

           </div>

           <div class="row">
                <div class="col-xs-12">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                            <h3 class="panel-title">Posicione el local en el mapa</h3>
                      </div>
                      <div class="panel-body">
                          <?php 
                            $coords_long = $AllData['longitude'];
                            $coords_lat = $AllData['latitude'];

                            include ("../../../test/map_finder.php");
                          ?>
                      </div>
                  </div>
              </div>
          </div>
      </div>