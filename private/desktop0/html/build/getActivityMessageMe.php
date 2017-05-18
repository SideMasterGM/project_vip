<?php                                
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */

    include ("../../../connect_server/connect_server.php");
    include ("CalcDate.php");

    $CN = CDB("vip");
    @session_start();

    if (is_array($CN->getActivityNotificationMessage(@$_SESSION['usr'], 10))){
        foreach ($CN->getActivityNotificationMessage(@$_SESSION['usr'], 10) as $ActivityNotificationMessage) {
               
            if (is_array($CN->getActivity($ActivityNotificationMessage['id_activity'], 1))){
                foreach ($CN->getActivity($ActivityNotificationMessage['id_activity'], 1) as $getActivity) {
                    $QImg = $CN->getUserImgPerfil($getActivity['username'], "DESC", 1);
                    $Path = "";

                    if (is_array($QImg)){
                        foreach ($QImg as $value) {
                            $Path = "private/desktop0/".$value['folder'].$value['src'];
                        }
                    } else if (is_bool($QImg)) {
                        $Path = "private/desktop0/img/img-default/bg_default.jpg";
                    }

                    ?>
                        <a href="#" onclick="LoadMessage(<?php echo $getActivity['id_activity']; ?>);">
                            <li>
                                <img src="<?php echo $Path; ?>" width="60px" height="60px" class="profile-img pull-left">
                           
                                <div class="message-block">
                                    <div><span class="username"><?php echo $getActivity['username']; ?></span> <span class="message-datetime"><?php echo nicetime(date("Y-m-d H:i", $getActivity['date_log_unix'])); ?></span>
                                    </div>
                                    <div class="message">
                                        <?php 
                                            echo substr($getActivity['description'], 0, 260); 

                                            if (strlen($getActivity['description']) > 260){
                                                echo "...";
                                            }
                                        ?>
                                    </div>
                                </div>

                            </li>
                        </a>
                    <?php

                }
            } else if (is_bool($CN->getActivity($ActivityNotificationMessage['id_activity'], 1))){
                echo "No hay actividad.";
            }

        }
    } else if (is_bool($CN->getActivityNotificationMessage(@$_SESSION['usr'], 10))) {
        ?>
            <p align="center" style="margin: 20px; font-size: 15px;">No hay notificaciones</p>
        <?php
    }
?>

<form id="SendIdMessage">
    <input type="hidden" id="IdMessage" name="IdMessage" value="" />
</form>