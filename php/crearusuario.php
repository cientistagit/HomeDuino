<?php 
$nombre_usuario = $_POST["nombre_user"];
$nombre_completo = $_POST["nombre"];
$contrasena_usuario = $_POST["contrasena"];
$email_usuario = $_POST["user_email"];
$genero_usuario = $_POST["genero"];
$flag = true;

if( move_uploaded_file($_FILES['foto']['tmp_name'],'../Imagesuser/'.$_FILES['foto']['name'])){
chmod('../Imagesuser/'.$_FILES['foto']['name'],0777);
$imagen_usuario = $_FILES['foto']['name'];
}
else{
 echo 'Error al subir la imagen';
}

//if ($nombre_usuario == '' || $contrasena_usuario == ''){
//	echo 'Uno o varios campos estan en blanco<br>';
//	$flag = false;
//}
//if ($contrasena_usuario != $_POST["contrasena_repeat"]){
//	echo 'No Concuerda la contrase&ntildea <br>';
//	$flag = false;
//}
//if ($flag){ 
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
		die("nooo");
	}
	//Consulta existencia de usuario
	//$stmt = $conn->prepare("SELECT * FROM usuarios WHERE user = :nombre_user");
	//$stmt->bindParam(':nombre_user',$nombre_usuario);
	//$stmt->execute();	
	//if($row = $stmt->fetch()){
	//	echo 'El usuario ya esta creado <br>';
	//	$flag = false;
	//}else{
		$stmt = $conn->prepare("INSERT INTO usuarios VALUES ( :nombre_user , :contrasena);");
		$stmt->bindParam(':nombre_user',$nombre_usuario);
		$stmt->bindParam(':contrasena',$contrasena_usuario);
		$stmt->execute();

		$stmt = $conn->prepare("INSERT INTO datos_usuario VALUES ( :nombre , :nombre_user ,:user_email , :genero , :foto );");
		$stmt->bindParam(':nombre',$nombre_completo);
		$stmt->bindParam(':nombre_user',$nombre_usuario);
		$stmt->bindParam(':user_email',$email_usuario);
		$stmt->bindParam(':genero',$genero_usuario);
		$stmt->bindParam(':foto',$imagen_usuario);
		$stmt->execute();
		$flag = true;
	//}
//}
if ($flag){
	//echo 'El usuario fue creado correctamente';
	echo "<script languaje='javascript'>alert('Registro Exitoso'); location.href = '../home.php';</script>";
	$url_php = 'verificacionlogin.php?nombre_usuario='.$nombre_usuario.'&contrasena='.$contrasena_usuario;
	//header('location:'.$url_php);
}else{
	echo "<script languaje='javascript'>alert('Error al crear usuario'); location.href = '../form.php';</script>";
	//echo 'Error en la creaci&oacuten de usuario, <a href="form.php">volver al registro</a>';
}
?>
