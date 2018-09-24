<?php require_once("conn.php"); 
session_start();
$usr=$_SESSION['id'];
$idu=$_POST['idu'];
?>
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Usuario Nuevo</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4" id="">Usuario</label>
      <input type="text" class="form-control" id="usrnu" placeholder="Nombre de usuario">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4" id="">Contraseña</label>
      <input type="text" class="form-control" id="usrco" placeholder="Contraseña">
    </div>
    <div class="col-md-4"></div>
    <div class="form-group col-md-4">
      <label for="inputState">Tipo de usuario</label>
      <select id="usrti"  class="form-control">
        <option selected value="mensajero">Mensajero</option>
        <option value="operario">Operario</option>
        <option value="root">Administrador</option>
      </select>
    </div>
  </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
  <button type="button" class="btn btn-primary" onclick="unu($('#usrnu').val(), $('#usrco').val(), $('#usrti').val());return false;">Agregar</button>
</div>