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
	$numero_de_notificaciones;
	if($row = $stmt->fetch()){
		$numero_de_notificaciones  = $row['numero_de_notificaciones'];
	}
	
	$stmt2 = $conn->prepare("SELECT notificaciones.user_casa, notificacion, tipo FROM notificaciones INNER JOIN (SELECT user_casa FROM casas_usuarios WHERE user_usuario = :usuario) AS casas_registradas ON notificaciones.user_casa = casas_registradas.user_casa WHERE rebizado = false ORDER BY fecha DESC;");
	$stmt2->bindParam(':usuario',$usuario);
	$stmt2->execute();
	//seccion uno 
	?>


                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
							<?php
                                echo '<p class="green">Tienes '.$numero_de_notificaciones.' notificaciones sin ver</p>';
                            ?>
							</li>
	
	<?php
	
	$max_notificaciones = 5;
	$contador_notificaciones = 0;
	while (($contador_notificaciones < $max_notificaciones) && ($row2 = $stmt2->fetch())){
		
		echo 
			'<li>
				<a>';
			if ($row2['tipo']== 1){
				echo '<span class="photo"><img width="30" height="30"  src="Imagenes/ok.jpg"></span>';
			}else 
			if ($row2['tipo']== 2){
				echo '<span class="photo"><img width="30" height="30" src="Imagenes/alerta.jpg"></span>';
			}else 
			if ($row2['tipo']== 3){
				echo '<span class="photo"><img width="30" height="30" src="Imagenes/critico.jpg"></span>';
			}
		echo '<span class="subject">
					<span class="from">'.$row2['user_casa'].'</span>
					</span>
					<span class="message">
					 '.$row2['notificacion'].'
					</span>
				</a>
			</li>';
			
			
			/*
			'<li><a>'.
				'<div class="task-info">'.
					'<div class="desc">'.$row2['notificacion'].'</div>'.
				'</div>'.
			 '</a></li>';
		*/
		$contador_notificaciones ++;
	}
	
	if ($contador_notificaciones < $max_notificaciones){
		$stmt3 = $conn->prepare("SELECT notificaciones.user_casa, notificacion, tipo FROM notificaciones INNER JOIN (SELECT user_casa FROM casas_usuarios WHERE user_usuario = :usuario) AS casas_registradas ON notificaciones.user_casa = casas_registradas.user_casa WHERE rebizado = true ORDER BY fecha DESC;");
		$stmt3->bindParam(':usuario',$usuario);
		$stmt3->execute();
		while (($contador_notificaciones < $max_notificaciones) && ($row3 = $stmt3->fetch())){
			echo 
				'<li>
					<a>';
				if ($row3['tipo']== 1){
					echo '<span class="photo"><img width="30" height="30"  src="Imagenes/ok.jpg"></span>';
				}else 
				if ($row3['tipo']== 2){
					echo '<span class="photo"><img width="30" height="30" src="Imagenes/alerta.jpg"></span>';
				}else 
				if ($row3['tipo']== 3){
					echo '<span class="photo"><img width="30" height="30" src="Imagenes/critico.jpg"></span>';
				}
			echo '<span class="subject">
						<span class="from">'.$row2['user_casa'].'</span>
						</span>
						<span class="message">
						 '.$row3['notificacion'].'
						</span>
					</a>
				</li>';
				
				
				/*
				'<li><a>'.
					'<div class="task-info">'.
						'<div class="desc">'.$row2['notificacion'].'</div>'.
					'</div>'.
				 '</a></li>';
			*/
			$contador_notificaciones ++;
		}
	}
}
?>


		<li class="external">
			<a onclick="mostrar_notificaciones()">Ver todas </a>
		</li>

		

		

<!-- settings end -->

