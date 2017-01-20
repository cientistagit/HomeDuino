<?php
//$nombre_usuario = $_POST['nombre_usuario'];
//$contrasena_usuario = $_POST['contrasena_usuario'];

$nombre_usuario = $_GET['nombre_usuario'];
$contrasena_usuario = $_GET['contrasena'];
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
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE user = :usuario AND pass= :contrasena");
$stmt->bindParam(':usuario',$nombre_usuario);
$stmt->bindParam(':contrasena',$contrasena_usuario);
$stmt->execute();
if($row = $stmt->fetch()){
//asume un sólo usuario con el id dado
session_start();
$_SESSION['usuario'] = $nombre_usuario;
header('location:../home.php');
}else{
	echo "<script languaje='javascript'>alert('Error en ingreso de usuario'); location.href = '../index.php';</script>";
	//echo '<h1>Error en el ingreso de usuario</h1></br>';
	//echo '<a href="form.php">Vuelva a intentarlo</a>';
}
$conn = null;
?>
