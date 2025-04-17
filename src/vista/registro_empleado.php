<?php

 session_start();
if (empty($_SESSION["nombre"])and empty($_SESSION["password"]) ) {
       header('location:login/login.php');
   }

?>
<style >
  ul li:nth-child(3) .activo{
    background: rgb(11, 150, 214) !important;
  }



</style>
<script >
  function advertencia() {
      var not=confirm ("¿Eliminar personal?");
      return not;
    }  

</script>
<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content"  >

       <h4 class="text-center text-secondary" >Registro de Personal</h4>
       <?php
include '../modelo/conexion.php';
include "../controlador/controlador_registrar_empleado.php"
?>
  <div class="row" >
    <form action="" method="POST">
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 " >
        <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre">
      </div>
       <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 ">
        <input type="text" placeholder="Apellido" class="input input__text"  name="txtapellido">
      </div>
       <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 " >
        <input type="number" placeholder="CI" class="input input__number" name="txtCI">
      </div>
       <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 " >
        <select class="input input__select"name="txtcargo">
        <option value="">seleccionar...</option>
        <?php
        $sql=$conn->query(" select * from cargo ");
        while ($datos=$sql->fetch_object()){ ?>
            <option value="<?= $datos->id_cargo ?>"><?= $datos->nombre ?></option>

        <?php } 
        ?>
      </select>
      </div>
      <div class="text-right">
        <a href="empleado.php" class="btn btn-secondary btn-rounded">ATRAS</a>
        <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">REGISTRAR</button>
      </div>
    </form>
  </div>



   
</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>