<?php
    include ("../../../connect_server/connect_server.php");
    include ("CalcDate.php");

    $CN = CDB("vip");
    @session_start();

    $Id = $_POST['SDIdMessage'];

    if (is_array($CN->getActivityMessage($Id))){
        foreach ($CN->getActivityMessage($Id) as $Activity) {
            $QImg = $CN->getUserImgPerfil($Activity['username'], "DESC", 1);
            $Path = "";

            if (is_array($QImg)){
                foreach ($QImg as $value) {
                    $Path = "private/desktop0/".$value['folder'].$value['src'];
                }
            } else if (is_bool($QImg)) {
                $Path = "private/desktop0/img/img-default/bg_default.jpg";
            }

            // $NameActivity = $CN->getActivityArgument($Activity['code']);

            ?>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-10">
                            <span class="label label-default" style="float: left; font-size: 13px;" title="<?php echo $Activity['username']; ?>" >Enviado por <b><?php echo substr($Activity['username'], 0, 50); ?></b></span>
                        </div>

                        <div class="col-xs-1">
                            <i class="fa fa-comments fa-lg" title="<?php echo $CN->getUserEmail($Activity['username']); ?>" aria-hidden="true" style="cursor: pointer;"></i>
                        </div>

                        <div class="col-xs-1">
                            <i class="fa fa-globe fa-lg" title="<?php echo date("Y-m-d H:i", $Activity['date_log_unix']); ?>" aria-hidden="true" style="cursor: pointer;"></i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-10">
                            <blockquote class="blockquote-rounded blockquote-reverse">
                                <p style="text-align: justify; font-size: 13px;"><?php echo $Activity['message']; ?></p>

                                <?php
                                    // $DataContactUs = $Conexion->query("SELECT * FROM contact_us ORDER BY id DESC LIMIT 1;")->fetch_array(MYSQLI_ASSOC);
                                ?>
                                <footer>
                                    <?php 
                                        echo "Consultar a <";
                                        ?>
                                            <cite title="Source Title"><?php echo $CN->getUserEmail($Activity['username']); ?></cite>
                                        <?php 
                                        echo ">";
                                    ?> 
                                </footer>
                            </blockquote>
                        </div>
                        <div class="col-xs-2">
                            <img src="<?php echo $Path; ?>" class="img_property_answer" alt="Imagen de perfil Administrador" />
                            
                        </div>
                    </div>
                </div>
            <?php
        }

    }
?>