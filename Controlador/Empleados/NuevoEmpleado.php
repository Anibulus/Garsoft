<?php
require("../../Modelo/Conexion/conexion.php");
header('Content-Type: application/json');

$conn=Conectar::conexion();

$nombre=$_POST["nombre"];
$apellidop=$_POST["apellidop"];
$apellidom=$_POST["apellidom"];
$correo=$_POST["correo"];
$telefono=$_POST["telefono"];
$usuario=$_POST["usuario"];
$pass=$_POST["pass"];
$tipo=$_POST["tipo"];

$result=$conn->query("select idPersona from persona where correo = '".$correo."';");

if ($result->num_rows>0) {
	echo json_encode(0);
}else {
	$result2=$conn->query("select idPersona from usuario where usuario = '".$usuario."';");
	if ($result2->num_rows>0) {
		echo json_encode(1);
	}else {
		$result3=$conn->query("call NuevoEmpleado('".$nombre."','".$apellidop."','".$apellidom."',".$correo."','".$telefono."','".$usuario."','".$pass."',".$tipo.");");

		if($result3){
			echo json_encode(2);
		}
		else {
			echo json_encode(3);
		}
	}
}

	
$conn->close();
unset($conn);
unset($nombre);
unset($apellidop);
unset($apellidom);
unset($correo);
unset($telefono);
unset($usuario);
unset($pass);
unset($tipo);


?>