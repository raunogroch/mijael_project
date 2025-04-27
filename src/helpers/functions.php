<?php
function VerifyExitAttendace($in, $out)
{
    $tiempo = 3;
    $entrada = new DateTime($in);

    if(!empty($out)) {
        $salida = new DateTime($out);
        if ($entrada->format('Y-m-d') < $salida->format('Y-m-d')) {
            return "Abandono";
        } else {
            $entrada_actualizada = new DateTime($in);
            $entrada_actualizada->modify("+{$tiempo} hours");
            $hora_actual = new DateTime($out);
            // Comparamos si la hora de salida es mayor a la hora de entrada + tiempo
            if ($hora_actual > $entrada_actualizada) {
                $diferencia = $entrada_actualizada->diff($hora_actual);
                $total_minutos = ($diferencia->h * 60) + $diferencia->i;
                if ($total_minutos < 60) {
                    return "Retraso: {$total_minutos}m";
                } else {
                    $horas_retraso = floor($total_minutos / 60);
                    $minutos_retraso = $total_minutos % 60;
                    return "Retraso: {$horas_retraso}h {$minutos_retraso}m";
                }
            }
        }
    }
    if(empty($out)){
        $salida = new DateTime(); // Fecha y hora actual
        $diferencia = $entrada->diff($salida);
        $horas = $diferencia->h + ($diferencia->days * 24);
        if ($entrada->format('Y-m-d') < $salida->format('Y-m-d')) {
            return "Abandono";
        }
        if ($horas >= $tiempo) {
            $entrada_actualizada = new DateTime($in);
            $entrada_actualizada->modify("+{$tiempo} hours");
            $hora_actual = new DateTime();
            $diferencia = $entrada_actualizada->diff($hora_actual);

            $total_minutos = ($diferencia->h * 60) + $diferencia->i;

            if ($total_minutos < 60) {
                return "Retraso: {$total_minutos}m";
            } else {
                $horas_retraso = floor($total_minutos / 60);
                $minutos_retraso = $total_minutos % 60;
                return "Retraso: {$horas_retraso}h {$minutos_retraso}m";
            }
        }
    }
}