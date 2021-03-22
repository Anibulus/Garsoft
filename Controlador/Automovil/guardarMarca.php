<?php
session_start();

if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    require("../../Modelo/NoCSRF.php");
    header('Content-Type: application/json;');
    
    if(count($_POST)>0)
    {        
        try{//Validacion de sitios cruzados
            //NoCSRF::check( 'csrf_token', $_POST, true, 60*10, true );   

            $conn=Conectar::conexion();
            //Validar que el producto no exista ya
            $intruccion="SELECT * FROM marcaAuto WHERE nombre='".$_POST["marca"]."';";
            $result=$conn->query($intruccion);            

            if($result->num_rows==0){
                $intruccion="INSERT INTO marcaAuto (idMarca, nombre) VALUES (null,'".$_POST["marca"]."');";
                $result=$conn->query($intruccion);
                if($result){
                    echo json_encode(1); //Guardo
                }
                else{
                    echo json_encode(0); //No Guardo
                }
            }
            else
                echo json_encode(2);//No guardo
            $conn->close();
            unset($conn);
            unset($result);
            unset($instruccion);
        }catch(Exception $ex){
            echo $ex->getMessage();
        }
    }//Fin de post
    else
    {
        echo json_encode(0);
    }

}
else
{

}
?>