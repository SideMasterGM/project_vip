<?php
  include ("../../connect_server/connect_server.php");
  include ("CalcDate.php");
?>

<div class="ContainerReturnTeamProject">
  <style>
    .PhotoTeamProject {
      position: relative;
      background: url('private/desktop0/img/img-default/team.jpg'); 
      width: 100%; 
      height:230px; 
      background-size: cover; 
      border: 3px solid lightgrey; 
      float: left;
    }

    .PhotoTeamProject .camNewPhoto {
      color: #fff;
      font-size: 14px;
      padding: 20px 20px 20px 20px;
      visibility: hidden;
    }

    .PhotoTeamProject .camNewPhoto {
      transition-duration: .1s;
      transform: linear;
      margin-top: -10px;
    }

    .PhotoTeamProject:hover > .camNewPhoto {
      visibility: visible;
      display: inline-block;

      transition-duration: .1s;
      transform: linear;
      margin: 0px;
      width: 100%;
      background-color: rgba(0,0,0,0.5);
    }

    #FormImgTeamProjectUpdate #ChgImgTPUpdate {
      visibility: hidden;
    }
  </style>

   <div class="PhotoTeamProject">
      <i class="fa fa-camera fa-2x icon-camera-change ChgAnimationPTP" onclick="javascript: ChgImgTeamProjectClick();" aria-hidden="true" title="Cambiar imagen del equipo"></i>
      <div class="camNewPhoto"><p>Actualizar imagen</p>
      </div>
  </div>
</div>

<form id="FormImgTeamProjectUpdate" enctype="multipart/form-data">
    <input type="file" id="ChgImgTPUpdate" name="ChgImgTPUpdate" onchange="javascript: UploadImgTeamProject();" />
</form>

<form id="AssignSessionIDTeam">
    <input type="hidden" id="IDInputIDTeam" name="IDInputIDTeam" />
</form>

<?php
    $CN_VIP = CDB("vip");
    @session_start();
    
    foreach ($CN_VIP->getTeamProjectById($_SESSION['id_team']) as $value) {
        $TeamID = $value['id_team'];
        $TeamName = $value['nombre'];
        $TeamDateLog = $value['date_log'];
        $TeamDateLogUNIX = $value['date_log_unix'];
        $TeamIDProject = $value['id_project'];
    }
?>

<div class="panel">
    <div class="panel-heading" role="tab" id="headingOne">
        <span class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           Fecha
          </a>
        </span>
     </div>
  
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
          <?php echo $TeamDateLog; ?>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title showTitleTeamProject">Nombres y apellidos</h3>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title showTitleTeamProject">Nombres y apellidos</h3>
    </div>
</div>