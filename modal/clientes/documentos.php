<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoDocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo documento</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
			<div id="resultados_ajax"></div>


			  <div class="form-group form-group-sm">
					<label for="condicion" class="col-sm-3 control-label">Tipo de Documento *</label>
					<div class="col-sm-8">
						<select class="form-control" id="condicion" name="condicion"  required>
							<option value="">-- Selecciones--</option>
							<option value="1">Inscripcion de Afip</option>
							<option value="2">Inscripcion de IIBB</option>
							<option value="3">Form. 960</option>
							<option value="4">Credencial de pago</option>
							
						</select>
					</div>
			    </div>


			  <div class="form-group form-group-sm">
				<label for="telefono" class="col-sm-3 control-label">Documento</label>
				<div class="col-sm-8">
                    <input type="file" id="documento">
				</div>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>