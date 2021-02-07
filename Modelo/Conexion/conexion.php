<?php
class Conectar{   

    public static function conexion(){
        $server="localhost";
        $db="garsoft";
        $user="root";
        $pass="";
        $port=3306;

        $conn = new mysqli($server, $user, $pass, $db, $port);
        
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }       
        return $conn;
    }//Fin de funcion
}//Fin de la clase

?>
