<?php 
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> bien venido</title>
    <link rel="stylesheet" href="public/estilos/estilos.css">

   
        

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Martian+Mono:wght@100..800&display=swap" rel="stylesheet">

<!-- pNotify -->
        <link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
        <link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
        <link href="public/pnotify/css/custom.min.css" rel="stylesheet" />

        

        <!-- pnotify -->
        <script src="public/pnotify/js/jquery.min.js">
        </script>
        <script src="public/pnotify/js/pnotify.js">
        </script>
        <script src="public/pnotify/js/pnotify.buttons.js">
        </script>



</head>
<body>
    <?php date_default_timezone_set("America/La_Paz");
     ?>
    <h1> <center> BIENVENIDO, REGISTRA TU ASISTENCIA </center> </h1>
     <h1> <center> INSTITUTO MATEMA  </center></h1>
    <h2 id="fecha"> <?= date("d/m/Y, h:i:s") ?> </h2>
    <?php 
    include "modelo/conexion.php";
    include "controlador/controlador_registrar_asistenacia.php";
    ?>
    <div class="container">
        <a class="acceso" href="vista/login/login.php">ingresar al sistema</a>
        <p class="CI">Ingrese su N° de Cedula de Identidad </p>
        <form  action="" method="POST">
            <input type="number" placeholder="N° C.I." name="txtCI" id="txtCI">
            <div class="botones">
                
            
                <button id="entrada" class="entrada" type="submit" name="btnentrada" value="ok"> ENTRADA </button>
                <button  id="salida" class="salida" type="submit" name="btnsalida" value="ok"> SALIDA </button>


            </div>
            
        </form>
    </div>

    <script >
        
            

            setInterval(() => {
            let fecha=new Date();
            let fechaHora=fecha.toLocaleString();
            document.getElementById("fecha").textContent=fechaHora;

            },1000);

    </script>

<script > 
//controlador de digitos

let CI= document.getElementById("txtCI");
CI.addEventListener("input", function()
{
    if (this.value.length > 10) {

        this.value=this.value.slice(0,10)
    }

})
// salida botones

 document.addEventListener("keyup", function(event){
    if (event.code=="ArrowLeft") {

        document.getElementById("entrada").click()

    } else { 
        if (event.code=="ArrowRight") {
            document.getElementById("salida").click()
        }
    }
 }
    )
 </script>


</body>
</html>