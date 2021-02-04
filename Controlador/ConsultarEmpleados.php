<?php
require("../Modelo/Conexion/conexion.php");

$conn=Conectar::conexion();

$instruccion="select * from persona;";
$result=$conn->query($instruccion);

if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["idPersona"]. " - Name: " . $row["nombre"]. " " . $row["apellido1"]. "<br>";
    }
} 
else {
    echo "0 results";
}

//Cierra la conexion
$conn->close();
unset($conn);
?>