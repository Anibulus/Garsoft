<?php
session_start();
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    require("../../Modelo/NoCSRF.php");
    //header('Content-Type: application/json;');
    
    if(count($_POST)>0)
    {
        if(intval($_POST["idModelo"])>=0 && intval($_POST["idMarca"])>=0)
        {//Si contienen valores válidos
            try{//Validacion de sitios cruzados
                NoCSRF::check( 'csrf_token', $_POST, true, 60*10, true );   

                $conn=Conectar::conexion();

                //Validar que el producto no exista ya
                for($i =0; $i<count($_POST["baterias"]);$i++){
                    $instruccion="insert into intermediamodeloauto_tipo (idTipo,idModelo) 
                    VALUES 
                    (".$_POST["baterias"][$i]["idTipo"].",".$_POST["baterias"][$i]["idModelo"].");";

                    $result=$conn->query($instruccion);
                }//Fin de for
                $conn->close();
                var_dump($result);
                if($result)
                    echo json_encode(1); //Guardo
                else
                    echo json_encode(2);//No guardo
                unset($conn);
                unset($result);
                unset($instruccion);
            }catch(Exception $ex){
                echo $ex->getMessage();
            }            
        }
        else
        {
            echo json_encode(0);
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