<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  //readfile('login.html');
   header('location:../index.php');
  // exit();
}else{
$user = $_SESSION['usuario'];
$user_casa = $_GET['user_casa'];
$pass_casa = $_GET['pass_casa'];
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
	$stmt = $conn->prepare("SELECT * FROM casas WHERE user = :usercasa AND pass= :passcasa");
	$stmt->bindParam(':usercasa',$user_casa);
	$stmt->bindParam(':passcasa',$pass_casa);
	$stmt->execute();
	if($row = $stmt->fetch()){
		$stmt = $conn->prepare("SELECT * FROM casas_usuarios WHERE user_casa = :usercasa AND user_usuario= :user");
		$stmt->bindParam(':usercasa',$user_casa);
		$stmt->bindParam(':user',$user);
		$stmt->execute();
		if($row = $stmt->fetch()){
			echo 'repeat';
		}else{
			$stmt = $conn->prepare("INSERT INTO casas_usuarios VALUES (:userusuario , :usercasa)");
			$stmt->bindParam(':usercasa',$user_casa);
			$stmt->bindParam(':userusuario',$user);
			$stmt->execute();		
			echo 'ok';
		}	
	}else{
		echo 'error';
	}	

}


?>
