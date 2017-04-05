<div class="container-fluid">
    <div class="side-body padding-top">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="card red summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-inbox fa-4x"></i>
                            <div class="content">
                                <div class="title"><?php echo $CN->getUserSession(); ?></div>
                                <div class="sub-title">Total de inicios de sesión</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="users">
                    <div class="card yellow summary-inline">
                        <div class="card-body">
                            <!-- <i class="icon fa fa-comments fa-4x"></i> -->
                            <i class="icon fa fa-users fa-4x"></i>
                            <div class="content">
                                <div class="title"><?php echo $CN->getUserCount(); ?></div>
                                <div class="sub-title">Usuarios Registrados</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="articles">
                    <div class="card green summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-tags fa-4x"></i>
                            <div class="content">
                                <div class="title">0</div>
                                <div class="sub-title">Proyectos</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="agents">
                    <div class="card blue summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-user-secret fa-4x"></i>
                            <div class="content">
                                <div class="title">0</div>
                                <div class="sub-title">Coordinadores</div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row  no-margin-bottom">
            <div class="col-sm-6 col-xs-12">
                <div class="card card-success">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="title"><i class="fa fa-bell-o"></i> Mi actividad</div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="card-body no-padding">
                        <ul class="message-list">

                            <?php
                                include ("private/desktop0/html/build/CalcDate.php");
                                
                                if (is_array($CN->getMyActivity(4))){
                                    foreach ($CN->getMyActivity(4) as $Activity) {
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
                                            <a href="#" onclick="LoadMessage('<?php echo $Activity['id_activity']; ?>');">
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
                                    }
                                } else if (is_bool($CN->getMyActivity(4))){
                                    echo "No hay actividad.";
                                }

                            ?>

                            <form id="SendIdMessage">
                                <input type="hidden" id="IdMessage" name="IdMessage" value="" />
                            </form>

                            <a href="#" id="message-load-more" onclick="javascript: CallModalMessage();">
                                <li class="text-center load-more">
                                    <i class="fa fa-refresh"></i> Cargar más...
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="card card-success">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="title"><i class="fa fa-dot-circle-o"></i> Actividad reciente</div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="card-body no-padding">
                        <ul class="message-list">
                            
                            <?php                                
                                if (is_array($CN->getActivityWithOutMe(4))){
                                    foreach ($CN->getActivityWithOutMe(4) as $Activity) {
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
                                            <a href="#" onclick="LoadMessage(<?php echo $Activity['id_activity']; ?>);">
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
                                    }
                                } else if (is_bool($CN->getActivityWithOutMe(4))){
                                    echo "No hay actividad.";
                                }

                            ?>

                            <form id="SendIdMessage">
                                <input type="hidden" id="IdMessage" name="IdMessage" value="" />
                            </form>

                            <a href="#" id="message-load-more" onclick="javascript: CallModalMessageFav();">
                                <li class="text-center load-more">
                                    <i class="fa fa-refresh"></i> Cargar más...
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <?php include ("private/desktop0/html/build/modals.php"); ?>
        </div>
    </div>
</div>