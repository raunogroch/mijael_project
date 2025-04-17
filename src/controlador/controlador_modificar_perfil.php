<?php
if (!empty($_POST["btnmodificar"])) {
	if (!empty($_POST["txtid"]) and !empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"])) {
	$id=$_POST["txtid"];
	$nombre=$_POST["txtnombre"];
    $apellido=$_POST["txtapellido"];
    $usuario=$_POST["txtusuario"];
     $sql=$conn->query(" update usuario set nombre='$nombre', apellido='$apellido', usuario='$usuario' WHERE id_usuario=$id ");
     if ($sql == true) { 
   if ($sql == true) { ?>
   	 <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "Modificado correctamente",
                        styling: "bootstrap3"
                    })
                })
        </script>

  <?php }
     	
     } else {
     	?>
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
  <?php
     }
     
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
 	<?php } ?>
 		<script> 
        setTimeout(()=>{
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
     </script>

 		
 		<?php
	
}
?>