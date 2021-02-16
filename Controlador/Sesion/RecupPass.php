<?php
require("../../Modelo/Conexion/conexion.php");
//header('Content-Type: application/json');

$correo=$_POST["correo"];

$conn=Conectar::conexion();
$result=$conn->query("select u.contrasena 
from usuario u
join persona p on p.idPersona = u.idPersona
where correo ='".$correo."';");
$conn->close();

unset($conn);

if($result ->num_rows > 0){
    $row=$result->fetch_assoc(); //Fetch row es oatra manera
        
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $desde = "Acumuladores Garza";
    $destino = $correo;
    $asunto = "Recuperación de Contraseña";
    $mensaje = "Su contraseña es la siguiente:'".$row["contrasena"]."'";
    mail($destino,$asunto,$mensaje, $desde);
}
else{
    echo json_encode(0);
}

?>