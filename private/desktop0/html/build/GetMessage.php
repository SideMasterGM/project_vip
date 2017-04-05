<?php
    include ("../../../connect_server/connect_server.php");
    include ("CalcDate.php");

    $CN = CDB("vip");
    @session_start();

    $id = $_POST['IdMessage'];

    if (is_array($CN->getActivity($id, 1))){
        foreach ($CN->getActivity($id, 1) as $Activity) {
            $QImg = $CN->getUserImgPerfil($Activity['username'], "DESC", 1);
            $Path = "";

            if (is_array($QImg)){
                foreach ($QImg as $value) {
                    $Path = "private/desktop0/".$value['folder'].$value['src'];
                }
            } else if (is_bool($QImg)) {
                $Path = "private/desktop0/img/img-default/bg_default.jpg";
            }

            $NameActivity = $CN->getActivityArgument($Activity['code']);

            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="OpenedMessage">Actividad</h4>
            </div>
                
            <div class="MessageSuccessError">
                <!-- Here code of Success or Error -->
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-9">
                        <span class="label label-default" style="font-size: 13px;" title="<?php echo $NameActivity; ?>" ><?php echo substr($NameActivity, 0, 50); ?></span>
                    </div>
                    <!-- <div class="col-xs-1">
                        <i class="fa fa-user-secret fa-lg" title="<?php echo "Agente: "; ?>" aria-hidden="true" style="cursor: pointer;"></i>
                    </div> -->
                    <div class="col-xs-1">
                        <i class="fa fa-user fa-lg" title="<?php echo "Lo envía ".$Activity['username']; ?>" aria-hidden="true" style="cursor: pointer;"></i>
                    </div>
                    <!-- <div class="col-xs-1">
                        <i class="fa fa-phone-square fa-lg" title="<?php echo "345345345"; ?>" aria-hidden="true" style="cursor: pointer;"></i>
                    </div> -->
                    <div class="col-xs-1">
                        <i class="fa fa-comments fa-lg" title="<?php echo $CN->getUserEmail($Activity['username']); ?>" aria-hidden="true" style="cursor: pointer;"></i>
                    </div>
                    <div class="col-xs-1">
                        <i class="fa fa-globe fa-lg" title="<?php echo date("Y-m-d H:i", $Activity['date_log_unix']); ?>" aria-hidden="true" style="cursor: pointer;"></i>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3">
                        <img src="<?php echo $Path; ?>" class="img_property" alt="Imagen de la propiedad" />
                    </div>
                    <div class="col-xs-9">
                        <blockquote class="blockquote-primary blockquote-rounded">
                            <p style="text-align: justify; font-size: 13px;"><?php echo $Activity['description']; ?></p>
                            <footer>Accionado por <cite title="Source Title"><?php echo $Activity['username']; ?></cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <form id="SendAnswerMessage">
                    <input type="hidden" name="id_sms" value="<?php echo $Activity['id_activity']; ?>" />
                    <textarea name="answer_message" id="answer_message" placeholder="Agregar respuesta..."></textarea><br/>
                    <div class="ChangeIconFavorite">

                        <?php
                            $QFav = $Activity['favorite'];
                            if ($QFav == "0" || $QFav == ""){
                                ?>
                                    <i class="fa fa-star-half-o fa-lg" onclick="javascript: UpdateFavoriteMessage();" title="Agregar a favoritos" aria-hidden="true" style="float: left; cursor: pointer;"></i>
                                <?php
                            } else {
                                 ?>
                                    <i class="fa fa-star fa-lg" onclick="javascript: UpdateFavoriteMessage();" title="Agregado como favorito" aria-hidden="true" style="float: left; cursor: pointer;"></i>
                                <?php
                            }
                        ?>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="SendMessageAnswer();" >Enviar mensaje</button>
                </form>

                <form id="ChangeIconFavoriteForm">
                    <input type="hidden" name="ChangeIconFavId" value="<?php echo $Activity['id_activity']; ?>" />
                </form>
            </div>  

            <form id="SaveDataIdMessage">
                <input type="hidden" name="SDIdMessage" value="<?php echo $Activity['id_activity']; ?>" />
            </form>

            <div class="WriteMessagesAnswer">
                <!-- Here the code that works as container to open messages answer -->
            </div>
        <?php
        }
    } else if (is_bool($CN->getActivity($id, 1))){
        echo "Fail";
    }
?>