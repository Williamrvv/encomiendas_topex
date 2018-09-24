<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];
$idu=$_POST['idu'];

$consulta = "SELECT `nombre`, CASE
	WHEN `tipo` = 'root' THEN 'Administrador'
	WHEN `tipo` = 'mensajero' THEN 'Mensajero'
	WHEN `tipo` = 'operario' THEN 'Operario'
	END AS 'tipo', `idmensajero`
FROM `usuarios` WHERE `id` = $idu";
if ($resultado = $con->query($consulta)) {
    $fila = $resultado->fetch_row();
    
    /* liberar el conjunto de resultados */
    $resultado->close();
}
?>

<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">

<form id="actualizarusr">
	<input type="hidden" name="idu" value="<?php echo $idu ?>">
	<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4" id="">Usuario</label>
      <input type="text" class="form-control" name="usract" value="<?php echo $fila[0] ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4" id="">Contraseña nueva</label>
      <input type="text" class="form-control" name="usrco" placeholder="Contraseña">
    </div>
    <div class="col-md-4"></div>
    <div class="form-group col-md-4">
      <label for="inputState" >Tipo de usuario</label>
      <select name="usrti" class="form-control">
        <option value="mensajero">Mensajero</option>
        <option value="operario">Operario</option>
        <option value="root">Administrador</option>
      </select>
    </div>
  </div>
</form>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
  <button type="button" class="btn btn-primary" onclick="act_usr2()">Actualizar</button>
</div>
