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
	
	$stmt = $conn->prepare("SELECT COUNT(*) numero_de_notificaciones FROM notificaciones INNER JOIN (SELECT user_casa FROM casas_usuarios WHERE user_usuario = :usuario) AS casas_registradas ON notificaciones.user_casa = casas_registradas.user_casa ;");
	$stmt->bindParam(':usuario',$usuario);
	$stmt->execute();
	$numero_de_notificaciones;
	if($row = $stmt->fetch()){
		$numero_de_notificaciones  = $row['numero_de_notificaciones'];
	}
	if ($numero_de_notificaciones == 0){
		echo '<div class="alert alert-info"><b>No hay notificaciones</b></div>';
	
	}else{
		$stmt2 = $conn->prepare("SELECT * FROM notificaciones INNER JOIN (SELECT user_casa FROM casas_usuarios WHERE user_usuario = :usuario) AS casas_registradas ON notificaciones.user_casa = casas_registradas.user_casa WHERE rebizado = false ORDER BY fecha DESC;");
		$stmt2->bindParam(':usuario',$usuario);
		$stmt2->execute();
		$contador_notificaciones = 0;
		while (($row2 = $stmt2->fetch())){
				if ($row2['tipo']== 1){
					echo '<div class="alert alert-success"><b>'.$row2['user_casa'].' </b>'.$row2['fecha'].':'.$row2['notificacion'].'</div>';
				}else 
				if ($row2['tipo']== 2){
					echo '<div class="alert alert-warning"><b>'.$row2['user_casa'].'</b>'.$row2['fecha'].':'.$row2['notificacion'].'</div>';
				}else 
				if ($row2['tipo']== 3){
					echo '<div class="alert alert-danger"><b>'.$row2['user_casa'].'</b>'.$row2['fecha'].':'.$row2['notificacion'].'</div>';
				}
				$contador_notificaciones ++;
		}
		if ($contador_notificaciones == 0){
			echo '<div class="alert alert-info"><b>No nuevas hay notificaciones</b></div>';
		}
		
		$minimo_de_notificaciones = 15;
		if ($contador_notificaciones < $minimo_de_notificaciones){
			$stmt3 = $conn->prepare("SELECT * FROM notificaciones INNER JOIN (SELECT user_casa FROM casas_usuarios WHERE user_usuario = :usuario) AS casas_registradas ON notificaciones.user_casa = casas_registradas.user_casa WHERE rebizado = true ORDER BY fecha DESC;");
			$stmt3->bindParam(':usuario',$usuario);
			$stmt3->execute();

			while (($row3 = $stmt3->fetch())){
					if ($row3['tipo']== 1){
						echo '<div class="alert alert-success"><b>'.$row3['user_casa'].' </b>'.$row3['fecha'].':'.$row3['notificacion'].'</div>';
					}else 
					if ($row3['tipo']== 2){
						echo '<div class="alert alert-warning"><b>'.$row3['user_casa'].' </b>'.$row3['fecha'].':'.$row3['notificacion'].'</div>';
					}else 
					if ($row3['tipo']== 3){
						echo '<div class="alert alert-danger"><b>'.$row3['user_casa'].' </b>'.$row3['fecha'].':'.$row3['notificacion'].'</div>';
					}
			}
		}
		$stmt4 = $conn->prepare("UPDATE notificaciones set rebizado= true WHERE user_casa IN (select user_casa from casas_usuarios where user_usuario = :usuario);");
		$stmt4->bindParam(':usuario',$usuario);
		$stmt4->execute();
	}
	
}
?>