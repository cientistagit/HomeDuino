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
	$stmt = $conn->prepare("SELECT * FROM casas_usuarios WHERE user_usuario = :usuario ");
	$stmt->bindParam(':usuario',$usuario);
	$stmt->execute();

	while($row = $stmt->fetch()){
			echo "<div class=".'"'."alert alert-success".'"'."><b>Casa Gestionada :  
					<span class=".'"'."label label-default".'"'.">".$row['user_casa']."</span>".'<button class="btn btn-success btn-xs btn-flat" onclick="borrarCasa('."'".$row['user_casa']."'".')">        Borrar Casa
			</button></br>'."
			</div>";
		//echo "Casa:".$row['user_casa'].'<button onclick="borrarCasa('."'".$row['user_casa']."'".')">Borrar</button></br>';
	}
	echo '<span class="label label-primary">Usuario Casa</span> <input type="text" id="user_casa" >';
	echo '   <span class="label label-primary">Password Casa</span> <input type="password" id="pass_casa">';
	//echo "<a href=''>Agregar Casa</a></br>";
	echo '         <button onclick="agregarCasa()" class="btn btn-success btn-sm">Agregar Casa</button>';
}
?>
