<?php 
if (!empty($_POST["btnmodificar"])) {
	if (!empty($_POST["txtid"])) {
		$id=$_POST["txtid"];
		$nombre=$_POST["txtnombre"];
    	$telefono=$_POST["txttelefono"];
    	$ubicacion=$_POST["txtubicacion"];
    	$NIT=$_POST["txtNIT"];
		$sql=$conn->query(" update instituto set nombre='$nombre', telefono='$telefono', ubicacion='$ubicacion', NIT='$NIT' WHERE id_instituto=$id ");
		if ($sql == true) {
			?>
   	 <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "Datos modificados correctamente",
                        styling: "bootstrap3"
                    })
                })
        </script>

  <?php
		} else { ?>
   	 <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error al modificar los datso",
                        styling: "bootstrap3"
                    })
                })
        </script>

  <?php
			// code...
		}
		
	} else { ?>
   	 <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "no se envio el identificador",
                        styling: "bootstrap3"
                    })
                })
        </script>

  <?php 
	
	}
	
	?>
 		<script> 
        setTimeout(()=>{
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
     </script>

 		
 		<?php	}
?>