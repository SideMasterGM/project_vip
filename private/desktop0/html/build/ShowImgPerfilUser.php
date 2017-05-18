<?php
    /**
        * --------------------------------------------- *
        * @author: Jerson A. Martínez M. (Side Master)  *
        * --------------------------------------------- *
    */

	include ("../../../connect_server/connect_server.php");
	$CN = CDB("vip");

	$QImg = $CN->getUserImgPerfil($_POST['nombre_de_usuario'], "DESC", 1);

	if (is_array($QImg)){
        foreach ($QImg as $value) {
            ?>
                <div style="background: url('private/desktop0/<?php echo $value['folder'].$value['src']; ?>'); width: 230px; height:230px; border-radius: 50% 50%; background-size: cover; border: 3px solid lightgrey; float: right;">
                </div>
            <?php
        }
    } else if (is_bool($QImg)) {
        ?>
            <div style="background: url('private/desktop0/img/img-default/bg_default.jpg'); width: 230px; height:230px; border-radius: 50% 50%; background-size: cover; border: 3px solid lightgrey; float: right;">
            </div>
        <?php
    }
?>