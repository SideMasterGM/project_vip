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
                        <div class="col-xs-10">
                            <div class="card-title" style="width: 105%;">
                                <input type="text" class="form-control" style="width: 100%;" placeholder="* Escriba el nombre del proyecto" id="title_publish" name="title_publish" autofocus />
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
                                                    <i class="fa fa-plus-circle buttons_addPanel" onclick="javascript: AddNewFacCurEsc();" aria-hidden="true" title="Agregar Facultad | CUR | Escuela" ></i></h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div>
                                                        <?php
                                                            $CNEx = CDB("vip");

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

                                                      <input type="text" class="form-control" id="fecha_aprobacion" placeholder="* Fecha de aprobación" onfocus="javascript: Calldatepicker();" onmouseover="javascript: Calldatepicker();" /><br/>  
                                                     <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="* Fecha inicial" onfocus="javascript: CalldatepickerFechaInicio();" onmouseover="javascript: CalldatepickerFechaInicio();"/><br/>
                                                     <input type="text" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" placeholder="* Fecha de finalización" onfocus="javascript: CalldatepickerFechaFin();" onmouseover="javascript: CalldatepickerFechaFin();"/><br/>
                                                     <input type="text" class="form-control" id="fecha_monitoreo" name="fecha_monitoreo" placeholder="* Fecha de monitoreo" onfocus="javascript: CalldatepickerFechaMonitoreo();" onmouseover="javascript: CalldatepickerFechaMonitoreo();"/><br/>
                                                     
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
                                                      <div class="input-group-addon ContainerMoneda" title="Cambiar tipo de moneda" style="cursor: cell;" onclick="javascript: ChangeTagMoney()">C$</div>
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
                                                        $CNEx = CDB("vip");
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form id="ArtSendData">
                <input type="hidden" class="form-control" id="pro_title" name="pro_title" /><br/>
                <textarea id="pro_content" style="display: none;" name="pro_content"></textarea><br/>
                
                <input type="hidden" class="form-control" id="pro_fac_cur_esc" name="pro_fac_cur_esc" /><br/>
                <input type="hidden" class="form-control" id="pro_instancia_aprobacion" name="pro_instancia_aprobacion" /><br/>
                <input type="hidden" class="form-control" id="pro_comunidad_poblacion" name="pro_comunidad_poblacion" /><br/>
                
                <input type="hidden" class="form-control" id="pro_duracion_meses" name="pro_duracion_meses" /><br/>
                <input type="hidden" class="form-control" id="pro_fecha_aprobacion" name="pro_fecha_aprobacion" /><br/>
                <input type="hidden" class="form-control" id="pro_fecha_inicio" name="pro_fecha_inicio" /><br/>
                <input type="hidden" class="form-control" id="pro_fecha_finalizacion" name="pro_fecha_finalizacion" /><br/>
                <input type="hidden" class="form-control" id="pro_fecha_monitoreo" name="pro_fecha_monitoreo" /><br/>
                
                <input type="hidden" class="form-control" id="pro_nombre_organismo" name="pro_nombre_organismo" /><br/>
                <input type="hidden" class="form-control" id="pro_monto_financiado" name="pro_monto_financiado" /><br/>
                <input type="hidden" class="form-control" id="pro_aporte_unan" name="pro_aporte_unan" /><br/>
                <input type="hidden" class="form-control" id="pro_moneda" name="pro_moneda" /><br/>
                
                <input type="hidden" class="form-control" id="pro_zona_geografica" name="pro_zona_geografica" /><br/>
                
                <input type="hidden" class="form-control" id="pro_cod_dictamen" name="pro_cod_dictamen" /><br/>
                
                <input type="hidden" class="form-control" id="pro_tipo_publicacion" name="pro_tipo_publicacion" /><br/>
                <input type="hidden" class="form-control" id="pro_datos_publicacion" name="pro_datos_publicacion" /><br/>
                <input type="hidden" class="form-control" id="pro_otros_datos" name="pro_otros_datos" /><br/>
                
                <input type="hidden" class="form-control" id="pro_personas_atendidas" name="pro_personas_atendidas" /><br/>
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