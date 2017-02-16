<div class="container-fluid">
    <div class="side-body padding-top">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <a href="#">
                    <div class="card red summary-inline">
                        <div class="card-body">
                            <i class="icon fa fa-inbox fa-4x"></i>
                            <div class="content">
                                <div class="title">0</div>
                                <div class="sub-title">Visitantes</div>
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
                                <div class="title">0</div>
                                <div class="sub-title">Usuarios</div>
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
                                <div class="sub-title">Artículos</div>
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
                                <div class="sub-title">Agentes</div>
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
                            <div class="title"><i class="fa fa-comments-o"></i> Mensajes recientes</div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="card-body no-padding">
                        <ul class="message-list">

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
                            <div class="title"><i class="fa fa-comments-o"></i> Mensajes favoritos</div>
                        </div>
                        <div class="clear-both"></div>
                    </div>
                    <div class="card-body no-padding">
                        <ul class="message-list">

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