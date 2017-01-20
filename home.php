<?php
session_start();
$nombre_usuario = $_SESSION['usuario'];
if (!isset($_SESSION['usuario'])) {
  //readfile('login.html');
   header('location:index.php');
  // exit();
}else{?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="home" content="">

    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link rel="stylesheet" href="dist/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="dist/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="dist/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="dist/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="dist/css/style.css" rel="stylesheet">
    <link href="dist/css/style-responsive.css" rel="stylesheet">

    <script rel="stylesheet" src="dist/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body onload="inicio()">
	<section id="container" >
      <!-- ***********************************************************************************************************
      Barra superior y notificaciones
      ***************************************************************************************************************************** -->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Bienvenido a Homeduino</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu" onclick="boxNotificaciones()">
                    <!-- settings start -->
                    <li class="dropdown" >
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme" id="N_notificaciones">0</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar" id="lista_notificaciones">
                         <!--   <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">Tienes 2 notificaciones sin ver</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Temperatura Normal</div>
                                        <div class="percent">30%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
                                            <span class="sr-only">30% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Humedad del Aire</div>
                                        <div class="percent">20%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">Ver todas </a>
                            </li>-->
                        </ul>
                    </li>
                    <!-- settings end -->
                    
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="php/finalizarsession.php">Salir</a></li>
            	</ul>
            </div>
        </header>
	<!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              <?php
			  $usuario_bd = 'root';
			  $passwd_bd = '';
			  try {
			//	print "Conectando";
			$conn = new PDO('mysql:host=localhost;dbname=dbapinet;charset=utf8', $usuario_bd, $passwd_bd);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
			print "¡Error!: " . $e->getMessage() . "<br/>";
			die();
			}

			$stmt = $conn->prepare("SELECT * FROM datos_usuario WHERE user = :usuario");
			$stmt->bindParam(':usuario',$nombre_usuario);
			$stmt->execute();
			if($row = $stmt->fetch()){
			//echo '<td> <img src="Imagesuser/'.$row['imagen'].'" alt="Foto usuario"/> </td>';
            echo  '<p class="centered"><a href="#"> <img src="Imagesuser/'.$row['imagen'].'" class="img-circle" width="150"> </a></p>';
             }
			?> 
			<h5 class="centered"><?php echo $_SESSION['usuario']; ?></h5>
              	  	
                <!--  <li class="mt">
                      <a class="active" href="#">
                          <i class="fa fa-dashboard"></i>
                          <span onclick="mostrar_inicio()">Dashboard</span>
						  
                      </a>
                  </li>-->
				
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span onclick="mostrar_notificaciones()">Notificaciones</span>
                      </a>
                      
                  </li>

                  <li class="sub-menu">
                      <a href="#"  >
                          <i class="fa fa-cogs"></i>
                          <span>Mis Hogares</span>
                      </a>
                      <ul class="sub">
                          <li><a  onclick="gestionDeCasas()">Gestión de Casas</a></li>
                          <li><a  onclick="monitorizacionDeCasas()">Monitorización de Casas</a></li>
                          
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="#" >
                          <i class="fa fa-book"></i>
                          <span onclick="ver_datos()">Mi Perfil</span>
                      </a>
                      
                  </li>
                  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
	  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
	  
          <section class="wrapper">

             <!-- <div class="row">-->
                  <div class="col-lg-15 main-chart">
                  
                  	<div class="row mtbox" id="SISTEMA">
                  		<div class="col-md-10 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
					  			<span class="li_data"></span>
					  			<h3>loading...</h3>
                  			</div>
					  			<p></p>
                  		</div>
                  	</div><!-- /row mt -->	
					<div id="notificaciones">
					
					</div>
					
					<div id="formulario_datos">
																					
					</div>

					
					<div class="col-md-10 col-sm-2 col-md-offset-1 " id="gestion">
					</div>
					<!-- /row mt -->	
					
					<div class="col-md-10 col-sm-2 col-md-offset-1 " id="monitorizacion">
					</div>
					                      
                    <!--  <div class="row mt">
                      <!-- SERVER STATUS PANELS -->
					  <div id="div_grafico">
                      	
						</div>	<!-- DIV GRAFICO--> 
                 <!--   </div>  --> <!-- /row -->
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                 <!-- <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
					<!--	<h3>NOTIFICACIONES</h3>
                                        
                      <!-- First Action -->
                 <!--     <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>Hace 2 Minutos</muted><br/>
                      		   <a href="#">Temperatura</a> Temperatura elevada.<br/>
                      		</p>
                      	</div>
                      </div>
                      <!-- Second Action -->
                 <!--     <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>Hace 3 Horas</muted><br/>
                      		   <a href="#">Temperatura</a> Temperatura elevada.<br/>
                      		</p>
                      	</div>
                      </div>
                      <!-- Third Action -->
                <!--      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>Hace 7 Horas</muted><br/>
                      		   <a href="#">Temperatura</a> Temperatura sobre el promedio.<br/>
                      		</p>
                      	</div>
                      </div>
                      <!-- Fourth Action -->
                <!--      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>Hace 11 Horas</muted><br/>
                      		   <a href="#">Humedad</a> Humedad Normal.<br/>
                      		</p>
                      	</div>
                      </div>-->
                      
                        <!-- CALENDAR-->
                        <!--<div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div> --> <!-- / calendar -->
                      
               <!--   </div><!-- /col-lg-3 -->
          <!--    </div> <!--/row -->
			  
          </section>
		  
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 - Homeduino
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="https://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script> 
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="dist/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="dist/js/jquery.scrollTo.min.js"></script>
    <script src="dist/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="dist/js/jquery.sparkline.js"></script>

    <!--common script for all pages-->
    <script src="dist/js/common-scripts.js"></script>
    <script type="text/javascript" src="dist/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="dist/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="dist/js/sparkline-chart.js"></script>    
	<script src="dist/js/zabuto_calendar.js"></script>	
	
	<script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Bienvenido a Homeduino!',
            // (string | mandatory) the text inside the notification
            text: 'Ya puede optener informacion de los servicios de su hogar.',
            // (string | optional) the image to display on the left
            image: 'Imagenes/logo1.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	</script>
	
	</section>
  
  </body>
</html>
<?php
}?>
<script language="javascript" type="text/javascript">
function mensaje (alerta){
		alert(alerta);
}

gestion_visible = false;
function gestionDeCasas (){
//document.getElementById('SISTEMA').hidden=true;
	if(monitorizacion_visible)	
		monitorizacionDeCasas ();
	if(ver_misdatos)
		ver_datos();
	if(ver_notificaciones)
		mostrar_notificaciones();
	if(!gestion_visible){
		gestion_visible=true;		
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			 {
			 document.getElementById('gestion').innerHTML=xmlhttp.responseText;
			 //document.getElementById('gestion').hidden=false;
			 }
		  }
		url_php = 'php/gestioncasas.php';	
			       //metodo,url a enviar,asincrona, si es  asincrona no detiene la pagina a la espera de respuesta	
		xmlhttp.open("GET",url_php,true);
		xmlhttp.send();
	}else{
		gestion_visible=false;
		document.getElementById('gestion').innerHTML='';
		//document.getElementById('gestion').hidden=true;
	}
}

monitorizacion_visible = false;
function monitorizacionDeCasas (){
	if (gestion_visible)
		gestionDeCasas ();
	if(ver_misdatos)
		ver_datos();
	if(ver_notificaciones)
		mostrar_notificaciones();
	if (!monitorizacion_visible){
		monitorizacion_visible = true;
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			 {
			 document.getElementById('monitorizacion').innerHTML=xmlhttp.responseText;
			 //document.getElementById('monitorizacion').hidden=false;
			 }
		  }
		url_php = 'php/monitorizacion.php';	
			       //metodo,url a enviar,asincrona, si es  asincrona no detiene la pagina a la espera de respuesta	
		xmlhttp.open("GET",url_php,true);
		xmlhttp.send();
	}else{
		monitorizacion_visible = false;
		document.getElementById('monitorizacion').innerHTML='';
		//document.getElementById('monitorizacion').hidden=true;
	}	
}

function detalleImplementos (id_casa){
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			 {
			 document.getElementById('implementos_casa').innerHTML=xmlhttp.responseText;
			 
			 }
		  }
		//  url_php = 'nuevoimplemento.php'
		url_php = 'php/detalleImplementos.php?user_casa='+id_casa;	
			       //metodo,url a enviar,asincrona, si es  asincrona no detiene la pagina a la espera de respuesta	
		xmlhttp.open("GET",url_php,true);
		xmlhttp.send();
}

function agregarCasa(){
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			 {
			     respuesta=xmlhttp.responseText;
					if (respuesta == 'ok'){
						gestion_visible = false;
						gestionDeCasas ();
			 		}else
					if (respuesta == 'repeat'){
						alert('La casa ya ha sido agregada');
			 		}else{
						alert('Error usuario o contraseña incorrectos');
					}
			 }
		  }
		user_casa =document.getElementById('user_casa').value;
		pass_casa =document.getElementById('pass_casa').value;
		url_php = 'php/agregarcasa.php?user_casa='+user_casa+'&pass_casa='+pass_casa;

			       //metodo,url a enviar,asincrona, si es  asincrona no detiene la pagina a la espera de respuesta	
		xmlhttp.open("GET",url_php,true);
		xmlhttp.send();
}

function borrarCasa(id_casa){
	var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			 {
			    gestion_visible = false;
				 gestionDeCasas ();
			 		
			 }
		  }
		user_casa =document.getElementById('user_casa').value;

		url_php = 'php/borrarcasa.php?user_casa='+id_casa;

			       //metodo,url a enviar,asincrona, si es  asincrona no detiene la pagina a la espera de respuesta	
		xmlhttp.open("GET",url_php,true);
		xmlhttp.send();
}
function monitorNotificaciones (){
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		 {
		 document.getElementById('N_notificaciones').innerHTML=xmlhttp.responseText;
		 monitorNotificaciones ();
		 }
	  }
	url_php = 'php/rebicionnotificaciones.php';	
			   //metodo,url a enviar,asincrona, si es  asincrona no detiene la pagina a la espera de respuesta	
	xmlhttp.open("GET",url_php,true);
	xmlhttp.send();
}
function boxNotificaciones (){
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		 {
		 document.getElementById('lista_notificaciones').innerHTML=xmlhttp.responseText;
		 }
	  }
	url_php = 'php/rellenarnotificaciones.php';	
			   //metodo,url a enviar,asincrona, si es  asincrona no detiene la pagina a la espera de respuesta	
	xmlhttp.open("GET",url_php,true);
	xmlhttp.send();
}

ver_misdatos = false;
function ver_datos (){
//document.getElementById('SISTEMA').hidden=true;
	if(monitorizacion_visible)	
	    monitorizacionDeCasas ();
	if (gestion_visible)
		gestionDeCasas();
	if(ver_notificaciones)
		mostrar_notificaciones();
	if(!ver_misdatos){
		ver_misdatos=true;
		
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			 {
			 document.getElementById('formulario_datos').innerHTML=xmlhttp.responseText;
			 //document.getElementById('formulario_datos').hidden=false;
			 }
		  }
		url_php = 'php/cargardatos.php';	
			       //metodo,url a enviar,asincrona, si es  asincrona no detiene la pagina a la espera de respuesta	
		xmlhttp.open("GET",url_php,true);
		xmlhttp.send();
	}else{
		ver_misdatos=false;
		document.getElementById('formulario_datos').innerHTML='';
		//document.getElementById('formulario_datos').hidden=true;
	}
}

ver_notificaciones= false;
function mostrar_notificaciones(){

	if(monitorizacion_visible)	
	    monitorizacionDeCasas ();
	if (gestion_visible)
		gestionDeCasas();	
	if(ver_misdatos)
		ver_datos()
	
	if(!ver_notificaciones){
		ver_notificaciones=true;

		var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
		}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
			xmlhttp.onreadystatechange=function()
		{
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			 {
			 document.getElementById('notificaciones').innerHTML=xmlhttp.responseText;
			 }
		  }
			url_php = 'php/seccionnotificaciones.php';	
			   //metodo,url a enviar,asincrona, si es  asincrona no detiene la pagina a la espera de respuesta	
		xmlhttp.open("GET",url_php,true);
		xmlhttp.send();
		}else{
			ver_notificaciones=false;
			document.getElementById('notificaciones').innerHTML='';
			//document.getElementById('notificaciones').hidden=true;
		}
}

function sistema(){
var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
		}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
			xmlhttp.onreadystatechange=function()
		{
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			 {
			 document.getElementById('SISTEMA').innerHTML=xmlhttp.responseText;
			 }
		  }
			url_php = 'php/comprobacionsistemas.php';	
			   //metodo,url a enviar,asincrona, si es  asincrona no detiene la pagina a la espera de respuesta	
		xmlhttp.open("GET",url_php,true);
		xmlhttp.send();
		

}

function inicio(){
	monitorNotificaciones ();
	sistema();
}

</script>

