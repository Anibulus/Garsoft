<?php
require("../../Modelo/Conexion/conexion.php");
require("../../Modelo/NoCSRF.php");
require("../../Modelo/Cliente.php");
header('Content-Type: application/json;');

session_start();
if(isset($_SESSION["nombre"])){
    try{//Validacion de sitios cruzados
        //NoCSRF::check( 'csrf_token', $_POST, true, 60*10, true );            
        $conn=Conectar::conexion();        
        $result=$conn->query("select * from cliente c
        join persona p on c.idPersona=p.idPersona
        where 
        p.nombre like '%".$_POST["nombre"]."%' or
        p.apellido1 like '%".$_POST["nombre"]."%' or
        p.apellido2 like '%".$_POST["nombre"]."%';");
        $conn->close();
        unset($conn);
        if($result){
            $listado=array();
            for($i=0;$i<$result->num_rows;$i++){
                $row=$result->fetch_assoc();
                $obj=new Cliente();
                $obj->idCliente=$row["idPersona"];
                $obj->nombre=$row["nombre"]." ".$row["apellido1"]." ".$row["apellido2"];
                array_push($listado,$obj);
            }
            echo json_encode($listado);
        }
        else
        {
            echo json_encode(array());
        }
        unset($result);

    }catch(Exception $ex){

    }//Fin Si no tiene token
}//Si no hay sesion activa
else{
    echo json_encode(array());
}
?>