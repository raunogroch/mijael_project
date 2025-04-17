<?php

 session_start();
if (empty($_SESSION["nombre"])and empty($_SESSION["apellido"]) ) {
       header('location:login/login.php');
   }

?>
<style >
  ul li:nth-child(1) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>
<script >
  function advertencia() {
      var not=confirm ("¿Eliminar asistemcia?");
      return not;
    }  
</script>
<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content"  >

       <h4 class="text-center text-secondary" >REPORTE ASISTENCIA</h4>
<?php 
include "../modelo/conexion.php";
$sql=$conn->query("SELECT * from empleado");
?>

     <form action="fpdf/ReporteAsistenciaFecha.php">
      <input type="date" name="txtfechadeinicio" class="input input__text mb-2">
       <input type="date" name="txtfechadefinal" class="input input__text mb-2">
       <select class="input input__select mb-2" name="txtempleado"  >
         <option value="todos">todos el personal</option>
         <?php 
          while($datos = $sql->fetch_object()) { ?>
              <option value="<?= $datos->is_empleado?>"><?= $datos->nombre ." ". $datos->apellido ?></option>
          <?php }

         ?>
       </select>
       <button type="submit" name="btngenerar" class="btn btn-primary w-100 p-3">GENERAR REPORTE</button>
     </form>
        
   
  </tbody>
</table>
</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>