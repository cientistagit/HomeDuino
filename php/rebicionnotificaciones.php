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
	$stmt = $conn->prepare("SELECT COUNT(*) numero_de_notificaciones FROM notificaciones INNER JOIN (SELECT user_casa FROM casas_usuarios WHERE user_usuario = :usuario) AS casas_registradas ON notificaciones.user_casa = casas_registradas.user_casa WHERE rebizado = false;");
	$stmt->bindParam(':usuario',$usuario);
	$stmt->execute();
	
	if($row = $stmt->fetch()){
		echo ''.$row['numero_de_notificaciones'];
	}
}
?>