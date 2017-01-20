<?php
session_start();
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
	
	$stmt_ = $conn->prepare("select count(user_casa) as numero_de_casas from casas_usuarios where user_usuario = :usuario;");
	$stmt_->bindParam(':usuario',$usuario);
	$stmt_->execute();
	$casas_asociadas = true;
	if ($row_ = $stmt_->fetch()){
		if ($row_['numero_de_casas'] <= 0){
			$casas_asociadas = false;
		}
	}else{
		$casas_asociadas = false;
	}
	
	if ($casas_asociadas){
		$stmt = $conn->prepare("select user_casa , max(ultima_actualizacion) as fecha from implementos_casa WHERE user_casa IN (select user_casa from casas_usuarios where user_usuario = :usuario) GROUP BY user_casa ;");
		$stmt->bindParam(':usuario',$usuario);
		$stmt->execute();
		
		$fecha_minima = date('Y-m-d H:i:s', time()-15000);
		$numero_de_notificaciones;
		$actualizado = true;
		$casas_desactualizadas = "Casas desactualizadas";
		$ultima_actualizacion;
		while($row = $stmt->fetch()){
			$a = date('Y-m-d H:i:s', strtotime($row['fecha']));
			$ultima_actualizacion = $row['fecha'];
			if ($fecha_minima> $a){
				$casas_desactualizadas = $casas_desactualizadas .'  '. $row['user_casa'];
				$actualizado = false;
			}
		}
		
		echo '<div class="col-md-10 col-sm-2 col-md-offset-1 box0">';
			echo '<div class="box1">';
				echo '<span class="li_data"></span>';
				echo '<h3>';
				if ($actualizado)
					echo 'Sistema ok!';
				else
					echo 'Sistema desactualizado!';
				echo '</h3>';
			echo '</div>';
				echo '<p>';
				if ($actualizado)
					echo 'Ultima actualizacion '.$ultima_actualizacion;
				else
					echo $casas_desactualizadas;
				 
				echo'</p>';
		echo '</div>';
	}else{
		echo '<div class="col-md-10 col-sm-2 col-md-offset-1 box0">';
			echo '<div class="box1">';
				echo '<span class="li_data"></span>';
				echo '<h3>';
					echo 'No hay sistemas asociados!';
				echo '</h3>';
			echo '</div>';
				echo '<p>';
					echo 'En la seccion gesti&oacuten de casa puede asociar sus hogares.';
				echo'</p>';
		echo '</div>';
	}
}
?>
