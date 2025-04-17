<?php
if (!empty($_POST["btnmodificar"])) {
	if (!empty($_POST["txtclaveActual"]) and !empty($_POST["txtclaveNueva"]) and !empty($_POST["txtid"]) ) {
			$claveActual=md5($_POST["txtclaveActual"]);
			$id=$_POST["txtid"];
			$claveNueva=md5($_POST["txtclaveNueva"]);
			$verificarClaveActual=$conn->query(" select password from usuario where id_usuario=$id ");
			if ($verificarClaveActual->fetch_object()->password==$claveActual) { 

				$sql = $conn->query(" update usuario set password='$claveNueva' where id_usuario=$id ");
				if ($sql==true) { ?>
   	 	<script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: " La Contraseña se Modifico ",
                        styling: "bootstrap3"
                    })
                })
        </script>
  <?php		} else {
					?>
   	 	<script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: " Error al Modificar la contraseña",
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
                        text: " Contraseña Actual Incorrecta",
                        styling: "bootstrap3"
                    })
                })
        </script>
  <?php	
				
			}
	
	} else {
		?>
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
  <?php	
	} ?>
     <script> 
        setTimeout(()=>{
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
     </script>

<?php }

?>