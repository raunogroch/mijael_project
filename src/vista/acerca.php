<?php

 session_start();
if (empty($_SESSION["nombre"])and empty($_SESSION["password"]) ) {
       header('location:login/login.php');
   }

?>
<style >
  ul li:nth-child(5) .activo{
    background: rgb(11, 150, 214) !important;
  }



</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content"  >

       <h4 class="text-center text-secondary" >INSTITUTO MATEMA</h4>
       <?php
include '../modelo/conexion.php';
include '../controlador/controlador_modificar_empresa.php';
$sql=$conn->query( "SELECT * from instituto")
?>
  <div class="row" >
    <?php 
    while ($datos=$sql->fetch_object()){ ?>
      <form action="" method="POST">
        <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6 " >
        <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->id_instituto ?>"> 
      </div>
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 " >
        <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>"> 
      </div>
       <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 ">
        <input type="text" placeholder="telefono" class="input input__text"  name="txttelefono"value="<?= $datos->telefono ?>">
      </div>
       <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 " >
        <input type="text" placeholder="ubicacion" class="input input__text" name="txtubicacion"value="<?= $datos->ubicacion ?>">
      </div>
       <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 " >
        <input type="text" placeholder="Nit" class="input input__text"name="txtNIT" value="<?= $datos->NIT ?>">
      </div>
      <div class="text-right">
      
        <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">MODIFICAR</button>
      </div>
    </form>
  </div>



  <?php  }
    ?>
    



   
</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>