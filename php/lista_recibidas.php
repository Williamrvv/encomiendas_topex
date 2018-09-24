<?php require_once("conn.php");
$dia1=$_POST['dia1'];
$dia2=$_POST['dia2'];

$hora1=$_POST['hora1'];
$hora2=$_POST['hora2'];

?>
<table class="table table-hover">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Documento</th>
			<th scope="col">Cliente</th>
			<th scope="col">Número de Guía</th>
			<th scope="col">Transporte</th>
			<th scope="col">Fecha registro</th>
			<th scope="col">Hora registro</th>
			<th scope="col">Usuario registro</th>
			<th scope="col">Fecha recibido</th>
			<th scope="col">Hora recibido</th>
			<th scope="col">Usuario recibido</th>
			<th scope="col">Estatus</th>
			<th scope="col">Por medio de</th>
		</tr>
	</thead>
	<tbody>
		<?php $consulta = "SELECT documentos.id, perdidas.clientes.Cliente, `guia`, transportes.nombre, `fecha`, `hora`, usuarios.nombre AS userreg, `fecha_recibe`, `hora_recibe`, usuarios.nombre AS userrec, documentos.status,`notificacion`
			FROM 
			`documentos` 
			LEFT JOIN perdidas.clientes ON documentos.`idcliente`= perdidas.clientes.id
			LEFT JOIN transportes ON documentos.idtransporte= transportes.id
			LEFT JOIN usuarios AS userreg1 ON documentos.usuario= userreg1.id
			LEFT JOIN usuarios  ON documentos.usr_recibe=usuarios.id
			WHERE (documentos.`status` ='Recibido') and ((fecha_recibe>='$dia1')AND(fecha_recibe<='$dia2')) AND (`hora_recibe`>='$hora1' AND `hora_recibe`<='$hora2')
			ORDER BY fecha,transportes.nombre ASC";
		if ($resultado = $con->query($consulta)) {
			$cantidad=0;
			while ($fila = $resultado->fetch_row()) {
				$cantidad=$cantidad+1;
				?><tr class='' data-toggle="modal" data-target="#modalinfo" onclick="info_encomienda_recibida($('#iddocume<?php echo $fila[0] ?>').val(),$('#clientenomb<?php echo $fila[0] ?>').val(),$('#statusenc<?php echo $fila[0] ?>').val(),$('#nguia<?php echo $fila[0] ?>').val());return false;">
				<input type="hidden" id="iddocume<?php echo $fila[0] ?>" name="iddocume" value="<?php echo $fila[0] ?>">
				<input type="hidden" id="clientenomb<?php echo $fila[0] ?>" name="clientenomb" value="<?php echo $fila[1] ?>">
				<input type="hidden" id="statusenc<?php echo $fila[0] ?>" name="statusenc" value="<?php echo $fila[10] ?>">
				<input type="hidden" id="nguia<?php echo $fila[0] ?>" name="nguia" value="<?php echo $fila[2] ?>">
				<?php echo "
				<th scope='row'>$fila[0]</th>
				<td>$fila[1]</td>
				<td>$fila[2]</td>
				<td>$fila[3]</td>
				<td>$fila[4]</td>
				<td>$fila[5]</td>
				<td>$fila[6]</td>
				<td>$fila[7]</td>
				<td>$fila[8]</td>
				<td>$fila[9]</td>
				<td>$fila[10]</td>
				<td>$fila[11]</td>
				</tr>";
			}
			/* liberar el conjunto de resultados */
			$resultado->close();
		} ?>
	</tbody>
</table>

<div class="modal fade" id="modalinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<div id="info"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>