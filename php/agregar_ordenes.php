<?php 
require_once("conn.php");
session_start();
$usrid=$_SESSION['id'];
@$mensajero = $_POST['mensajero'];
@$orden=$_POST['n_orden'];
@$iddoc = $_POST['iddoc'];

if ($mensajero!='' and $orden!='') {
	$query = "INSERT INTO `ordenes`(`iddocumentos`, `orden`, `idusuario`, `idmensajero`) VALUES ($iddoc, '$orden', $usrid, $mensajero)";
	mysqli_query($con, $query);
	?>
	<script>
	$("#n_orden").val('');
	</script>
	<?php 
}else{?><script type="text/javascript">$('#mensajero').popover('toggle')</script><?php }

$consulta = "SELECT (documentos.cant_ordenes-COUNT(ordenes.iddocumentos)) FROM `ordenes`,documentos WHERE ordenes.iddocumentos=$iddoc and documentos.id=$iddoc";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
        ?><button type="button" class="btn btn-primary">
		Faltan <span class="badge badge-light"><?php echo $fila[0] ?></span>
		</button><?php 
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}
?>

<table class="table table-striped">
	<thead>
		<tr>
		  <th scope="col">#</th>
		  <th scope="col">N° Orden</th>
		  <th scope="col">Mensajero</th>
		  <th scope="col">borrar</th>
		</tr>
	</thead>
	<tbody>
<?php 
	$consulta = "SELECT ordenes.`id`, ordenes.`iddocumentos`, ordenes.`orden`, mensajeros.nombre 
FROM `ordenes`
LEFT JOIN mensajeros ON mensajeros.id = ordenes.idmensajero
WHERE 
ordenes.iddocumentos=$iddoc
ORDER by ordenes.id DESC";
	if ($resultado = $con->query($consulta)) {
			$cont=0;
	    while ($fila = $resultado->fetch_row()) {
	    	$cont++;
				?>
				<tr>
					<input type="hidden" name="idorden" id="idorden<?php echo $fila[0] ?>" value="<?php echo $fila[0] ?>">
					<th><?php echo $cont ?></th>
					<td><?php echo $fila[2] ?></td>
					<td><?php echo $fila[3] ?></td>
					<td><button type="button" class="btn btn-outline-danger" onclick="borrar_orden($('#idorden<?php echo $fila[0]; ?>').val());return false">Borrar</button></td>
				</tr>
				<?php 
	    }
	    /* liberar el conjunto de resultados */
	    $resultado->close();
	}
 ?>
	</tbody>
</table>
<div id="borrar"></div>
<?php 

//$consulta = "SELECT (documentos.cant_ordenes-COUNT(ordenes.iddocumentos)) FROM `ordenes`,documentos WHERE ordenes.iddocumentos=$iddoc and documentos.id=$iddoc";
$consulta = "SELECT (documentos.cant_ordenes-COUNT(ordenes.iddocumentos)) FROM `ordenes`,documentos ";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) {
    	if ($fila[0]>=1) {
    	?><script type="text/javascript">
			$('#enco_recib').css('display','none'); 
		</script><?php 
    	}else{
    		?><script type="text/javascript">
				$('#enco_recib').css('display',''); 
			</script><?php 
    	}
    }
    /* liberar el conjunto de resultados */
    $resultado->close();
}





$consulta = "SELECT COUNT(*) FROM `ordenes` WHERE `iddocumentos`=$iddoc";
if ($resultado = $con->query($consulta)) {
  $botones = $resultado->fetch_row();
  if ($botones[0]==0) {
    ?>
<script type="text/javascript">
	$('#botones').css('display','none'); 
</script>
    <?php
  }else{
  	    ?>
<script type="text/javascript">
	$('#botones').css('display',''); 
</script>
    <?php
  }}
?>
