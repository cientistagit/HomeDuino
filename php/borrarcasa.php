<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  //readfile('login.html');
   header('location:../index.php');
  // exit();
}else{
$user = $_SESSION['usuario'];
$user_casa = $_GET['user_casa'];
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
	$stmt = $conn->prepare("DELETE FROM casas_usuarios WHERE user_usuario = :user AND user_casa= :usercasa");
	$stmt->bindParam(':usercasa',$user_casa);
	$stmt->bindParam(':user',$user);
	$stmt->execute();
}


?>
