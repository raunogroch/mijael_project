<?php
if (!empty($_GET["id"])) {
	$id=$_GET["id"];
 	$sql = $conn->query(" delete from cargo where id_cargo=$id ");
 	if ( $sql == true) { ?>
 		<script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "Area Eliminado correctamente",
                        styling: "bootstrap3"
                    })
                })
        </script>
 	<?php  
 		// code...
 	} else { ?>
 		<script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "	Error",
                        text: "Error al elimnar",
                        styling: "bootstrap3"
                    })
                })
        </script>
 	<?php  } ?>
	 <script> 
        setTimeout(()=>{
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
     </script>
<?php 
 	}
?>