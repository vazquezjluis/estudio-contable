<?php
	include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if ($_POST['mod_cuit']==""){
			$errors[] = "Cuit vacío";        
		}  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre']) 
		){
		/* Connect To Database*/
		require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($con,(strip_tags($_POST["mod_telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["mod_email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_direccion"],ENT_QUOTES)));
		$cuit=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cuit"],ENT_QUOTES)));
		//$estado=intval($_POST['mod_estado']);
		$categoria=mysqli_real_escape_string($con,(strip_tags($_POST["mod_categoria"],ENT_QUOTES)));
		$date_added=mysqli_real_escape_string($con,(strip_tags($_POST["mod_date_added"],ENT_QUOTES)));
		$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["mod_usuario"],ENT_QUOTES)));
		$clave=mysqli_real_escape_string($con,(strip_tags($_POST["mod_clave"],ENT_QUOTES)));
		$honorario=mysqli_real_escape_string($con,(strip_tags($_POST["mod_honorarios"],ENT_QUOTES)));
		$condicion_iva=mysqli_real_escape_string($con,(strip_tags($_POST["mod_condicion"],ENT_QUOTES)));
		
		
		$id_cliente=intval($_POST['mod_id']);
		$sql="UPDATE clientes SET nombre_cliente='".$nombre."', 
			telefono_cliente='".$telefono."', 
			email_cliente='".$email."', 
			direccion_cliente='".$direccion."', 
			cuit='".$cuit."' ,
			categoria='".$categoria."', 
			usuario='".$usuario."', 
			clave='".$clave."', 
			honorario='".$honorario."', 
			condicion_iva='".$condicion_iva."', 
			date_added='".$date_added."' 
		WHERE id_cliente='".$id_cliente."'";
		
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Cliente actualizado con éxito.";
			} else{
				$errors []= "Ocurrio un error al intentar guardar los datos. ".mysqli_error($con);
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
						<strong>¡Bien!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>