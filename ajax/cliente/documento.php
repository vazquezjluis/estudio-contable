<?php 
    /* Connect To Database*/
	require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos

	/** INICIO DEL PROCESO DE IMPORTACION DEL EXCEL */
    require_once ("../../funciones.php");
	extract($_POST);
	if (isset($_POST['action'])) {
		$action=$_POST['action'];
	}
	
	if (isset($action)== "upload"){
        if (isset($_POST['tipo_documento'])){
            //cargamos el fichero
			$archivo = $_FILES['pdf']['name'];
			$tipo = $_FILES['pdf']['type'];
			
            $extencion = explode(".",$archivo);
			if ($extencion[1]!='pdf' AND $extencion[1]!='pdf' ){
					$errors[] = "Error el archivo que intenta subir no es un PDF. <br>";
			}else{
					$destino = "../../documentos/".$_POST['tipo_documento']."_".$_POST['doc_cliente'].".".$extencion[1];//Le agregamos un prefijo para identificarlo el archivo cargado
					if (copy($_FILES['pdf']['tmp_name'],$destino)) {
                            $messages[] = "Documento Cargado Con Éxito";
                            /**
                             * Carga de la ruta en la BASE DE DATOS
                             */
                            //Elimina la ruta anterior
                            $sql_delete = "DELETE FROM documentos WHERE cliente = ".$_POST['doc_cliente']." AND tipo = ".$_POST['tipo_documento'];
                            mysqli_query($con, $sql_delete);
                            $ruta = "documentos/".$_POST['tipo_documento']."_".$_POST['doc_cliente'].".".$extencion[1];
                            $sql = " INSERT into documentos (cliente, tipo, ruta,fecha) VALUES (".$_POST['doc_cliente'].",".$_POST['tipo_documento'].",'".$ruta."', '".date('Y-m-d')."') ";  
                            
                            $result =  mysqli_query($con, $sql);

                            // Si el documento es una liquidacion entonces envia un mensaje al cliente
                            // al sistema y al correo electronico
                            if ($_POST['tipo_documento']){
                                $sql_cliente    = " SELECT * FROM clientes WHERE id_cliente =".$_POST['doc_cliente'];
                                $query_cliente  =  mysqli_query($con, $sql_cliente);
                                $asunto         = 'Nuevo documento de Liquidacion de ingresos Brutos disponible';
                                $mensaje        = '<p> Ingresa al sistema para descargar el documento haciendo <a href="https://www.control-app.com/desarrollos/estudio-contable"> Click aquí!</p>';
                                
                                while ($row=mysqli_fetch_array($query_cliente)){
                                    if ($row['email_cliente']!=''){
                                                                    // Varios destinatarios
                                                //$para  = 'vazquezjluis@yahoo.com' . ', '; // atención a la coma
                                                $para = $row['email_cliente'];

                                                // título
                                                $título = $asunto;

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
                                                    <p>Saludos, tu contador!</p>
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
                                    }else{
                                        $errors[] = "Documento cargado! Este cliente no tiene cargado el Email por lo tanto no hemos
                                             podido avisarle sobre la nueva liquidacion. Para notificarle cárgale un email y vuelve a subir el documento. <br>";
                                    }
                                }

                                
                                $visto          =0;
                                $prioridad      =1;
                                $estado         =1;
                                $fecha          =date('Y-m-d h:i:s');
                                $destino        ="cliente";
                                $sql_mensaje    ="INSERT INTO mensajes (destino, cliente, visto, mensaje, prioridad, estado, fecha,asunto) VALUES ('".$destino."','".$_POST['doc_cliente']."','".$visto."','Liquidacion nueva','".$prioridad."','".$estado."','".$fecha."' , '".$asunto."')";
                                
                                $query_new_insert = mysqli_query($con,$sql_mensaje);
                                
                            }
                            
                            
					}else {
							$errors[] = "Error al cargar el archivo. <br>";
					}
			
            }
        }else{
            $errors[] = "Debe seleccionar el tipo de documento.";
        }
			
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
                    <strong>¡Listo!</strong>
                    <?php
                        foreach ($messages as $message) {
                                echo $message;
                            }
                        ?>
            </div>
            <?php
        }

?>