<?php
		error_reporting(0);
        session_start();
        if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
            header("location: login.php");
            exit;
            }
        
        $active_categorias="";
        $active_clientes="";
        $active_usuarios="";	
        $active_vencimientos="active";	
        $title="Vencimientos - OLIMPUS";
    
        /* Connect To Database*/
        require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
        require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
    
        /** INICIO DEL PROCESO DE IMPORTACION DEL EXCEL */
        require_once ("funciones.php");
        extract($_POST);
        if (isset($_POST['action'])) {
            $action=$_POST['action'];
        }
        
        // if (isset($action)== "upload"){
        //         //cargamos el fichero
        //         $archivo = $_FILES['excel']['name'];
        //         $tipo = $_FILES['excel']['type'];
                
        //         $extencion = explode(".",$archivo);
        //         if ($extencion[1]!='xlsx' AND $extencion[1]!='xls' ){
        //                 $error[] = "Error el archivo que intenta subir no es un Excel. <br>";
        //         }else{
        //                 $destino = "importados/imp_".Date('Ymd')."_".$archivo;//Le agregamos un prefijo para identificarlo el archivo cargado
        //                 if (copy($_FILES['excel']['tmp_name'],$destino)) {
        //                         //$mensaje = "Archivo Cargado Con Éxito";
        //                 }else {
        //                         $error[] = "Error al cargar el archivo. <br>";
        //                 }
                
        //                 if (file_exists ($destino)){ 
        //                         // Llamamos las clases necesarias PHPEcel 
        //                         require_once('classes/PHPExcel.php');
        //                         require_once('classes/PHPExcel/Reader/Excel2007.php');					
        //                         // Cargando la hoja de excel
        //                         $objReader = new PHPExcel_Reader_Excel2007();
        //                         $objPHPExcel = $objReader->load($destino);
        //                         $objFecha = new PHPExcel_Shared_Date();       
        //                         // Asignamon la hoja de excel activa
        //                         if($objPHPExcel->setActiveSheetIndex(0)=="error"){
        //                             $error[] = "Error en la hoja activa el archivo";
        //                         }else {
                        
        //                             // Rellenamos el arreglo con los datos  del archivo xlsx que ha sido subido
                                    
        //                             $columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
        //                             $filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        //                             // valida el excel de categorias
        //                             if ($columnas!="M" and $filas!="11"){
        //                                 $error[]="Error hay columnas o filas de mas o de menos y asegurese de que los datos esten el la hoja 1 ";
        //                             }else{
        //                                         //Creamos un array con todos los datos del Excel importado
        //                                             for ($i=3;$i<=$filas;$i++){
    
        //                                                     $_DATOS_EXCEL[$i]['categoria'] 				= $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['ingresos_brutos'] 	= $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['actividad']				= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['can_min_emp']			= $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['sup_afe'] 					= $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['ene_ele_con_anual']= $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['alq_dev_anual'] 		= $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['pres_serv'] 				= $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['ven_cos_muebles'] 	= $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['aporte_sipa'] 			= $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['aporte_os'] 				= $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['t_pres_serv'] 			= $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
        //                                                     $_DATOS_EXCEL[$i]['t_ven_cos_muebles']= $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
                                                            
        //                                             }//fin del for
        //                                             //elimino los datos anteriores
        //                                             $sql_delete = "DELETE FROM categorias";
        //                                             mysqli_query($con,$sql_delete);	
        //                                             //guardo los nuevos datos
        //                                             foreach($_DATOS_EXCEL as $campo => $valor){
        //                                                 $sql = "INSERT INTO categorias  (
        //                                                         categoria,
        //                                                         ingresos_brutos,
        //                                                         actividad,
        //                                                         can_min_emp,
        //                                                         sup_afe,
        //                                                         ene_ele_con_anual,
        //                                                         alq_dev_anual,
        //                                                         pres_serv,
        //                                                         ven_cos_muebles,
        //                                                         aporte_sipa,
        //                                                         aporte_os,
        //                                                         t_pres_serv,
        //                                                         t_ven_cos_muebles)  VALUES ('";
        //                                                     foreach ($valor as $campo2 => $valor2){
        //                                                         $campo2 == "t_ven_cos_muebles" ? $sql.= $valor2."');" : $sql.= $valor2."','";
        //                                                     }
                                    
        //                                                     $result = mysqli_query($con,$sql);
        //                                                     if (!$result){ 
        //                                                             echo "Error al insertar registro ".$campo;$errores+=1;
        //                                                     }
                        
        //                                             }	
        //                                         echo  "<script> alert('Archivo miportado con éxito.')</script>";	
        //                                         header("Location: categorias.php");
        //                             }
        //                         }
                                
        //                     }	//fin del file_exist...
        //                     //para evitar recargar el POST
        //             }//fin da la validacion de la extencion .xls .xlsx
            
                
        // }
    
        if (isset($_POST['enviar']) and $_POST['fecha']!='' and $_POST['fecha']!=null){
            $sql_insert_fecha = "INSERT INTO fechamonotributo (fecha) values ('".$_POST['fecha']."')";
            

            mysqli_query($con,$sql_insert_fecha);
            header("Location: vencimientos.php");
        }

        $sql_ven_monotributo = "SELECT * FROM fechamonotributo order by id_fechamonotributo DESC limit 1";
        $fecha = mysqli_query($con,$sql_ven_monotributo);
        $fecha_monotributo= mysqli_fetch_array($fecha);
        

    
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
            <?php include("head.php");?>
      </head>
      <body>
        <?php 	include("navbar.php"); ?>  
        <div class="container">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <div class="btn-group pull-right">
                            
                             <form class="form-inline" name="fecha" method="post" action="" enctype="multipart/form-data" >
                        
                                <div class="form-group">
                                <label> Vencimiento de Monotributo:</label>
                                    <input type="date" name="fecha" value="<?php echo $fecha_monotributo['fecha'];?>"/>
                                </div>
                                <input class="btn btn-primary btn-file" type='submit' name='enviar'  value="Actualizar"  />
                        
    
                            </form> 
                            <!-- <a  href="nueva_categoria.php" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Factura</a> -->
                        </div>
                        <h4> Clientes </h4>
                        <?php if(isset($error)){ ?>
                            <div class="alert alert-danger" role="alert">
                            <?php 							
                                    foreach($error as $e){
                                        echo $e;
                                    }
                            ?>
                            </div>
                            <?php }
                            
    
                            ?>
                    </div>
                    <div class="panel-body">
                    </div>	
                    <div id="resultados"></div><!-- Carga los datos ajax -->
                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                </div>	
            </div>
        <hr>
        <?php include("footer.php"); ?>
        <script type="text/javascript" src="js/vencimientos.js"></script>
      </body>
    </html>