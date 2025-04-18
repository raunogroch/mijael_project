<?php
if (!empty($_POST["btnmodificar"])) {

	if (!empty($_POST["txtnombre"])) {
			$nombre=$_POST["txtnombre"];
			$id=$_POST["txtid"];
			$verificarNombre=$conn->query(" SELECT COUNT(*) as 'total' FROM cargo WHERE nombre='$nombre' and id_cargo!=$id ");
				if ($verificarNombre->fetch_object()->total > 0) { ?>
   	 	<script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: " El Nombre <?= $nombre ?> ya existe",
                        styling: "bootstrap3"
                    })
                })
        </script>
  <?php					// code...
				} else { 
					$sql=$conn->query(" update cargo set nombre='$nombre' where id_cargo=$id");
				if ($sql==true) { ?>
					<script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "modificado correctamente",
                        styling: "bootstrap3"
                    })
                })
        </script>
				<?php } 
					// code...
				}
				
		// code...
	} else { ?>
   	 	<script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Los campos estan vacios",
                        styling: "bootstrap3"
                    })
                })
        </script>
  <?php
		// code...
	} ?>
<script> 
        setTimeout(()=>{
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
     </script>

	
<?php 
}

?>