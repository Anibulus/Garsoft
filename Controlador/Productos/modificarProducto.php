<?php
session_start();
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    require("../../Modelo/NoCSRF.php");
    header('Content-Type: application/json;');
    if(count($_POST)>0)
    {
        if(intval($_POST["cantidad"])>=0 && intval($_POST["precio"])>=0)
        {//Si contienen valores válidos
            try{//Validacion de sitios cruzados
                //var_dump($_SESSION);
                //var_dump($_POST);
                //NoCSRF::check( 'csrf_token', $_POST, true, 60*10, true );           
                $conn=Conectar::conexion();

                //Modificacion de cantidad
                $instruccion="update producto p set cantidad=".$_POST["cantidad"]."
                where p.idProducto=".$_POST["idProducto"];

                $result=$conn->query($instruccion);

                //Modificacion de precio
                $instruccion="update precios p set precio=".$_POST["precio"]."
                where p.idProducto=".$_POST["idProducto"]." and 
                idPrecio=".$_POST["idPrecio"];

                $result=$conn->query($instruccion);


                $conn->close();
                unset($conn);        
                if($result)
                {
                    echo json_encode(1);
                }
                else
                {//Si no hay result
                    echo json_encode(2);
                }
                unset($result);
                unset($instruccion);
            }catch(Exception $ex){
                echo $ex->getMessage();
            }
        }//Fin de POST
        else
        {
            echo json_encode(0);
        }
    }//Fin de post
    else
    {
        echo json_encode(0);
    }
}//Fin de sesion iniciada
else
{
    echo json_encode(0);
}
exit;
?>