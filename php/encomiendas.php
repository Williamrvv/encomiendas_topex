<?php require_once("conn.php");
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: php/cerrar_sesion.php');
}
?>
<div>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="nav-item active"><a class="nav-link active" href="#home" aria-controls="home" role="tab" data-toggle="tab">Encomiendas pendientes</a></li>
		<li role="presentation" class="nav-item"><a class="nav-link" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Historial de encomiendas</a></li>
    <!-- <li role="presentation" class="nav-item"><a class="nav-link" href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
      <li role="presentation" class="nav-item"><a class="nav-link" href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li> -->
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
      
      <div id="lista" style="margin-top: 20px"></div>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
      <form id="lista_recibido" method="POST">
        <div class="row">
          <div class="col-2">
            <input type="date" class="form-control" name="dia1" placeholder="desde el día" value="<?php echo($fecha) ?>">
          </div>
          <div class="col-2">
            <input type="date" class="form-control" name="dia2" placeholder="Hasta el día" value="<?php echo($fecha) ?>">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="hora1" value="00:00">
          </div>
          <div class="col-2">
            <input type="time" class="form-control" name="hora2" value="23:59">
          </div>
          <div class="col-2">
            <button type="button" class="btn btn-success" onclick="ver_rec()">Ver lista</button>
          </div>
        </div>
      </form>
      <br>
        <div class="row">
          <div class="col-3"><input type="text" class="form-control" id="buscartxt" placeholder="buscar encomienda" ></div>
          <div class="col-3"><button type="button" class="btn btn-success" onclick="buscar($('#buscartxt').val());return false;">Buscar</button></div>
        </div>
      <div id="lista_rec" style="margin-top: 20px"></div>
    </div>
    <!-- <div role="tabpanel" class="tab-pane" id="messages">.3..</div>
      <div role="tabpanel" class="tab-pane" id="settings">...4</div> -->
  </div>
</div>
<script type="text/javascript">

</script>