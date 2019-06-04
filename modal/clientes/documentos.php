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
			<form class="form-horizontal" method="post" id="guardar_documento" name="guardar_documento" enctype="multipart/form-data">
			 	
				<input type="hidden" name="doc_cliente" id="doc_cliente">
				<div id="doc_resultados_ajax"></div>
			  <div class="form-group form-group-sm">

				

					<label for="tipo_documento" class="col-sm-3 control-label">Tipo de Documento *</label>
					<div class="col-sm-8">
						<select class="form-control" id="tipo_documento" name="tipo_documento"  required>
							<option value="">-- Selecciones--</option>
							<option value="1">Inscripcion de Afip</option>
							<option value="2">Inscripcion de IIBB</option>
							<option value="3">Form. 960</option>
							<option value="4">Credencial de pago</option>							
						</select>
					</div>
			    </div>
					<div class="form-group form-group-sm">
						<label  class="col-sm-3 control-label">Documento</label>
						<div class="col-sm-8">
							<input type="file" class="filestyle" data-buttonText="Seleccione archivo " name="pdf" required>
							<input type="hidden" value="upload" name="action" />
						</div>
					</div>
		  	</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button class="btn btn-primary" type='submit' name="guardar_datos" id="guardar_datos"  value="Guardar archivo">Guardar</button>
				</div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>