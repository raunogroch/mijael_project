<?php
if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtCI"])) {
        $CI = $_POST["txtCI"];
        $consulta = $conn->query("SELECT COUNT(*) as 'total' from empleado where CI='$CI' ");
        $id = $conn->query("SELECT id_empleado from empleado where CI='$CI' ");
        if ($consulta->fetch_object()->total > 0) {

            $fecha = date("Y-m-d H:i:s");
            $id_empleado = $id->fetch_object()->id_empleado;

            $consultafecha = $conn->query(" SELECT entrada  from asistencia WHERE id_empleado=$id_empleado order by  id_asistencia desc limit 1");
            $fechaBD = $consultafecha->fetch_object()->entrada;
//CONTRO DE FECHA
            if (substr($fecha, 0, 10) == substr($fechaBD, 0, 10)) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: " Ya Registraste tu entrada ",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php } else {


                $sql = $conn->query(" insert into asistencia(id_empleado,entrada)values($id_empleado,'$fecha') ");

                if ($sql == true) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "CORRECTO",
                                type: "success",
                                text: " Correcto, Bienvenido",
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
                                text: " Error al Registrar la Asistencia ",
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
                        title: "INCORRECTO",
                        type: "error",
                        text: " La Cedula de Identidad no existe ",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: " Ingrese su Cedula de Identidad ",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php }

    ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>


    <?php
}
?>

<!-- salida -->

<?php
if (!empty($_POST["btnsalida"])) {
    if (!empty($_POST["txtCI"])) {
        $CI = $_POST["txtCI"];
        $consulta = $conn->query("SELECT COUNT(*) as 'total' from empleado where CI='$CI' ");
        $id = $conn->query("SELECT id_empleado from empleado where CI='$CI' ");
        if ($consulta->fetch_object()->total > 0) {

            $fecha = date("Y-m-d H:i:s");
            $id_empleado = $id->fetch_object()->id_empleado;
            $busqueda = $conn->query(" select id_asistencia, entrada from asistencia where id_empleado=$id_empleado order by id_asistencia desc limit 1 ");
            while ($datos = $busqueda->fetch_object()) {

                $id_asistencia = $datos->id_asistencia;
                $entradaBD = $datos->entrada;
            }
            if (substr($fecha, 0, 10) != substr($entradaBD, 0, 10)) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: " Primero registra tu asistencia",
                            styling: "bootstrap3"
                        })
                    })
                </script>
            <?php } else {

                $consultafecha = $conn->query(" SELECT salida  from asistencia WHERE id_empleado=$id_empleado order by  id_asistencia desc limit 1");
                $fechaBD = $consultafecha->fetch_object()->salida;
                if (substr($fecha, 0, 10) == substr($fechaBD, 0, 10)) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "INCORRECTO",
                                type: "error",
                                text: " Ya registro su salida",
                                styling: "bootstrap3"
                            })
                        })
                    </script>
                <?php } else {

                    $sql = $conn->query(" update asistencia set salida='$fecha' where id_asistencia=$id_asistencia ");

                    if ($sql == true) { ?>
                        <script>
                            $(function notificacion() {
                                new PNotify({
                                    title: "CORRECTO",
                                    type: "success",
                                    text: " Correcto, Hasta Pronto",
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
                                    text: " Error al Registrar Salida ",
                                    styling: "bootstrap3"
                                })
                            })
                        </script>
                    <?php }
                }
            }


        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: " La Cedula de Identidad no existe ",
                        styling: "bootstrap3"
                    })
                })
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: " Ingrese su Cedula de Identidad ",
                    styling: "bootstrap3"
                })
            })
        </script>
    <?php }

    ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>


    <?php
}
?>

