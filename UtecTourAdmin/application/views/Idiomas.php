<div class="content-header">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-md-12 col-sm-6 col-xs-12">
				<h1>Idiomas&nbsp;<span class="ion ion-android-home"></span></h1>
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
				<form method="POST" action="<?php echo base_url('/Idiomas') ?>" name="formFil">
					<div class="box-header with-border">
						<h4>Filtros</h4>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-3">
								<label for="txtNomFil">Nombre</label>
								<input id="txtNomFil" name="txtNomFil" type="text" class="form-control txtNomFil" placeholder="Nombre">
							</div>							
						</div>
					</div>
					<div class="box-footer with-border">
						<div class="pull-right">
							<a role="button" onclick="javascript:return cleanFields();" href="<?php echo base_url('/Idiomas') ?>" class="btn btn-danger">Limpiar</a>
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
					<form action="<?php echo base_url('/Idiomas/borrarDatos'); ?>" method="post">
						<table class="table table-striped table-responsive">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Icono</th>
									<th>Audio</th>
									<th>Modificar</th>
									<th class="text-center">
										<button type="submit" name="btnBorrar" id="btnBorrar" class="btn btn-danger btn-xs btnBorrar pull-right" onclick="return confimar('borrar');"><i class="fa fa-trash"></i></button>
										<input type="checkbox" name="todo" id="todo" class="checkbox" />
									</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($resp) && is_array($resp)) {
									foreach ($resp as $obj) { ?>
										<tr>
											<td><?php echo $obj->idm_codigo; ?></td>
											<td><?php echo $obj->idm_nombre; ?></td>
											<td><?php echo $obj->idm_icono; ?></td>
											<td><?php echo $obj->idm_audio; ?></td>
											<td class="text-center">
												<a href="#" name="btnEditar" id="btnEditar" class="btn btn-info btn-xs" onclick="edit('<?php echo $obj->idm_codigo ?>','<?php echo $obj->idm_nombre ?>');"><i class="fa fa-edit"></i></a>
											</td>
											<td>
												<input type="checkbox" name="chkBorrar[]" class="checkbox" value="<?php echo $obj->idm_codigo ?>" />
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
			<form method="POST" action="<?php echo base_url('/Idiomas/guardarDatos') ?>">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4>Datos del Idioma</h4>
						<input type="hidden" id="codidm" name="codidm" class="codidm">
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<label for="txtNom" class="control-label">Nombre</label>
									<input type="text" id="txtNom" name="txtNom" class="form-control txtNom" placeholder="Nombre" required="required">
								</div>
								<div class="col-sm-6">
									<label for="txtIco" class="control-label">Icono</label>
									<input type="file" id="txtIco" name="txtIco" class="form-control txtIco">
								</div>
								<div class="col-sm-6">
									<label for="txtAud" class="control-label">Audio</label>
									<input type="file" id="txtAud" name="txtAud" class="form-control txtAud">
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
	function mostrarModal() {
		$("#modalAdd").modal('show');
	};

	function cleanFields() {
		$('#codidm').val("0");
		$('.txtNom').val('');
		$ico = $('.txtIco');
		$ico.replaceWith($ico.clone(true));
		$aud = $('.txtAud');
		$aud.replaceWith($aud.clone(true));
	};

	function edit(c, n) {
		$('#codidm').val(c);
		$('.txtNom').val(n);
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