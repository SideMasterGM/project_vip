<?php
	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

    @session_start();
	$QImg = $CN->getTeamImgPerfil($_SESSION['id_team'], "DESC", 1);

	if (is_array($QImg)){
        foreach ($QImg as $value) {
            ?>
                <style>
                    .PhotoTeamProject {
                      position: relative;
                      background: url('private/desktop0/<?php echo $value['folder'].$value['src']; ?>');
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
            <?php
        }
    } else if (is_bool($QImg)) {
        ?>
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
        <?php
    }
?>