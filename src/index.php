<?php
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
$basepath = '/';


switch (str_replace($basepath, '', $request)) {
    case '':
    case '/':
        require 'views/main.php';
        break;
    case 'profile':
        require 'views/perfil.php';
        break;
    case 'update_password':
        require 'views/cambiar_contra.php';
        break;
    case 'principal':
        require 'views/inicio.php';
        break;
    case 'users': 
        require 'views/usuario.php';
        break;
    case 'users_new': 
        require 'views/registro_usuario.php';
        break;
    case 'users_report': 
        require 'views/fpdf/ReporteUsuario.php';
        break;
    case 'staff': 
        require 'views/empleado.php';
        break;
    case 'staff_register': 
        require 'views/registro_empleado.php';
        break;
    case 'staff_report': 
        require 'views/fpdf/ReporteEmpleado.php';
        break;
    case 'attendance': 
        require 'views/inicio.php';
        break;
    case 'attendance_report': 
        require 'views/fpdf/ReporteAsistencia.php';
        break;
    case 'attendance_custom_report': 
        require 'views/Reporte_Asistencia.php';
        break;
    case 'attendance_custom_report_date': 
        require 'views/fpdf/ReporteAsistenciaFecha.php';
        break;
    case 'position': 
        require 'views/cargo.php';
        break;
    case 'position_report': 
        require 'views/fpdf/ReporteCargo.php';
        break;
    case 'about': 
        require 'views/acerca.php';
        break;
    case 'login':
        require 'views/login/login.php';
        break;
    case 'logout':
        require 'controller/controlador_cerrar.php';
        break;
    default:
        http_response_code(404);
        require 'views/404.php';
        break;
}