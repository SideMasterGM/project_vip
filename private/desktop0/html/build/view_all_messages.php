<?php                                
    include ("../../../connect_server/connect_server.php");
    include ("CalcDate.php");

    $CN = CDB("vip");
    @session_start();

    if (is_array($CN->getMyActivity(20))){
        $counter = 1;
        foreach ($CN->getMyActivity(20) as $Activity) {
            $QImg = $CN->getUserImgPerfil($Activity['username'], "DESC", 1);
            $Path = "";

            if (is_array($QImg)){
                foreach ($QImg as $value) {
                    $Path = "private/desktop0/".$value['folder'].$value['src'];
                }
            } else if (is_bool($QImg)) {
                $Path = "private/desktop0/img/img-default/bg_default.jpg";
            }

            ?>
                <a href="#" onclick="LoadMessage(<?php echo $Activity['username'].$counter; ?>);">
                    <li>
                        <img src="<?php echo $Path; ?>" width="60px" height="60px" class="profile-img pull-left">
                   
                        <div class="message-block">
                            <div><span class="username"><?php echo $Activity['username']; ?></span> <span class="message-datetime"><?php echo nicetime(date("Y-m-d H:i", $Activity['date_log_unix'])); ?></span>
                            </div>
                            <div class="message">
                                <?php 
                                    echo substr($Activity['description'], 0, 260); 

                                    if (strlen($Activity['description']) > 260){
                                        echo "...";
                                    }
                                ?>
                            </div>
                        </div>

                    </li>
                </a>
            <?php
            $counter++;
        }
    } else if (is_bool($CN->getMyActivity(20))){
        echo "No hay actividad.";
    }
?>

<form id="SendIdMessage">
    <input type="hidden" id="IdMessage" name="IdMessage" value="" />
</form>