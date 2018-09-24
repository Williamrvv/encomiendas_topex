<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];
$ndoc=$_POST['ndoc'];

$consulta = "SELECT COUNT(`guia`) FROM `documentos` WHERE `status`= 'pendiente' AND guia='$ndoc'";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
    	if ($fila[0]<1) {
    	?><div class="alert alert-danger" role="alert">
		  No se encontraron encomiendas pendientes, verifica que el número de encomienda esté correcto o contacta con T.I
		</div><?php die();
    	}
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}
?>

<table class="table ">
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
			documentos.`status` ='pendiente' and `guia`= '$ndoc'
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
				<input type='hidden' id='iddo' value='$fila[0]'> 
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
<div class="form-group">
    <label for="exampleFormControlTextarea1">Motivo por el que se forzó la encomienda:</label>
    <textarea class="form-control" id="motivoforz" rows="3" minlength="10" ></textarea>
  </div>
  <button class="btn btn-primary" onclick="btnfe('<?php echo $ndoc ?>',$('#motivoforz').val(),$('#iddo').val());return false;">Forzar recibido</button>

  <div id="forzada"></div>
  