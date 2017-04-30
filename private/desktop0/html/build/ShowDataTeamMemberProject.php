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
  
  <div class="panel">
    <div class="panel-heading" role="tab" id="headingVisibleOne">
        <span class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseVisibleOne" aria-expanded="false" aria-controls="collapseVisibleOne">
              Vínculo de proyecto
          </a>
        </span>
    </div>

    <div id="collapseVisibleOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingVisibleOne">
      <div class="panel-body">
          Algun valor que se guarda                          
        </div>
    </div>                
  </div>

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

</div>