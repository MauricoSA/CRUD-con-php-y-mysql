<!DOCTYPE html>
<html>
<head>
	<title>
		NES-clasic
	</title>
	<?php require_once "scripts.php"; ?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card text-left">
					<div class="card-header">
						Tablas dinamicas con datatable y php xD.
					</div>
					<div class="card-body">
						<span class="btn btn-primary" data-toggle="modal" data-target="#agregardatosmodal">
							Agregar nuevo <span class="fas fa-plus-circle"></span>
						</span>
						<hr>
						<div id="tablaDatatable"></div>
					</div>
					<div class="card-footer text-muted">
						By Shankz_scrafs :-P.
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Agregado de modal o pantaventana -->
	

	<!-- Modal -->
	<div class="modal fade" id="agregardatosmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Agrega Juegos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevo">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Año</label>
						<input type="text" class="form-control input-sm" id="anio" name="anio">
						<label>Empresa</label>
						<input type="text" class="form-control input-sm" id="empresa" name="empresa">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btnagregarnuevo" class="btn btn-primary">Agregar Nuevo</button>
				</div>
			</div>
		</div>
	</div>
	<!-- inicio de modal 2 -->


	<!-- Modal-2 -->
	
	<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar juego</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="frmnuevoU">
						<input type="text" hidden="" id="idjuego" name="idjuego">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
						<label>Año</label>
						<input type="text" class="form-control input-sm" id="anioU" name="anioU">
						<label>Empresa</label>
						<input type="text" class="form-control input-sm" id="empresaU" name="empresaU">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" id="btnActualizar">Actualizar</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>		
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnagregarnuevo').click(function(){
			datos=$('#frmnuevo').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/agregar.php",
				success:function(r){
					if (r==1) {
						//para limpiar el formulario
						$('#frmnuevo')[0].rest();
						//para recargar en automatico la tabla.
						$('#tablaDatatable').load('tabla.php');
						alertify.success("Agregado Con Exito :D");
					}else{
						alertify.error("No se pudo agregar. :(");
					}
				}
			});

		});
		$('#btnActualizar').click(function(){
			datos=$('#frmnuevoU').serialize();
			
			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/actualizar.php",
				success:function(r){
					if (r==1) {
						//para recargar en automatico la tabla.
						$('#tablaDatatable').load('tabla.php');
						alertify.success("actualizado Con Exito :D");
					}else{
						alertify.error("No se pudo Actualizar. :(");
					}
				}
			});

		});
	});
</script>
<script type="text/javascript">
	//apertura docuemto jquery
	$(document).ready(function(){
		$('#tablaDatatable').load('tabla.php');
	});
</script>

<script type="text/javascript">
	function agregaFrmActualizar(idjuego){
		$.ajax({
			type:"POST",
			data:"idjuego=" + idjuego,
			url:"procesos/obtenerDatos.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idjuego').val(datos['id_juegp']);
				$('#nombreU').val(datos['nombre']);
				$('#anioU').val(datos['anio']);
				$('#empresaU').val(datos['empresa']);

			}
		});
	}
	function EliminarDatos(idjuego){
		alertify.confirm('Eliminar un juego', '¿Seguro de elimiar este juego pro :(?', function(){ 
				$.ajax({
					type:"POST",
					data:"idjuego=" + idjuego,
					url:"procesos/eliminar.php",
					success:function(r){
						if (r==1) {
							$('#tablaDatatable').load('tabla.php');
							alertify.success("Eliminado con exito!");
						}else{
							alertify.error("No se pudo eliminar");
						}
					}
				});			
			 }
                , function(){ alertify.error('Cancel')});
	}
</script>