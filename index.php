<?php
session_start();
if (isset($_SESSION['usuario'])) {
  //readfile('login.html');
  header('location:home.php');
	exit();
}else{?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Homeduino Index</title>

    <!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta charset="utf-8">
       
	<!-- Stylesheets -->
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/theme.css"         rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!--<link rel="shortcut icon" href="/bootstrap/img/favicon.ico"> 
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" type="text/css" rel="stylesheet"> 
	<link href="http://www.bootply.com/bootply/bootply.css" type="text/css" rel="stylesheet">-->
    </head>
    <body>
    
	<div class="container">
		<h1 class="text-center login-title ">Homeduino</h1>
		<div class="row">
        </br>
        <div class="col-md-6">
            <div class="account-wall">
                <img class="img-responsive" src="Imagenes/logo1.png" WIDTH=400 HEIGHT=400  alt="Imagen responsive">
				</div>
        </div>
        </br>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">Iniciar Sesion</strong>

                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" name="ingresar_usuario" action="php/verificacionlogin.php" method="get">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Usuario</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="inputName" name="nombre_usuario" placeholder="Usuario" required="" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-3 control-label">Contraseña</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="inputPassword" name="contrasena" placeholder="password" required="" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox">
                                    <label class="">
                                        <input class="" type="checkbox">Recordarme</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                               <!-- <input type="submit" name="Ingresar" value="Ingresar" class="btn btn-success btn-sm" onClick="location.href='home.html'" />-->
							   <input type="submit" name="Ingresar" value="Ingresar" class="btn btn-success btn-sm"/>
                                <button type="reset" class="btn btn-default btn-sm">Borrar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">¿Tiene su producto? <a href="form.php" class="">Registrarse</a>
                </div>
            </div>
         </div>
        </div>
    </div>
    <!-- FOOTER -->
	  </br>
    
      <p class="lead text-center">Homeduino - Control Remoto del Hogar <a href="">homeduino@gmail.com</a></p>
      
      
      <p class="text-center">&copy; Todos los derechos reservados</p>
    <!-- Javascript -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script> 
    <script type="text/javascript" src="dist/js/bootstrap.js"></script> 
  </body>
</html>
<?php
}



?>