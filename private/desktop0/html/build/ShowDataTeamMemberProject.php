<?php
  include ("../../../connect_server/connect_server.php");
  include ("CalcDate.php");

  $CN_VIP = CDB("vip");
  @session_start();
?>

<!-- Acá existe un problema, la imagen de perfil no se muestra -->

<div class="ContainerReturnTeamMemberProject">
  <style>

    <?php
        $id_team = @$_SESSION['id_team'];

        if (is_array($CN_VIP->getTeamMembers($id_team))){
            
            foreach ($CN_VIP->getTeamMembers($id_team) as $ValueTeamMembers) {
                if ($ValueTeamMembers['firts_name'] == ""){
                    $id_member  = $ValueTeamMembers['id_member'];
                    $id_img     = $ValueTeamMembers['id_img'];

                    $QImg = $CN_VIP->getTeamMemberImgPerfilById($id_team, $id_img, "DESC", 1);
                    
                    if (is_array($QImg)){
                        foreach ($QImg as $value) {
                            $TeamDateLog        = $value['date_log'];
                            $TeamDateLogUNIX    = $value['date_log_unix'];
                          ?>
                            .PhotoTeamMemberProject {
                              position: relative;
                              background: url('private/desktop0/<?php echo $value['folder'].$value['src']; ?>');
                              width: 100%; 
                              height:130px; 
                              background-size: cover; 
                              border: 3px solid lightgrey; 
                              float: left;
                            }
                          <?php
                        }
                      } else if (is_bool($QImg)){
                        ?>
                            .PhotoTeamMemberProject {
                              position: relative;
                              background: url('private/desktop0/img/img-default/team.jpg'); 
                              width: 100%; 
                              height:130px; 
                              background-size: cover; 
                              border: 3px solid lightgrey; 
                              float: left;
                            }
                        <?php
                      }
                }
            }

        } else if (is_bool($CN_VIP->getTeamMembers($id_team))){
            ?>
                .PhotoTeamMemberProject {
                  position: relative;
                  background: url('private/desktop0/img/img-default/team.jpg'); 
                  width: 100%; 
                  height:130px; 
                  background-size: cover; 
                  border: 3px solid lightgrey; 
                  float: left;
                }
            <?php
        }
    ?>
  
    .PhotoTeamMemberProject .camNewPhoto {
      color: #fff;
      font-size: 14px;
      padding: 8px 20px 20px 20px;
      visibility: hidden;
    }

    .PhotoTeamMemberProject .camNewPhoto {
      transition-duration: .1s;
      transform: linear;
      margin-top: -10px;
    }

    .PhotoTeamMemberProject:hover > .camNewPhoto {
      visibility: visible;
      display: inline-block;
      transition-duration: .1s;
      transform: linear;
      margin: 0px;
      width: 100%;
      background-color: rgba(0,0,0,0.5);
    }

    #FormImgTeamMemberProjectUpdate #ChgImgTPMemberUpdate {
      visibility: hidden;
    }
  </style>

   <div class="PhotoTeamMemberProject">
      <i class="fa fa-camera fa-2x icon-camera-change ChgAnimationPTP" onclick="javascript: ChgImgTeamMemberProjectClick();" aria-hidden="true" title="Cambiar imagen del integrante"></i>
      <div class="camNewPhoto"><p>Actualizar imagen</p>
      </div>
  </div>
</div>

<form id="FormImgTeamMemberProjectUpdate" enctype="multipart/form-data">
    <input type="file" id="ChgImgTPMemberUpdate" name="ChgImgTPMemberUpdate" onchange="javascript: UploadImgTeamMemberProject();" />
</form>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  
    <?php
        if ((isset($TeamDateLog) && $TeamDateLog != "") && (isset($TeamDateLogUNIX) && $TeamDateLogUNIX != "")){
            ?>
                <div class="panel">
                    <div class="panel-heading" role="tab" id="headingMemberInfo">
                        <span class="panel-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseMemberInfo" aria-expanded="false" aria-controls="collapseMemberInfo">
                              Fecha de creación
                          </a>
                        </span>
                    </div>

                    <div id="collapseMemberInfo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingMemberInfo">
                        <div class="panel-body">
                            <?php echo $TeamDateLog." - ".nicetime(date("Y-m-d H:i", $TeamDateLogUNIX));; ?>
                        </div>
                    </div>                
                </div>
            <?php
        }
    ?>

    <div class="panel">
        <div class="panel-heading" role="tab" id="headingDesgracia">
            <span class="panel-title">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseDesgracia" aria-expanded="false" aria-controls="collapseDesgracia">
                    Grado Académico
                </a>
            </span>
        </div>

        <form id="dataSendIDs">
            <input type="hidden" id="dataSendIDs_id_team" name="dataSendIDs_id_team" value="<?php echo $id_team; ?>" />
            <input type="hidden" id="dataSendIDs_id_member" name="dataSendIDs_id_member" value="<?php echo @$id_member; ?>" />
            
            <input type="hidden" id="dataSendIDs_firstname" name="dataSendIDs_firstname" value="" />
            <input type="hidden" id="dataSendIDs_lastname" name="dataSendIDs_lastname" value="" />
            
            <input type="hidden" id="dataSendIDs_grado_academico" name="dataSendIDs_grado_academico" value="" />
            <input type="hidden" id="dataSendIDs_dependencia_academica" name="dataSendIDs_dependencia_academica" value="" />
            
            <input type="hidden" id="dataSendIDs_tipo_contratacion" name="dataSendIDs_tipo_contratacion" value="" />
            <input type="hidden" id="dataSendIDs_hrs_semanales_dedicacion" name="dataSendIDs_hrs_semanales_dedicacion" value="" />
        </form>

        <div id="collapseDesgracia" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingDesgracia">
            <div class="panel-body">
                <input type="button" id="grado_academico_one" value="Licenciado" onclick="javascript: OpenMenuGradoAcademicoButtonVal(this);" />
                <input type="button" id="grado_academico_two" value="Ingeniero" onclick="javascript: OpenMenuGradoAcademicoButtonVal(this);"/>
                <input type="button" id="grado_academico_three" value="Master" onclick="javascript: OpenMenuGradoAcademicoButtonVal(this);"/>
                <input type="button" id="grado_academico_four" value="Especialista" onclick="javascript: OpenMenuGradoAcademicoButtonVal(this);"/>
                <input type="button" id="grado_academico_five" value="Doctor" onclick="javascript: OpenMenuGradoAcademicoButtonVal(this);"/>                    
            </div>
        </div> 


      <style>
          div#collapseDesgracia input[type="button"] {
            width: 100%;
            padding: 4px;
            border: none;
            background-color: steelblue;
            color: #fff;
            margin-bottom: 2px;
          }

          div#collapseDesgracia input[type="button"]:hover {
            background-color: teal;
          }

          div#collapseDesgracia input[type="button"]:focus {
            background-color: rgba(0,0,0,0.4);
          }
      </style>               
  </div>

</div>