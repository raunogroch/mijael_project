<?php
session_start();
if(!empty($_POST["btningresar"])){
	if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
		
		$usuario=$_POST['usuario'];
		$password=md5($_POST['password']);
		$query= mysqli_query($conn, "SELECT * FROM usuario WHERE usuario = '".$usuario."'and password='".$password."'");
// $nr = mysqli_num_rows($query);
//$nr ==1
 if ($datos=$query->fetch_object()) {

 	$_SESSION["nombre"]=$datos->usuario;
 	$_SESSION["apellido"]=$datos->apellido;
 		$_SESSION["id"]=$datos->id_usuario;
 		header("location: principal");

      

 		  } 
 else{echo " <div class='alert alert-danger'> el usuario no existe </div>";
 }



		}else{

echo " <div class='alert alert-danger'> los campos estan vacios </div>";
		}

}

  ?>