<?php
include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=vencimientos.xls');
// Crear nuevo objeto PHPExcel


/*Extraer datos de MYSQL*/
$mes = (int)substr(date('m'), -1)-1;
	$sql="SELECT
                nombre_cliente,
                cuit,
                STR_TO_DATE(vl.Anticipo".$mes.",'%d/%m/%Y') AS vencimiento, 'IIBB' as tipo
            FROM
                clientes
            INNER JOIN vencimientosiibblocales AS vl ON vl.TerminacionCUIT = SUBSTRING(cuit ,- 1)

            UNION

            SELECT
                nombre_cliente,
                cuit,
                fm.fecha AS vencimiento, 'Monotributo' as tipo
            FROM
                clientes
				INNER JOIN (select * from fechamonotributo ORDER BY id_fechamonotributo DESC LIMIT 1 )AS fm
            ORDER BY
                vencimiento asc";

	$query=mysqli_query($con,$sql);

?>


    <table border="1"  style="font-size:20px;">
				<tr>
					<th>Cliente</th>
					<th>Cuit</th>
					<th>Vencimiento</th>
					<th>Tipo</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){



					?>
					<tr>
						<td style="padding:20px;"><?php echo $row['nombre_cliente']; ?></td>
						<td style="padding:20px;"><?php echo $row['cuit']; ?></td>
						<td style="padding:20px;"><?php
						
						$date=date_create($row['vencimiento']);
						echo date_format($date,"d/m/Y");
						
						 ?></td>
						<td style="padding:20px;"><?php echo $row['tipo']; ?></td>
						
					</tr>
					<?php
				}
				?>
			  </table>

