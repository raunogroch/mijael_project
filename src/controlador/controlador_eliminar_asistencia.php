<?php
// Asumiendo que $conn es una instancia de conexión a la base de datos y está correctamente inicializada
if (!empty($_GET["id"])) {
    // Sanitizar y validar el ID
    $id = intval($_GET["id"]);

    // Preparar la consulta SQL
    $stmt = $conn->prepare("DELETE FROM asistencia WHERE id_asistencia = ?");
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $status = "success";
        $message = "Asistencia Eliminada Correctamente";
    } else {
        $status = "error";
        $message = "Error al eliminar";
    }

    // Cerrar la declaración
    $stmt->close();

    // Imprimir el script de notificación
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/5.2.0/PNotify.js"></script>';
    echo '<script>';
    echo '$(function() {';
    echo '    new PNotify({';
    echo '        title: "' . ($status == "success" ? "CORRECTO" : "INCORRECTO") . '",';
    echo '        type: "' . $status . '",';
    echo '        text: "' . $message . '",';
    echo '        styling: "bootstrap3"';
    echo '    });';
    echo '});';
    echo '</script>';

    // Redirigir o actualizar la página
    echo '<script>';
    echo 'setTimeout(() => {';
    echo '    window.history.replaceState(null, null, window.location.pathname);';
    echo '}, 0);';
    echo '</script>';
}
?>
