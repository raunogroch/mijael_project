<?php

	if (!empty($_POST["btnregistrar"])) {
		if (!empty($_POST["txtnombre"])) {
		$nombre = $_POST["txtnombre"];
		$verificarNombre=$conn->query(" SELECT COUNT(*) as 'total' FROM cargo WHERE nombre='$nombre'");
			if ($verificarNombre->fetch_object()->total > 0) { ?>
				   <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El Area <?= $nombre ?> ya existe",
                        styling: "bootstrap3"
                    })
                })
        </script>
			<?php	} else {
			$sql=$conn->query(" insert INTO cargo(nombre) values ('$nombre')");
				if ($sql==true) { ?>
					<script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "registrado correctamente",
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
                        text: " Error al registrar",
                        styling: "bootstrap3"
                    })
                })
        </script>
			<?php	}
				
			}
	
		} else { ?>
			<script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: " Los campos estan vacios",
                        styling: "bootstrap3"
                    })
                })
        </script>

		<?php	}
	?>
<script> 
        setTimeout(()=>{
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
     </script>

	
<?php 
}