<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];

?>
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Filtrar encomienda pendiente:</span>
  </div>
  <input type="text" class="form-control" placeholder="¿qué buscas?" aria-label="¿qué buscas?" id="buscador" aria-describedby="basic-addon1">
</div>
<table class="table table-hover" id="encpendientes">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Documento</th>
			<th scope="col">Transporte</th>
			<th scope="col">Número de Guía</th>
			<th scope="col">Cantidad de órdenes</th>
			<th scope="col">Cliente</th>
			<th scope="col">Usuario registro</th>
			<th scope="col">Fecha</th>
			<th scope="col">Hora</th>
			<th scope="col">Estatus</th>
		</tr>
	</thead>
	<tbody>
		<?php $consulta = "SELECT documentos.id,transportes.nombre,`guia`,`cant_ordenes`,perdidas.clientes.Cliente, usuarios.nombre,`fecha`, `hora`, documentos.status, (ELT(WEEKDAY(`fecha`) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS DIA_SEMANA
			FROM 
			`documentos` 
			LEFT JOIN transportes ON documentos.idtransporte= transportes.id
			LEFT JOIN perdidas.clientes ON documentos.`idcliente`= perdidas.clientes.id
			LEFT JOIN usuarios  ON documentos.usuario=usuarios.id
			WHERE 
			documentos.`status` ='pendiente'
			ORDER BY fecha,transportes.nombre ASC";
		if ($resultado = $con->query($consulta)) {
			while ($fila = $resultado->fetch_row()) {
				if ($fila[9]=='Sabado') {
					$dia=date("Y-m-d", strtotime("$fila[6] +3 day"));
				}else{
					$dia=date("Y-m-d", strtotime("$fila[6] +2 day"));
				}
				if($fecha>=$dia) {
					$clase='table-danger';
				}
				else{
					$clase='';
				}
				?><tr class='<?php echo $clase ?>' data-toggle='modal' data-target='.bd-example-modal-lg' onclick="lista_temp($('#iddoc<?php echo$fila[0]; ?>').val() , $('#optica<?php echo$fila[0]; ?>').val() , $('#guia<?php echo$fila[0]; ?>').val() );return false;"><?php 
				echo "
				<input type='hidden' id='iddoc$fila[0]' value='$fila[0]'> 
				<input type='hidden' id='optica$fila[0]' value='$fila[4]'>
				<input type='hidden' id='guia$fila[0]' value='$fila[2]'>
					<th scope='row'>$fila[0]</th>
					<td>$fila[1]</td>
					<td>$fila[2]</td>
					<td>$fila[3]</td>
					<td>$fila[4]</td>
					<td>$fila[5]</td>
					<td>$fila[6]</td>
					<td>$fila[7]</td>
					<td>$fila[8]</td>
				</tr>";
			}
			
			/* liberar el conjunto de resultados */
			$resultado->close();
		} ?>
	</tbody>
</table>
<a href="php/imprimir.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" target="_blank" onclick="window.open(this.href, this.target, 'width=300,height=400'); return false;">Imprimir informe</a>
<!-- modal -->
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div id="tramitar"></div>
    </div>
  </div>
</div>
<div id="cambiar_status"></div>

<script type="text/javascript">$('input#buscador').quicksearch('table tbody tr');</script>