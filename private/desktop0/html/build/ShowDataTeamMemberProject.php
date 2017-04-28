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
      $QImg = $CN_VIP->getTeamMemberImgPerfilById(@$_SESSION['id_img_member'], "DESC", 1);

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
    <div class="panel-heading" role="tab" id="headingOne">
        <span class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Vínculo de proyecto
          </a>
        </span>
    </div>

    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
          <?php 
            foreach ($CN_VIP->getProjectsOnlyById($_SESSION['id_project']) as $value) {
              $ProjectName = $value['nombre'];
            }
            echo $ProjectName;
          ?>                          
        </div>
    </div>                
  </div>

  <div class="panel">
     <div class="panel-heading" role="tab" id="headingTwo">
        <span class="panel-title">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Fecha de creación
          </a>
        </span>
    </div>

    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
         <?php echo $TeamDateLog." - ".nicetime(date("Y-m-d H:i", $TeamDateLogUNIX));; ?>
      </div>
    </div>                
  </div>

</div>