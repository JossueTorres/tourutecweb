<div class="content-header">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-md-12 col-sm-6 col-xs-12">
				<h1>Usuarios&nbsp;<span class="ion ion-android-home"></span></h1>
				<!-- <?php $ardat = $this->session->userdata("logged_in");
						echo $ardat['ou'];
						echo $ardat['pd'];   ?> -->
			</div>
			<div class="col-md-12 col-sm-6 col-xs-12">
				<div class="row">
					<?php if ($this->session->flashdata('success_msg')) {
						?>
						<div class="container alert alert-success">
							<div class="col-sm-11">
								<?php echo $this->session->flashdata('success_msg'); ?>
							</div>
							<div class="col-sm-1">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
						</div>
					<?php
				} else if ($this->session->flashdata('error_msg')) {
					?>
						<div class="container alert alert-danger">
							<div class="col-sm-11">
								<?php echo $this->session->flashdata('error_msg'); ?>
							</div>
							<div class="col-sm-1">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-success">
				<form method="POST" action="<?php echo base_url('/Usuarios') ?>" name="formFil">
					<div class="box-header with-border">
						<h4>Filtros</h4>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-3">
								<label for="txtCorFil">Correo</label>
								<input id="txtCorFil" name="txtCorFil" type="email" class="form-control txtCorFil" placeholder="Correo">
							</div>
							<div class="col-sm-3">
								<label for="ddlEstFil">Estado</label>
								<select name="ddlEstFil" id="ddlEstFil" class="form-control ddlEstFil">
									<option value="A">Activo</option>
									<option value="I">Inactivo</option>
								</select>
							</div>
						</div>
					</div>
					<div class="box-footer with-border">
						<div class="pull-right">
							<a role="button" onclick="javascript:return cleanFields();" href="<?php echo base_url('/Usuarios') ?>" class="btn btn-danger">Limpiar</a>
							<button type="submit" class="btn btn-primary"><span class="ion ion-search"></span>&nbsp;Buscar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="box-header">
					<button id="btnNuevo" class="btn btn-success btnNuevo"><span class="ion ion-plus"></span>&nbsp;Agregar</button>
				</div>
				<div class="box-body">
					<form action="<?php echo base_url('/Usuarios/Borrar'); ?>" method="post">
						<table class="table table-striped table-responsive">
							<thead>
								<tr>
									<th>Código</th>
									<th>Correo</th>
									<th>Tipo</th>
									<th>Estado</th>
									<th style="align:center;">Modificar</th>
									<th>
										<button type="submit" name="btnBorrar" id="btnBorrar" class="btn btn-danger btn-xs btnBorrar pull-right" onclick="return confimar('borrar');"><i class="fa fa-trash"></i></button>
										<input type="checkbox" name="todo" id="todo" class="checkbox" />
									</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($resp) && is_array($resp)) {
									foreach ($resp as $obj) { ?>
										<tr>
											<td><?php echo $obj->usr_codigo; ?></td>
											<td><?php echo $obj->usr_correo; ?></td>
											<td><label class="label <?php if ($obj->usr_tipo == 'A') echo 'label-success';
																	else echo 'label-info'; ?>"><?php if ($obj->usr_tipo  == 'A') echo 'Adminsitrador';
																											else echo 'Visitante'; ?></label></td>
											<td><label class="label <?php if ($obj->usr_estado == 'A') echo 'label-success';
																	else echo 'label-warning'; ?>"><?php if ($obj->usr_estado == 'A') echo 'Activo';
																							else echo 'Inactivo'; ?></label></td>
											<td style="align:center;">
												<a href="#" name="btnEditar" id="btnEditar" class="btn btn-info btn-xs" onclick="edit('<?php echo $obj->usr_codigo ?>','<?php echo $obj->usr_correo ?>','<?php echo $obj->usr_tipo ?>','<?php echo $obj->usr_estado ?>')"><i class="fa fa-edit"></i></a>
											</td>
											<td>
												<input type="checkbox" name="chkBorrar[]" class="checkbox" value="<?php ?>" />
											</td>
										</tr>
									<?php }
							}	?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" id="modalAdd">
		<div class="modal-dialog" role="document">
			<form method="POST" action="<?php echo base_url('/Usuarios/guardarDatos') ?>">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>Datos de la Persona</h4>
						<input type="hidden" id="codedf" name="codedf" class="codedf">
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<label for="txtCor" class="control-label">Correo</label>
									<input type="text" id="txtCor" name="txtCor" class="form-control txtCor" placeholder="Correo" required="required">
								</div>
								<div class="col-sm-6">
									<label for="txtPass" class="control-label">Contraseña</label>
									<input type="text" id="txtPass" name="txtPass" class="form-control txtPass" placeholder="Contraseña" required="required">
								</div>
								<div class="col-sm-6">
									<label for="ddlEst" class="control-label">Estado</label>
									<select name="ddlEst" id="ddlEst" class="form-control ddlEst">
										<option value="A">Activo</option>
										<option value="I">Inactivo</option>
									</select>
								</div>
								<div class="col-sm-6">
									<label for="txtLongitud" class="control-label">Tipo</label>
									<select name="ddlEst" id="ddlEst" class="form-control ddlEst">
										<option value="A">Administrador</option>
										<option value="L">Visitante</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	function cleanFil() {
		$(".txtNombre").val("");
		$(".txtAcronimo").val("");
	}

	function mostrarModal() {
		$("#modalAdd").modal('show');
	};

	function cleanFields() {
		$('#codusr').val("0");
		$('.txtNom').val('');
		$('.txtPass').val('').removeAttr();
		$('.ddlEstado').val('A');
		$('.ddlTipo').val('A');		
	};

	function edit(c, cor, n, e, t) {
		$('#codusr').val(c);
		$('.txtCor').val(cor);
		$('.txtPass').val('').attr("disabled", "disabled");
		$('.ddlEst').val(e);
		$('.ddlTip').val(t);
		mostrarModal();
	};

	function confimar(text) {
		return confirm("¿Esta seguro que desea: " + text + " los registros seleccionados?");
	};

	$(function() {

		$('.btnNuevo').click(function(e) {
			e.preventDefault();
			cleanFields();
			mostrarModal();
		});

		$('#todo').on('click', function() {
			if (this.checked) {
				$('.checkbox').each(function() {
					this.checked = true;
				});
			} else {
				$('.checkbox').each(function() {
					this.checked = false;
				});
			}
		});

		$('.checkbox').on('click', function() {
			if ($('.checkbox:checked').length == $('.checkbox').length) {
				$('#todo').prop('checked', true);
			} else {
				$('#todo').prop('checked', false);
			}
		});

	});
</script>