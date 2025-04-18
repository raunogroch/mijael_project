<?php
 	if (!empty($_POST["btnmodificar"])) {
 		if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtCI"]) and !empty($_POST["txtcargo"]) ) {

 	$id=$_POST["txtid"];
 	$nombre=$_POST["txtnombre"];
    $apellido=$_POST["txtapellido"];
    $CI=$_POST["txtCI"];
    $cargo=$_POST["txtcargo"];
   $sql=$conn->query(" update empleado set nombre='$nombre', apellido='$apellido', CI=$CI, cargo=$cargo WHERE id_empleado=$id ");
   if ($sql == true) { ?>
   	 <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "El Personal fue correctamente modificado",
                        styling: "bootstrap3"
                    })
                })
        </script>

  <?php } else { ?>
   	 <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error al modificar ",
                        styling: "bootstrap3"
                    })
                })
        </script>
  <?php }
   
 		} else { ?>
 			 <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "los campos estan vacios",
                        styling: "bootstrap3"
                    })
                })
        </script>
 	<?php	} ?>
 		<script> 
        setTimeout(()=>{
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
     </script>

 		
 		<?php 	}
?>