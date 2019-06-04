
<?php
    error_reporting(E_ALL & ~E_DEPRECATED);
    include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    /*Inicia validacion del lado del servidor*/

	if (empty($_POST['mensaje'])) {
           $errors[] = "mensaje vacío";
        } 
    else if (empty($_POST['asunto'])){
        $errors[] = "asunto vacío";
    }
    else{    
		/* Connect To Database*/
		require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$mensaje=mysqli_real_escape_string($con,(strip_tags($_POST["mensaje"],ENT_QUOTES)));
		$destino=mysqli_real_escape_string($con,(strip_tags($_POST["destino"],ENT_QUOTES)));
		$asunto =mysqli_real_escape_string($con,(strip_tags($_POST["asunto"],ENT_QUOTES)));
		$cliente=intval($_POST['mensaje_cliente']);
		$visto=0;
		$prioridad=intval($_POST['prioridad']);
		$estado=intval($_POST['estado']);
		$fecha=mysqli_real_escape_string($con,(strip_tags(date('Y-m-d h:i:s'),ENT_QUOTES)));
		
		$sql="INSERT INTO mensajes (destino, cliente, visto, mensaje, prioridad, estado, fecha,asunto) VALUES ('".$destino."','".$cliente."','".$visto."',  '".$mensaje."','".$prioridad."','".$estado."','".$fecha."' , '".$asunto."')";
          
		$query_new_insert = mysqli_query($con,$sql);

		if ($query_new_insert){
                $messages[] = "El mensaje ha sido enviado al contador.";
                if (isset($_POST['send'])){
                    include("../../classes/sendemail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico
                    
                    $sql_cliente = " SELECT * FROM clientes WHERE id_cliente = ".$_POST['cliente'];
                    $get_cliente = mysqli_query($con,$sql_cliente);
                    $nombre = '';
                    $correo = '';
                    while ($row=mysqli_fetch_array($get_cliente)){
                        $nombre =$row['nombre_cliente']; 
                        $correo =$row['email_cliente']; 
                    }
                    if (empty(trim($nombre))){ $nombre ='Anonimo';}
                    if (empty(trim($correo))){ $correo ='anonimo@anonimo.com';}
                    /*Configuracion de variables para enviar el correo*/
                    $mail_username="jvazquez.jlv@gmail.com";//Correo electronico saliente ejemplo: tucorreo@gmail.com
                    $mail_userpassword="notecomasalgato";//Tu contraseña de gmail
                    $mail_addAddress="vazquezjluis@yahoo.com";//correo electronico que recibira el mensaje
                    $template="email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje
                    
                    /*Inicio captura de datos enviados por $_POST para enviar el correo */
                    $mail_setFromEmail=$correo;
                    $mail_setFromName=$nombre;
                    $txt_message=$mensaje;
                    $mail_subject=$asunto;
                    
                    sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template);//Enviar el mensaje
                }
        } else{
            $errors []= "Ocurrio un error al intentar guardar el mensaje.".mysqli_error($con);
        }
		
		if (isset($errors)){
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php foreach ($errors as $error) { echo $error; } ?>
			</div>
			<?php
			}
        if (isset($messages)){
            
            ?>
            <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Mensaje enviado!</strong>
                    <?php foreach ($messages as $message) {echo $message;} ?>
            </div>
            <?php
        }
    }
?>