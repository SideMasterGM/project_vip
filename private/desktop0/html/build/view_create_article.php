<div class="container-fluid">
    <div class="side-body padding-top">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-xs-10">
                            <div class="card-title" style="width: 105%;">
                                <input type="text" class="form-control" style="width: 100%;" placeholder="Escriba el nombre del proyecto" id="title_publish" name="title_publish" autofocus />
                            </div>
                            </div>
                            <div class="col-xs-2">
                                <div class="card-title" style="width: 100%;">
                                    <button type="button" style="margin-bottom: -10px; margin-top: 0; float: right;" class="btn btn-primary" onclick="javascript: PreviewArticle();">Agregar proyecto</button>
                                </div>
                            </div>
                    </div>
                    <div class="card-body">
                        <div class="step">
                            <ul class="nav nav-tabs nav-justified" role="tablist">
                                <li role="step" class="active">
                                    <a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                        <div class="icon fa fa-pencil"></div>
                                        <div class="step-title">
                                            <div class="title">Redactar</div>
                                            <div class="description">Escribe los objetivos del proyecto.</div>
                                        </div>
                                    </a>
                                </li>
                                <li role="step">
                                    <a href="#step2" role="tab" id="step2-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-picture-o"></div>
                                        <div class="step-title">
                                            <div class="title">Subir imágenes</div>
                                            <div class="description">Selecciona las imágenes del proyecto.</div>
                                        </div>
                                    </a>
                                </li>
                                <li role="step">
                                    <a href="#step3" role="tab" id="step3-tab" data-toggle="tab" aria-controls="profile">
                                        <div class="icon fa fa-tasks"></div>
                                        <div class="step-title">
                                            <div class="title">Información de formato</div>
                                            <div class="description">Facultad, CUR, Escuela, Código dictamen, etc.</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="step1" aria-labelledby="home-tab">
                                    <?php include ("private/desktop0/html/edit/index.html"); ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="step2" aria-labelledby="profile-tab">
                                    <div class="mensage"></div>      
                                    <table align="center">
                                        <tr>
                                             <td><input type="file" multiple="multiple" id="archivos" onchange="javascript: SubirFotos();"></td><!-- Este es nuestro campo input File -->
                                        </tr> 
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="step3" aria-labelledby="dropdown1-tab">
                                    
                                    <div class="row">
                                        <div class="col-xs-4">

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Facultad | CUR | Escuela
                                                    <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: addAgentNow();" aria-hidden="true" title="Agregar agente" ></i></h3>
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

                                                  <!-- <div class="form-group">
                                                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                                    <div class="input-group">
                                                      <div class="input-group-addon">$</div>
                                                      <input type="number" class="form-control" id="precio_dolar" name="precio_dolar" placeholder="Facultad / CUR / Escuela" onkeyup="javascript: ConvertToDolar(this);">
                                                      <div class="input-group-addon"></div>
                                                    </div><br>
                                                  </div> -->
                                                </div>
                                            </div>
                                            
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Fecha de aprobación</h3>
                                                </div>
                                                <div class="panel-body">
                                                     <input type="text" class="form-control" id="fecha_aprobacion" placeholder="* Fecha" onclick="javascript: Calldatepicker();"/><br/>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Dictamen económico</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="input-group">
                                                      <div class="input-group-addon">Código</div>
                                                      <input type="number" class="form-control" id="cod_dictamen" name="cod_dictamen" placeholder="####"/>
                                                      <div class="input-group-addon"></div>
                                                    </div>
                                                </div>
                                            </div>

                                         </div>

                                         <div class="col-xs-4">

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Instancia de aprobación
                                                    <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: addAgentNow();" aria-hidden="true" title="Agregar agente" ></i>
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
                                                                        ?>
                                                                            <option value="<?php echo $RNewQAgents['id_agent']; ?>"><?php echo $RNewQAgents['names']; ?></option>
                                                                        <?php

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
                                                    <h3 class="panel-title">Tipo de propiedad 
                                                    <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: AddNewPropertyType();" aria-hidden="true" title="Agregar nuevo tipo de propiedad" ></i>
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
                                                                        ?>
                                                                            <option value="<?php echo $getDataPT['name_type']; ?>"><?php echo $getDataPT['name_type']; ?></option>
                                                                            
                                                                        <?php
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
                                         </div>

                                         <div class="col-xs-4">
                                            
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Temporalidad</h3>
                                                </div>
                                                <div class="panel-body">
                                                     <div class="input-group">
                                                      <div class="input-group-addon">Duración</div>
                                                      <input type="number" class="form-control" id="duracion_meses" name="duracion_meses" placeholder="# Nº de meses" style="z-index: 1;" />
                                                      <div class="input-group-addon"></div>
                                                    </div><br/>
                                                    
                                                     <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="* Fecha inicial" onclick="javascript: CalldatepickerFechaInicio();"/><br/>
                                                     <input type="text" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" placeholder="* Fecha de finalización" onclick="javascript: CalldatepickerFechaFin();"/><br/>
                                                     <input type="text" class="form-control" id="fecha_monitoreo" name="fecha_monitoreo" placeholder="* Fecha de monitoreo" onclick="javascript: CalldatepickerFechaMonitoreo();"/><br/>
                                                     
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="ArtSendData">
                <input type="hidden" class="form-control" id="art_title" name="art_title" /><br/>
                <textarea id="art_content" style="display: none;" name="art_content"></textarea><br/>
                <input type="hidden" class="form-control" id="art_price" name="art_price" /><br/>
                <input type="hidden" class="form-control" id="art_department" name="art_department" /><br/>
                <input type="hidden" class="form-control" id="art_city" name="art_city" /><br/>
                <input type="hidden" class="form-control" id="art_local_address" name="art_local_address" /><br/>
                <input type="hidden" class="form-control" id="art_agent" name="art_agent" /><br/>
                <input type="hidden" class="form-control" id="art_business_type" name="art_business_type" /><br/>
                <input type="hidden" class="form-control" id="art_property_type" name="art_property_type" /><br/>
                <input type="hidden" class="form-control" id="art_property_state" name="art_property_state" /><br/>
                <input type="hidden" class="form-control" id="art_bed_room" name="art_bed_room" /><br/>
                <input type="hidden" class="form-control" id="art_living_room" name="art_living_room" /><br/>
                <input type="hidden" class="form-control" id="art_parking" name="art_parking" /><br/>
                <input type="hidden" class="form-control" id="art_kitchen_now" name="art_kitchen_now" /><br/>
                <input type="hidden" id="coord_latitude" name="coord_latitude" />
                <input type="hidden" id="coord_longitude" name="coord_longitude" />
            </form>

            <a href="articles" style="display: none;" id="ClickArticlesList"></a>

            <?php include ("private/desktop0/html/build/modals.php"); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("document").ready(function(){
        show_img_tmp();
    });
</script>