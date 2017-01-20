<?php
sleep(1);
//include('crearusuario.php');
$usuario_bd = 'root';
$passwd_bd = '';
$nombre_bd = 'dbapinet';
	try {
		 $conn = new PDO('mysql:host=localhost;dbname='.$nombre_bd.';charset=utf8', $usuario_bd, $passwd_bd);
		 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
if($_REQUEST) {
    $username = $_REQUEST['nombre_user'];
	
	//Consulta existencia de usuario
	$stmt = $conn->prepare("SELECT * FROM usuarios WHERE user = '".$username."'");
	$stmt->bindParam(':nombre_user',$username);
	$stmt->execute();	
	if($row = $stmt->fetch())
		echo "<div style='color:red;'><img height='16' src='Imagenes/error.png'> Nombre de Usuario no disponible</div>";
		
	else
		echo "<div style='color:#04B431;'><img height='16' src='Imagenes/check.png'> Nombre de Usuario disponible</div>";
	
    //if(mysql_num_rows(@$results) > 0)
     //   echo '<div id="Error">Usuario ya existente</div>';
    //else
     //   echo '<div id="Success">Disponible</div>';
}
?>