<?php
session_start();
if (isset($_SESSION['usuario'])) {
   header('location:home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pagina de Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- styles -->
    <link href="dist/css/bootstrap2.css" rel="stylesheet">
	<link href="dist/css/theme.css" type="text/css" rel="stylesheet">
	<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet">-->
	<link href="dist/css/jasny-bootstrap.min.css" rel="stylesheet" >
    <!--<link href="assets/css/style-responsive.css" rel="stylesheet"> -->
	<script type="text/javascript" src="https://code.jquery.com/jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {	
	$('#nombre_user').blur(function(){
		$('#Info').html('<img src="Imagenes/loader.gif" alt="" />');
		var nombre_user = $(this).val();		
		var dataString = 'nombre_user='+nombre_user;
		
		$.ajax({
            type: "POST",
            url: "php/comprobar_nombre_user.php",
            data: dataString,
            success: function(data) {
				$('#Info').fadeIn(1000).html(data);
				//alert(data);
            }
        });
    });              
});    
</script>
  </head>
  <body>	  
	
  <div class="container">
	
  <div class="row">
	
  <div class="span9">
	
	<form class="form-horizontal" id="registerHere" name="nuevo_usuario" enctype="multipart/form-data" action="php/crearusuario.php" method="post">
	  <fieldset>
	    <legend>Registro de Usuario</legend>
	    <div class="control-group">
	      <label class="control-label" for="nombre_usuario">Nombre Completo</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="nombre" name="nombre" rel="popover" data-content="Ingrese su Nombre y Apellido." data-original-title="Nombre Completo">
	        
	      </div>
	</div>
	
	<div class="control-group">
	      <label class="control-label" for="user">Nombre Usuario</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="nombre_user" name="nombre_user" rel="popover" data-content="Ingrese su Nombre de Usuario." data-original-title="Usuario">
	        <div id="Info" ></div>
	      </div>
	</div>
	
	 <div class="control-group">
		<label class="control-label" for="mail">Email</label>
	      <div class="controls">
	        <input type="text" class="input-xlarge" id="user_email" name="user_email" rel="popover" data-content="Ingrese su direccion email" data-original-title="Email">
	       
	      </div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="password">Contraseña</label>
	      <div class="controls">
	        <input type="password" class="input-xlarge" id="contrasena" name="contrasena" rel="popover" data-content="Contraseña de 6 carateres" data-original-title="Password" >
	       
	      </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password2">Confirmar Contraseña</label>
	      <div class="controls">
	        <input type="password" class="input-xlarge" id="contrasena" name="contrasena_repeat" rel="popover" data-content="Re-ingrese para confirmar." data-original-title="Confirmación" >
	       
	      </div>
	</div>
	
	
	 <div class="control-group">
		<label class="control-label" for="genero_user">Genero</label>
	      <div class="controls">
	        <select name="genero" id="genero" >
            				
			                <option value="Hombre">Hombre</option>
			                <option value="Mujer">Mujer</option>
							<option value="otro">Otro</option>
			</select>      
	      </div>
	</div>
	
	
		<div class="control-group">
		<label class="control-label" for="imagen">Foto de perfil  </label>
		
			<div class="fileinput fileinput-new" data-provides="fileinput" >
					<div class="controls">
					<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
					<span class="btn btn-default btn-file">
					<span class="fileinput-new">Seleccione imagen</span>
					<span class="fileinput-exists">Cambiar</span>
					<input type="file" name="foto">
					</span>
					<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
					</div>
			</div>
		</div>
	
	
	<div class="control-group">
		<label class="control-label" for="input01"></label>
	      <div class="controls">
	       <button type="submit" class="btn btn-success" rel="tooltip" title="first tooltip">Crear mi cuenta</button>
	      </div>
		  
	</div>
	<div class="panel-footer">Volver a la página anterior <a href="index.php" class="">Volver</a>
                </div>	
	   
	 </fieldset>
	</form>
	</div>
	
	</div>
        
        
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
    <script src="https://code.jquery.com/jquery.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/jasny-bootstrap.min.js"></script>
     <!--<script src="assets/js/bootstrap-transition.js"></script> -->
    <!--<script src="assets/js/bootstrap-alert.js"></script>-->
    <!--<script src="assets/js/bootstrap-modal.js"></script>-->
    <!-- <script src="assets/js/bootstrap-dropdown.js"></script> -->
    <!-- <script src="assets/js/bootstrap-scrollspy.js"></script> -->
    <!-- <script src="assets/js/bootstrap-tab.js"></script> -->
    <script src="dist/js/bootstrap-tooltip.js"></script>
    <script src="dist/js/bootstrap-popover.js"></script>
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
	  <script type="text/javascript">
	  $(document).ready(function(){
			$('input').hover(function()
			{
			$(this).popover('show')
		});
			$("#registerHere").validate({
				rules:{
					nombre:"required",
					user_email:{
							required:true,
							email: true
						},
					nombre_user:{
						required: true,
						},
					contrasena:{
						required:true,
						minlength: 6
					},
					contrasena_repeat:{
						required:true,
						equalTo: "#contrasena"
					},
					gender:"required"
				},
				messages:{
					nombre:"Ingrese su Nombre y Apellido",
					nombre_user: "Ingrese su nombre de usuario",
					user_email:{
						required:"Ingrese su direccion email",
						email:"Ingrese una direccion email valida"
					},
					contrasena:{
						required:"Ingrese su contraseña",
						minlength:"La contraseña debe ser de un minimo de 6 caracteres"
					},
					contrasena_repeat:{
						required:"Re-ingrese para confirmar",
						equalTo:"La contraseña y su conformacón deben ser iguales"
					},
					gender:"Seleccione genero"
				},
				errorClass: "help-inline",
				errorElement: "span",
				highlight:function(element, errorClass, validClass) {
					$(element).parents('.control-group').addClass('error');
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).parents('.control-group').removeClass('error');
					$(element).parents('.control-group').addClass('success');
				}
			});
		});
	  </script>
	
	

  

  </body>
</html>

