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
                            $messages[] = "Archivo Cargado Con Éxito";
                            /**
                             * Carga de la ruta en la BASE DE DATOS
                             */
                            //Elimina la ruta anterior
                            $sql_delete = "DELETE FROM documentos WHERE cliente = ".$_POST['doc_cliente']." AND tipo = ".$_POST['tipo_documento'];
                            mysqli_query($con, $sql_delete);
                            $ruta = "documentos/".$_POST['tipo_documento']."_".$_POST['doc_cliente'].".".$extencion[1];
                            $sql = " INSERT into documentos (cliente, tipo, ruta,fecha) VALUES (".$_POST['doc_cliente'].",".$_POST['tipo_documento'].",'".$ruta."', '".date('Y-m-d')."') ";  
                            
                            $result =  mysqli_query($con, $sql);
                            
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