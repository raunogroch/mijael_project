<?php

if (!empty($_POST["btnregistrar"])) { //verificar el boton
	if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtCI"]) and !empty($_POST["txtcargo"]) ) {
		$nombre = $_POST["txtnombre"];
		$apellido = $_POST["txtapellido"];
		$CI = $_POST["txtCI"];
		$cargo = $_POST["txtcargo"];

            $sql=$conn->query(" SELECT COUNT(*) as 'total' from empleado where CI='$CI'");
            if ($sql->fetch_object()->total > 0) { ?>
               
                    <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "La cedula de Identidad <?= $CI ?> ya existe",
                        styling: "bootstrap3"
                    })
                })
        </script>


            <?php } else {
               $sql = $conn->query(" insert into empleado (nombre,apellido,CI,cargo)values('$nombre','$apellido',$CI,$cargo)");
if ($sql == true) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "Personal reguistrado",
                        styling: "bootstrap3"
                    })
                })
        </script>
    <?php   } else { ?>
        <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error al registrar",
                        styling: "bootstrap3"
                    })
                })
        </script>
        <?php }

            }
            
		
		} else { ?>
		<script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "Los campos estan vacios",
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

	
<?php	} 

?>