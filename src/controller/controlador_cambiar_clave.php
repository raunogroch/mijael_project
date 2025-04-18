<?php
// Verificar si la sesión no está ya iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtclaveActual"]) && !empty($_POST["txtclaveNueva"]) && !empty($_POST["txtid"])) {
        // Obtener y sanitizar datos
        $id = intval($_POST["txtid"]);
        $claveActual = md5($_POST["txtclaveActual"]);
        $claveNueva = md5($_POST["txtclaveNueva"]);
        
        // Verificar contraseña actual con prepared statement
        $verificarClaveActual = $conn->prepare("SELECT password FROM usuario WHERE id_usuario = ?");
        $verificarClaveActual->bind_param("i", $id);
        $verificarClaveActual->execute();
        $resultado = $verificarClaveActual->get_result();
        
        if ($resultado->num_rows > 0 && $resultado->fetch_object()->password == $claveActual) {
            // Actualizar contraseña con prepared statement
            $sql = $conn->prepare("UPDATE usuario SET password = ? WHERE id_usuario = ?");
            $sql->bind_param("si", $claveNueva, $id);
            $sql->execute();
            
            if ($sql->affected_rows > 0) {
                // Cerrar sesión existente
                session_unset();    // Elimina todas las variables de sesión
                session_destroy();  // Destruye la sesión
                
                // Iniciar nueva sesión temporal para el mensaje si es necesario
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['mensaje_exito'] = "Contraseña modificada correctamente";
                
                ?>
                <script>
                $(function() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "<?= addslashes($_SESSION['mensaje_exito']) ?>",
                        styling: "bootstrap3"
                    });
                    window.location.href = "login";
                });
                </script>
                <?php
                exit();
            } else {
                mostrarError("Error al modificar la contraseña");
            }
        } else {
            mostrarError("Contraseña actual incorrecta");
        }
    } else {
        mostrarError("Todos los campos son obligatorios");
    }
}

// Función auxiliar para mostrar errores
function mostrarError($mensaje) {
    ?>
    <script>
    $(function() {
        new PNotify({
            title: "ERROR",
            type: "error",
            text: "<?= addslashes($mensaje) ?>",
            styling: "bootstrap3"
        });
    });
    </script>
    <?php
}
?>

<script>
// Limpiar URL después de la operación
setTimeout(() => {
    window.history.replaceState(null, null, window.location.pathname);
}, 0);
</script>