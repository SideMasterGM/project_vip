
<!DOCTYPE html>
<html lang="">
  <head>
    <?php include ("private/desktop/design/php/head.php"); ?>
  </head>

		<body>
      <nav class="radim navbar navbar-default" role="navigation">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
          </div>

          <div class="collapse navbar-collapse navbar-ex1-collapse">
              <ul class="nav navbar-nav">
                  <li>
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar un usuario">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </span>
                      </div>
                  </li>

                  <li class="seperator"></li>
                  <li>
                      <a href="#1">
                          <span class="badge">6</span>
                          <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                          <span class="menu-description">Mi Perfil</span>
                      </a>
                  </li>

                  <li>
                      <a href="#1">
                          <span class="badge">42</span>
                          <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                          <span class="menu-description">Usuarios</span>
                      </a>
                  </li>

                  <li class="dropdown">
                      <a href="#2" class="dropdown-toggle" data-toggle="dropdown">
                          <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>

                          <span class="menu-description">Menu</span>
                      </a>

                      <ul class="dropdown-menu">
                          <li><a href="#5">Menu simple</a></li>
                          <li class="dropdown">
                              <a href="#6" class="dropdown-toggle" data-toggle="dropdown">
                                  <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                                  <span class="menu-description">Sub Menu</span>
                              </a>

                              <ul class="dropdown-menu">
                                  <li><a href="#">Link 1</a></li>
                                  <li class="dropdown">
                                      <a href="#6" class="dropdown-toggle" data-toggle="dropdown">
                                          <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                                          <span class="menu-description">Even More</span>
                                      </a>

                                      <ul class="dropdown-menu">
                                          <li><a href="#">Enlace 1</a></li>
                                          <li><a href="#">Enlace 2</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </li>

                  <li class="active">
                      <a href="#3">
                          <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                          <span class="menu-description">Enlace activado</span>
                      </a>
                  </li>

                  <li class="disabled">
                      <a href="#4">
                          <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                          <span class="menu-description">Enlace desactivado</span>
                      </a>
                  </li>

                  <li class="seperator"></li>
                  <li>
      <!-- 
                      <form class="navbar-form navbar-left" role="search">
                          <div class="form-group">
                              <input type="text" class="form-control" placeholder="Username">
                              <input type="text" class="form-control" placeholder="Password">
                          </div>
                          <button type="submit" class="btn btn-default">Login</button>
                      </form>

                      <form class="navbar-form navbar-left" role="search">
                          <div class="form-group">
                              <input type="text" class="form-control" placeholder="Email ID">
                          </div>
                          <button type="submit" class="btn btn-default">Subscribe</button>
                      </form> -->
                  </li>
              </ul>
          </div>
      </nav>
        
      <div class="container-radim">
              <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <ul class="nav navbar-nav navbar-left">
                      <img src="source/img/logo.png" title="Vicerrectoría de Investigación, Posgrado y Proyeción Social de la Universidad Nacional Autónoma de Nicaragua, ubicada en el departamento de León." width="50px" height="65px" alt="Logo" />
                    </ul>
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" title="Vicerrectoría de Investigación, Posgrado y Proyeción Social de la Universidad Nacional Autónoma de Nicaragua, ubicada en el departamento de León.">
                      VIP-PS | UNAN - León
                    </a>
                  </div>

                
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li class="active">
                        <a href="#">
                          Acción 1
                          <span class="sr-only">(current)</span>
                        </a>
                      </li>

                      <li><a href="#">Acción 2</a></li>
                      
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Acción</a></li>
                          <li><a href="#">Otra acción</a></li>
                          <li><a href="#">Alguna cosa más aquí</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Link separador</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Un link separador más</a></li>
                        </ul>
                      </li>
                    </ul>

                    <form class="navbar-form navbar-left" role="search">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nombre del proyecto...">
                      </div>
                      <button type="submit" class="btn btn-default">Buscar ahora</button>
                    </form>
                    

                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="#" class="logout">Cerrar sesión</a></li>
                    </ul>

                  </div>
                </div>
              </nav>

				<div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="bs-component">
                  <ul class="breadcrumb">
                    <li><a href="#">PRINCIPAL</a></li>
                    <li class="active">Información general</li>
                  </ul>

                  <div class="row">
                    <div class="col-lg-4">

                      <div class="bs-component">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <span class="badge">14</span>
                            Usuarios logueados recientemente
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <?php include ("private/desktop/design/php/sm.CalcDate.php"); ?>

                  <div class="row">
                    <div class="col-lg-4">
                      <div class="bs-component">
                        <ul class="list-group">
                          <?php
                            $CN = CDB("vip");
                            $getUsers = $CN->getSessionUser(2, "DESC");

                            if (is_array($getUsers) && count($getUsers) > 0){
                              foreach ($getUsers as $Users) {
                                ?>
                                  <li class="list-group-item">
                                    <span class="badge"><?php echo nicetime(date("Y-m-d H:i", $Users['date_log_unix'])); ?></span>
                                    <?php echo $Users['username']; ?>
                                  </li>
                                <?php
                              }
                            }
                          ?>
                        </ul>
                      </div>
                    </div>
                  </div>

                <div class="jumbotron">
                  

                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Including Javascript Files -->
      <!-- jQuery -->
      <script src="private/desktop/code.jquery.com/jquery.min.js"></script>
      <!-- Bootstrap JavaScript -->
      <script src="private/desktop/netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
      <script src="private/desktop/design/codecanyon/radim.js"></script>
      <script src="private/desktop/design/js/script.js"></script>

      <script type="text/javascript">
        $(document).ready(function(){
          $('body').css('display', 'block');
          $('#changeNavbarClass').on('click', function(){
            if ($('.navbar-default').length > 0) {
              $('.navbar').removeClass('navbar-default');
              $('.navbar').addClass('navbar-inverse');
            } else {
              $('.navbar').removeClass('navbar-inverse');
              $('.navbar').addClass('navbar-default');
            }
          });

          $('#togglePosition').on('click', function(){
            if ($('.radim-fixed').length > 0) {
              $('.navbar').removeClass('radim-fixed');
            } else {
              $('.navbar').addClass('radim-fixed');
            }
          });
        });
      </script>
		
		</body>
</html>	