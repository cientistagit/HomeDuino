<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  //readfile('login.html');
   header('location:../index.php');
  // exit();
}else{

?>
	<table width="760" border="0" cellpadding="0">
		<td>
			<tr>


<?php

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
//		echo "<a onclick=".'"'."mensaje('casa')".'"'.">".$row['user_casa']."</a></br>";
		echo "<div class=".'"'."alert alert-success".'"'."><b>Monitorizar Casa :
		<button class=".'"'."btn btn-success btn-sm".'"'." onclick=".'"'."detalleImplementos('".$row['user_casa']."')".'"'.">".$row['user_casa']."</button>
		</div>";
	}
?>
			</tr>
			<tr>
				<p id="implementos_casa"></p>
			</tr>
		</td>
	</table>
<?php	
}
?>
