<?php
	include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['nombre'])){
		/* Connect To Database*/
		require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$categoria=mysqli_real_escape_string($con,(strip_tags($_POST["categoria"],ENT_QUOTES)));
		$condicion_iva=mysqli_real_escape_string($con,(strip_tags($_POST["condicion"],ENT_QUOTES)));
		$cuit=mysqli_real_escape_string($con,(strip_tags($_POST["cuit"],ENT_QUOTES)));
		$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
		$clave=mysqli_real_escape_string($con,(strip_tags($_POST["clave"],ENT_QUOTES)));
		$honorario=mysqli_real_escape_string($con,(strip_tags($_POST["honorario"],ENT_QUOTES)));
		$actividad=mysqli_real_escape_string($con,(strip_tags($_POST["actividad"],ENT_QUOTES)));
		//$estado=intval($_POST['estado']);
		$date_added=mysqli_real_escape_string($con,(strip_tags($_POST["date_added"],ENT_QUOTES)));
		
		$sql="INSERT INTO clientes (
			nombre_cliente, 
			telefono_cliente,
		 	email_cliente, 
		 	direccion_cliente, 
		 	status_cliente,
		  	date_added, 
		  	categoria, 
		  	cuit, 
			usuario,
		   	clave, 
		   	honorario,
			condicion_iva,
			actividad) VALUES (
				'$nombre',
		   		'$telefono',
		   		'$email',
		   		'$direccion',
		   		1,
		   		'$date_added',
		   		'$categoria',
		   		'$cuit',
		   		'$usuario',
				'$clave',
				'$honorario',
				'$condicion_iva', 
				'$actividad'
				)";

		$query_new_insert = mysqli_query($con,$sql);

		$sql2="SELECT max(clientes.id_cliente) as id FROM clientes LIMIT 1";
		
		$query_select = mysqli_query($con,$sql2);	
		$row= mysqli_fetch_array($query_select );
		$id_insert = $row['id'];


		if ($query_new_insert){
				$sql3="	INSERT INTO movimientos (cliente,movimiento,anio) VALUES ('$id_insert', 'ingresos', ".Date('Y').") ";
				$sql4=" INSERT INTO movimientos (cliente,movimiento,anio) VALUES ('$id_insert', 'egresos', ".Date('Y').") ";
				$sql5="	INSERT INTO movimientos (cliente,movimiento,anio) VALUES ('$id_insert', 'ingresos', ".(string)(Date('Y')-1).") ";
				$sql6=" INSERT INTO movimientos (cliente,movimiento,anio) VALUES ('$id_insert', 'egresos', ".(string)(Date('Y')-1).") ";
				$query_new_insert3 = mysqli_query($con,$sql3);
				$query_new_insert4 = mysqli_query($con,$sql4);
				$query_new_insert5 = mysqli_query($con,$sql5);
				$query_new_insert6 = mysqli_query($con,$sql6);
				if ($query_new_insert3 and $query_new_insert4 and $query_new_insert5 and $query_new_insert6 ){
					$messages[] = "Cliente cargado.";
				}else{
					$errors []= "Ocurrio un error al intentar guardar el movimiento inicial.".mysqli_error($con);	
				}
				
			} else{
				$errors []= "Ocurrio un error al intentar guardar los datos.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>