<?php 
require_once("conn.php");
session_start();
$usrid=$_SESSION['id'];
$documentoid=$_POST['documentoid'];
$clientenomb=$_POST['clientenomb'];
$statusenc=$_POST['statusenc'];
$nguia=$_POST['nguia'];
//echo "$documentoid";
?>

<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel"><?php echo "$nguia - $clientenomb";?></h5>
		<span class="badge badge-secondary"><?php echo $statusenc; ?></span>
</div>
<div class="modal-body">
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">N° de Orden</th>
      <th scope="col">Mensajero</th>
      <th scope="col">fecha / hora</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  	$consulta = "SELECT ordenes.`id`, ordenes.`orden`, mensajeros.nombre, ordenes.fecha
				FROM `ordenes`
				LEFT JOIN mensajeros ON mensajeros.id = ordenes.idmensajero
				WHERE 
				ordenes.iddocumentos= $documentoid
				ORDER by ordenes.id DESC";
		if ($resultado = $con->query($consulta)) {
		    while ($fila = $resultado->fetch_row()) { ?>
		    	<tr>
			    	<td><?php echo $fila[1]; ?></td>
			    	<td><?php echo $fila[2]; ?></td>
			    	<td><?php echo $fila[3]; ?></td>
		    	</tr>
		    <?php }
		    /* liberar el conjunto de resultados */
		    $resultado->close();
		}
  	?>
  </tbody>
</table>
</div>
<?php 
$consulta = "SELECT `forzada`, usuarios.nombre
			FROM `documentos`
			LEFT JOIN usuarios ON usuarios.id = documentos.usr_recibe
			WHERE documentos.`id`= $documentoid";
if ($resultado = $con->query($consulta)) {
    while ($fila = $resultado->fetch_row()) { 
    	if ($fila[0]=='') {
    		die();
    	}?>
    	<div class="card">
  <div class="card-header" style="color:red;">
    Forzada recibido
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p><?php echo $fila[0] ?></p>
      <footer class="blockquote-footer"><cite title="Source Title"><?php echo $fila[1] ?></cite></footer>
    </blockquote>
  </div>
</div>
    <?php }
    /* liberar el conjunto de resultados */
    $resultado->close();
}
?>