<?php
session_start();
if (empty($_SESSION["nombre"])and empty($_SESSION["password"]) ) {
  header('location:login');
}
require_once $_SERVER['DOCUMENT_ROOT'].'/views/layout/topbar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/views/layout/sidebar.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/model/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/controlador_registrar_usuario.php';
?>
<style >
  ul li:nth-child(2) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>
<script >
  function advertencia() {
      var not=confirm ("¿Eliminar asistemcia?");
      return not;
    }  

</script>

<div class="page-content"  >
  <h4 class="text-center text-secondary" >Registro de Nuevo Usuario</h4>
  <div class="row" >
    <form action="" method="POST">
      <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 " >
        <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre">
      </div>
       <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 ">
        <input type="text" placeholder="Apellido" class="input input__text"  name="txtapellido">
      </div>
       <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 " >
        <input type="text" placeholder="Usuario" class="input input__text" name="txtusuario">
      </div>
       <div class="fl-flex-label mb-4 px-2 col-12 col-md-6 " >
        <input type="password" placeholder="Contraseña" class="input input__text"name="txtpassword">
      </div>
      <div class="text-right">
        <a href="users" class="btn btn-secondary btn-rounded">ATRAS</a>
        <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">REGISTRAR</button>
      </div>
    </form>
  </div>



   
</div>


<?php 
  require_once $_SERVER['DOCUMENT_ROOT'].'/views/layout/footer.php';
?>