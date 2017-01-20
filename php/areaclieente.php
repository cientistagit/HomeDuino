<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="home" content="">

    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <?php
  session_start();
  echo $_SESSION['usuario']."  - estoy adentro";
  $nombre_usuario = $_SESSION['usuario'];
  $usuario_bd = 'root';
$passwd_bd = '';
try {
//	print "Conectando";
    $conn = new PDO('mysql:host=localhost;dbname=dbapinet;charset=utf8', $usuario_bd, $passwd_bd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

$stmt = $conn->prepare("SELECT * FROM datos_usuario WHERE user = :usuario");
$stmt->bindParam(':usuario',$nombre_usuario);
$stmt->execute();
if($row = $stmt->fetch()){
echo "<table border = \"1\"> \n";
		echo "<tr>";
		echo "<td> User: </td>";
		echo "<td> ".$row['user']." </td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Nombre: </td>";
		echo "<td> ".$row['nombre']." </td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> email: </td>";
		echo "<td> ".$row['email']." </td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td> Foto: </td>";
		echo '<td> <img src="Imagesuser/'.$row['imagen'].'" alt="Foto usuario"/> </td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td> genero: </td>";
		echo "<td> ".$row['genero']." </td>";
		echo "</tr>";
	echo "</table>";
	}
	?>
  <div id="login" align="left">
			<p>Bienvenido<b>
			<?php echo $_SESSION['usuario']; ?></b>
			</p> 
			</div>
	
  
  </body>
</html>
