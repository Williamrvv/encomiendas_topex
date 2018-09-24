<?php 
require_once("conn.php");
session_start();
$usrid=$_SESSION['id'];
@$idmensj=$_SESSION['idmensj'];

$iddoc = $_POST['iddoc'];
$optica = $_POST['optica'];
$guia = $_POST['guia'];
?>
<div class="modal-header">
  <h5 class="modal-title"><?php echo "$guia - $optica"; ?></h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form id="ingresar_ordn" method="POST" onsubmit="return false;">
    <div class="form-row">
      <div class="col-3">
        <select class="form-control" id="mensajero" name="mensajero" data-placement="top" data-trigger="focus" data-content="Recuerda seleccionar el mensajero">
          
          <?php if ($_SESSION['tipo']=='mensajero') {
          $consulta = "SELECT `id`, `nombre` FROM `mensajeros` WHERE `status`= 1 AND `id`= $idmensj";
          }else{echo '<option value="">Mensajero</option>';
            $consulta = "SELECT `id`, `nombre` FROM `mensajeros` WHERE `status`= 1 ORDER BY `nombre` ASC";}
          if ($resultado = $con->query($consulta)) {
            while ($fila = $resultado->fetch_row()) {
             echo "<option value='$fila[0]'>$fila[1]</option>";
           }
           /* liberar el conjunto de resultados */
           $resultado->close();
         }
         ?>
       </select>
     </div>
     <div class="col-3">
      <input type="text" class="form-control" name="n_orden" id="n_orden" placeholder="N° de órden" data-placement="top" data-trigger="focus" data-content="Recuerda escribir el número de la orden">
      <input type="hidden" name="iddoc" value="<?php echo $iddoc ?>">
    </div>
    <div class="col">
      <button type="button" class="btn btn-success" onclick="agregar_orden()"><i class="fas fa-plus-circle"></i> Agregar orden</button>
    </div>
  </div>
</form>
<br>
<div id="listorder"></div>
</div>
<div class="modal-footer" id="botones">
  <button type="button" class="btn btn-success" data-dismiss="modal" id="enco_recib" onclick="encom_recib(<?php echo "$iddoc, '$guia'" ?>);return false;"><i class="fas fa-check"></i> Encomienda recibida</button>
  <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardar"><i class="fas fa-save"></i> Guardar</button>
</div>
