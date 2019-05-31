	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar cliente</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_cliente" name="editar_cliente">

			
			<div id="resultados_ajax2"></div>

			  <div class="form-group form-group-sm">
					<label for="mod_nombre" class="col-sm-3 control-label">Nombre/R. Social * </label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="mod_nombre" name="mod_nombre"  required>
						<input type="hidden" name="mod_id" id="mod_id">
					</div>
			  </div>

			  <div class="form-group form-group-sm">
					<label for="mod_cuit" class="col-sm-3 control-label">Cuit *</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="mod_cuit" name="mod_cuit"  required>
					</div>
			  </div>

			  <div class="form-group form-group-sm">
					<label for="mod_condicion" class="col-sm-3 control-label">Cond. ante el IVA *</label>
					<div class="col-sm-8">
						<select class="form-control condicion" id="mod_condicion" name="mod_condicion"  required>
							<option value="">-- Selecciones--</option>
							<option value="Monotributo">Monotributo</option>
							<option value="IVA Responsable no Inscripto">IVA Responsable no Inscripto</option>
							<option value="IVA Responsable Inscripto">IVA Responsable Inscripto</option>
							<option value="IVA no Responsable">IVA no Responsable</option>
							<option value="IVA Sujeto Exento">IVA Sujeto Exento</option>
						</select>
					</div>
				</div>

			  <div class="form-group form-group-sm" >
					<label for="mod_categoria" class="col-sm-3 control-label">Categoria *</label>
					<div class="col-sm-8">
					<input type="text" class="form-control" id="mod_categoria" value=" " name="mod_categoria"  required>
					</div>
				</div>

			  <div class="form-group form-group-sm">
					<label for="mod_date_added" class="col-sm-3 control-label">Fecha Inicio</label>
					<div class="col-sm-8">
						<input type="date" class="form-control" id="mod_date_added" name="mod_date_added"  required>
					</div>
			  </div>

			  <div class="form-group form-group-sm">
					<label for="mod_honorario" class="col-sm-3 control-label">Honorarios $</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="mod_honorarios" name="mod_honorarios"  >
					</div>
			  </div>

			  <div class="form-group form-group-sm">
					<label for="mod_usuario" class="col-sm-3 control-label">Usuario</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="mod_usuario" name="mod_usuario"  >
					</div>
			  </div>

			  <div class="form-group form-group-sm">
					<label for="mod_clave" class="col-sm-3 control-label">Clave</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="mod_clave" name="mod_clave"  >
					</div>
			  </div>

			  <div class="form-group form-group-sm">
					<label for="mod_telefono" class="col-sm-3 control-label">Teléfono</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="mod_telefono" name="mod_telefono">
					</div>
			  </div>
			  
			  <div class="form-group form-group-sm">
					<label for="mod_email" class="col-sm-3 control-label">Email</label>
					<div class="col-sm-8">
					<input type="email" class="form-control" id="mod_email" name="mod_email">
					</div>
			  </div>

			  <div class="form-group form-group-sm">
					<label for="mod_direccion" class="col-sm-3 control-label">Dirección</label>
					<div class="col-sm-8">
						<input type="email" class="form-control" id="mod_direccion" name="mod_direccion">
					</div>
			  </div>
			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>