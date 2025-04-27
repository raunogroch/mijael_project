<?php
session_start();

if (empty($_SESSION["nombre"]) || empty($_SESSION["apellido"])) {
    header('Location: login');
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'].'/model/conexion.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/controller/controlador_eliminar_asistencia.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/functions.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Asistencia</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        ul li:nth-child(1) .activo {
            background: rgb(11, 150, 214) !important;
        }
        .btn-successs {
            background-color: #28a745;
            color: white;
        }
        .page-content {
            padding: 20px;
        }
        table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<!-- Topbar - Ruta corregida -->
<?php require $_SERVER['DOCUMENT_ROOT'].'/views/layout/topbar.php'; ?>

<!-- Sidebar - Ruta corregida -->
<?php require $_SERVER['DOCUMENT_ROOT'].'/views/layout/sidebar.php'; ?>

<!-- Contenido principal -->
<div class="page-content">
    <h4 class="text-center text-secondary mb-4">Lista de Asistencia</h4>

    <?php
    $sql = $conn->query("SELECT asistencia.id_asistencia,
                            asistencia.id_empleado,
                            asistencia.entrada,
                            asistencia.salida,
                            empleado.id_empleado,
                            empleado.nombre as 'nom_empleado',
                            empleado.apellido,
                            empleado.CI,
                            empleado.cargo,
                            cargo.id_cargo,
                            cargo.nombre as 'nom_cargo'
                     FROM asistencia
                     INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado
                     INNER JOIN cargo ON empleado.cargo = cargo.id_cargo
                     ORDER BY asistencia.id_asistencia DESC");
    ?>

    <div class="text-end mb-3">
        <a href="attendance_report" target="_blank" class="btn btn-successs me-2">
            <i class="fas fa-file-pdf"></i> GENERAR REPORTE PDF
        </a>
        <a href="attendance_custom_report" class="btn btn-primary">
            <i class="fas fa-plus"></i> MÁS REPORTES
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="tablaAsistencia">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">CARGO</th>
                <th scope="col">FECHA</th>
                <th scope="col">ENTRADA</th>
                <th scope="col">SALIDA</th>
                <th scope="col">ESTADO</th>
                <th scope="col">ACCIONES</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $index = 1;
            while($datos = $sql->fetch_object()):
                ?>
                <tr>
                    <td><?= $index++ ?></td>
                    <td><?= htmlspecialchars($datos->nom_empleado . " " . $datos->apellido) ?></td>
                    <td><?= htmlspecialchars($datos->nom_cargo) ?></td>
                    <td class="text-center"><?= date("Y-m-d", strtotime($datos->entrada)) ?></td>
                    <td class="text-center"><?= date("H:i:s", strtotime($datos->entrada)) ?></td>
                    <td class="text-center"><?= !empty($datos->salida)?date("H:i:s", strtotime($datos->salida)):"" ?></td>
                    <td class="text-center"><?php echo VerifyExitAttendace($datos->entrada, $datos->salida); ?></td>
                    <td class="text-center">
                        <a href="principal?id=<?= $datos->id_asistencia ?>" onclick="return confirm('¿Está seguro que desea eliminar esta asistencia?')"
                           class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i> Eliminar
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Footer - Ruta corregida -->
<?php require $_SERVER['DOCUMENT_ROOT'].'/views/layout/footer.php'; ?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tablaAsistencia').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });

    // Función de confirmación mejorada
    function confirmarEliminacion(event) {
        if (!confirm('¿Está seguro que desea eliminar esta asistencia?')) {
            event.preventDefault();
        }
    }
</script>
</body>
</html>