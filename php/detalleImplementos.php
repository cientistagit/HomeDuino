<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  //readfile('login.html');
   header('location:../index.php');
  // exit();
}else{

$usercasa = $_GET['user_casa'];

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
	$stmt = $conn->prepare("SELECT * FROM implementos_casa WHERE user_casa = :usercasa ");
	$stmt->bindParam(':usercasa',$usercasa);
	$stmt->execute();
	if ($row = $stmt->fetch()){
	echo '
		<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn donut-chart">
                      			<div class="white-header">
						  			<h5>';
						echo $row['nombre'];
						echo '</h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-cloud"></i>';
						echo $row['estado']."%";
						echo '</p>
									</div>
	                      		</div>
								<div class="centered">
										<img src="Imagenes/weather.png" width="120">
	                      		</div>
								
	                      	</div> <!--/grey-panel -->
                      	</div><!-- /col-md-4-->
	';
	}
	
	if($row = $stmt->fetch()){
	echo '
		<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn donut-chart">
                      			<div class="white-header">
						  			<h5>';
							echo $row['nombre'];
							echo '</h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-fire"></i>';
							echo $row['estado']."°";
							echo '</p>
									</div>
	                      		</div>
								<div class="centered">
										<img src="Imagenes/temperature.png" width="120">
	                      		</div>
	                      	</div><!--/grey-panel -->
                      	</div><!-- /col-md-4--> 
	';
	}
	if($row = $stmt->fetch()){
	echo '
		<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn donut-chart">
                      			<div class="white-header">
						  			<h5>';
							echo $row['nombre']." Comedor";
							echo '</h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-fire"></i>';
							echo $row['estado'];
							echo '</p>
									</div>
	                      		</div>
								<div class="centered">';
								if($row['estado'] < 250){
									echo'<img src="Imagenes/light-off.png" width="120">';}
								else {
									echo '<img src="Imagenes/light-on.png" width="120">';}
	                      	echo'	</div>
	                      	</div><!--/grey-panel -->
                      	</div><!-- /col-md-4--> 
	';
	}
	if($row = $stmt->fetch()){
	echo '
		<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn donut-chart">
                      			<div class="white-header">
						  			<h5>';
							echo $row['nombre']." Pieza";
							echo '</h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-fire"></i>';
							echo $row['estado'];
							echo '</p>
									</div>
	                      		</div>
								<div class="centered">';
								if($row['estado'] < 250){
									echo'<img src="Imagenes/light-off.png" width="120">';}
								else {
									echo '<img src="Imagenes/light-on.png" width="120">';}
	                      	echo'	</div>
	                      	</div><!--/grey-panel -->
                      	</div><!-- /col-md-4--> 
	';
	}
	//while($row = $stmt->fetch()){
	//	echo "<tr><p>";
	//	echo $row['nombre']." = ".$row['estado'];
	//	echo "</p></tr>";
	//}
	
}
?>
