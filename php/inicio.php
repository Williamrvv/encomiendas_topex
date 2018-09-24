<?php require_once("conn.php"); 
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: php/cerrar_sesion.php');
}
 ?>
  <h4>Registro de encomiendas por entrar:</h4>
  <div><p class="nav"><?php echo $_SESSION['nombre'];?></p>  <p class="nav justify-content-end"><?php echo "$fecha"; ?></p></div>
<form id="crear_documento" method="POST" name="crear_encomienda">
  <div class="form-group">
    <label for="exampleInputEmail1">Cliente:</label>
      <input type="text" name="client" id="client" class="form-control" placeholder="Nombre de la óptica" onblur="comprueba($('#client').val())" required="">
    <small id="Help" class="form-text text-muted">Utiliza el autocompletado para escribir el nombre del cliente más facil.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Cantidad de órdenes enviadas:</label>
    <input type="number" class="form-control" name="cant_ordenes" placeholder="Cantidad órdenes" min="1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Número de encomienda:</label>
    <input type="text" class="form-control" name="encomienda" placeholder="Número de guía">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Empresa de transporte:</label>
    <select class="form-control" id="transporte" name="transporte">
    <option value=""></option>
    <?php 
      $consulta = "SELECT `id`, `nombre` FROM `transportes` WHERE status = 1 ORDER BY `nombre` ASC";
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
  <label for="exampleInputPassword1">Medio de notificación de la encomienda:</label><br>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="notificacion" id="inlineRadio1" value="Whatsapp" checked="">
    <label class="form-check-label" for="inlineRadio1">Whastapp</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="notificacion" id="inlineRadio2" value="Llamada">
    <label class="form-check-label" for="inlineRadio2">Llamada</label>
  </div>
</form><br>
  <button type="submit" class="btn btn-primary" id="crear">Crear encomienda</button>
<div id="resp"></div>
<script type="text/javascript">
  $('#client').autoComplete({
    minChars: 2,
    source: function(term, suggest){
      term = term.toLowerCase();
      var choices = ['ActionScript'<?php 
          $consulta = "SELECT `Cliente` FROM perdidas.`clientes` WHERE status=1";
          if ($resultado = $con->query($consulta)) {
              while ($fila = $resultado->fetch_row()) {
                   echo ",'$fila[0]'";
              }
              /* liberar el conjunto de resultados */
              $resultado->close();
          }
       ?> ];
      var matches = [];
      for (i=0; i<choices.length; i++)
      if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
      suggest(matches);
    }
  });
</script>
