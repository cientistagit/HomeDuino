<?php
session_start();
$nombre_usuario = $_SESSION['usuario'];
if (!isset($_SESSION['usuario'])) {
  //readfile('login.html');
   header('location:../index.php');
  // exit();
}else{
$usuario = $_SESSION['usuario'];
// Conexion bdd
	$usuario_bd = 'root';
	$passwd_bd = '';
	$nombre_bd = 'dbapinet';
	try {
		 $conn = new PDO('mysql:host=localhost;dbname='.$nombre_bd.';charset=utf8', $usuario_bd, $passwd_bd);
		 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		$flag = false;
	    print "¡Error!: " . $e->getMessage() . "<br/>";
		 die();
	}
	$stmt = $conn->prepare("SELECT * FROM datos_usuario WHERE user = :usuario");
			$stmt->bindParam(':usuario',$nombre_usuario);
			$stmt->execute();
			if($row = $stmt->fetch()){
			//echo '<td> <img src="Imagesuser/'.$row['imagen'].'" alt="Foto usuario"/> </td>';
			
            echo  '
			<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i>Datos Personales</h4>
                      <form class="form-horizontal style-form" method="get">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nombre Usuario</label>
                              <div class="col-sm-10">
                                  <p class="form-control-static">';
			echo $nombre_usuario;
			echo '</p>
                              </div>
                          </div>
						  
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nombre Completo</label>
                              <div class="col-sm-10">
                                  <p class="form-control-static">';
			echo $row['nombre'];
			echo '</p>
                              </div>
                          </div>
						
						 <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                  <p class="form-control-static">';
			echo $row['email'];
			echo '</p>
                              </div>
                          </div>

						<div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Genero</label>
                              <div class="col-sm-10">
                                  <p class="form-control-static">';
			echo $row['genero'];
			echo '</p>
                              </div>
                          </div>
						  
                      </form>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
			';
             }
			 }
?>
