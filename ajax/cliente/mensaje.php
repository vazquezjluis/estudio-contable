
<?php
    //error_reporting(E_ALL & ~E_DEPRECATED);
    include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
    /*Inicia validacion del lado del servidor*/

	if (empty($_POST['mensaje'])) {
           $errors[] = "mensaje vacío";
        } 
    else if (empty($_POST['asunto'])){
        $errors[] = "asunto vacío";
    }
    else{    
        if (empty($_POST['prioridad'])){$_POST['prioridad']=0;}
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
                    $sql_cliente = " SELECT * FROM clientes WHERE id_cliente = ".$cliente;
                    $get_cliente = mysqli_query($con,$sql_cliente);
                    $nombre = '';
                    $correo = '';
                    while ($row=mysqli_fetch_array($get_cliente)){
                        $nombre     =$row['nombre_cliente']; 
                        $correo     =$row['email_cliente']; 
                        $telefono   =$row['telefono_cliente']; 
                    }
                    if (empty(trim($nombre))){ $nombre ='Anonimo';}
                    if (empty(trim($correo))){ $correo =' El usuario no tiene cargado un correo.';}
                    if (empty(trim($telefono))){ $telefono ='El usuario no tiene cargado un telefono.';}

                    // Varios destinatarios
                    $para  = 'vazquezjluis@yahoo.com' . ', '; // atención a la coma
                    $para .= 'schumachercristian@gmail.com';

                    // título
                    $título = 'Mensaje del cliente '.$nombre;

                    // mensaje
                    $menssage = '
                    <html>
                    <head>
                        <title>Enviado desde el sistema contable</title>
                    </head>
                    <body>
                        <p><b>'.$asunto.'</b></p>
                        <p><i>'.$mensaje.'</i></p>
                        <br>
                        <p>'.$nombre.'</p><p>'.$correo.'</p><p>'.$telefono.'</p>
                        <hr>
                        <table>
                            <tr>
                                <td>By J.L.Vazquez - <a href="https://www.control-app.com "><b> Control-App.com</b></a></td>
                            </tr>
                        </table>
                    </body>
                    </html>
                    ';

                    // Para enviar un correo HTML, debe establecerse la cabecera Content-type
                    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    // Cabeceras adicionales
                    //$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
                    $cabeceras .= 'From: Control-App <info@control-app.com>' . "\r\n";
                    // $cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
                    // $cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";


                    //envia el mensaje
                    mail($para, $título, $menssage, $cabeceras);

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