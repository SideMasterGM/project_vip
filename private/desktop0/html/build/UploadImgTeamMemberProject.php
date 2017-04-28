<?php
  include ("../../../connect_server/connect_server.php");
  $CN = CDB("vip");

  if ($_FILES["ChgImgTPMemberUpdate"]["error"] > 0){
    echo "Ha ocurrido un error";
  } else {
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    $limite_kb = 10000;

    if (in_array($_FILES['ChgImgTPMemberUpdate']['type'], $permitidos) && $_FILES['ChgImgTPMemberUpdate']['size'] <= $limite_kb * 1024){
      
      @session_start();
      $ruta = "../../users/".$_SESSION['usr']."/img_team_member/" . $_FILES['ChgImgTPMemberUpdate']['name'];

      if (!file_exists($ruta)){
        
        $resultado = @move_uploaded_file($_FILES["ChgImgTPMemberUpdate"]["tmp_name"], $ruta);
        if ($resultado){

          @chmod($ruta, 0777);
          rename($ruta, $CN->CleanString($ruta));

          $path = "users/".$_SESSION['usr']."/img_team_member/";

          if ($CN->addTeamMemberImgPerfil(@$_SESSION['id_team'], $path, $_FILES['ChgImgTPMemberUpdate']['name'])){
            ?>
              <style>
                .PhotoTeamMemberProject {
                  position: relative;
                  background: url('<?php echo "private/desktop0/".$path.$_FILES['ChgImgTPMemberUpdate']['name']; ?>'); 
                  width: 100%; 
                  height:230px; 
                  background-size: cover; 
                  border: 3px solid lightgrey; 
                  float: left;
                }

                .PhotoTeamMemberProject .camNewPhoto {
                  color: #fff;
                  font-size: 14px;
                  padding: 20px 20px 20px 20px;
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
            <?php
          }
        } else {
          echo "Ocurrió un error al mover el archivo.";
        }
      } else {
        echo "El fichero <b>".$_FILES['ChgImgTPMemberUpdate']['name']."</b> ya existe, cambie el nombre y vuelva a intentarlo.";
      }
    } else {
      echo "Archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
    }
  }
?>