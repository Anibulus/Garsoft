<?php
session_start();
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    require("../../Modelo/NoCSRF.php");
    header('Content-Type: application/json;');    

    if(count($_POST)>0)
    {

        if (isset($_POST['idcli']) && isset($_POST['idpago']) ) 
        {
            $conn=Conectar::conexion();
            $idcli = $_POST["idcli"];
            $idpago = $_POST["idpago"];
            

            $result=$conn->query("insert into venta  
                values
                (null, year(curdate()), current_timestamp(), null,". $_SESSION['idPersona'].",".$idcli.",".$idpago.");");
            $last_id=0;
            $last_id = $conn->insert_id;

            if($result)
            {

                for($i =0; $i<count($_POST["productos"]);$i++)
                {                        
                    $instruccion="insert into intermediaVentaProductoSalida
                    values 
                        (".$last_id.",".$_POST["productos"][$i]["idProducto"].",".$_POST["productos"][$i]["cantidad"].",".$_POST["productos"][$i]["subtotal"].");";
                    $result=$conn->query($instruccion);
                } //Fin de for
                if ($result) {
                        echo json_encode(1);
                }else{
                    echo json_encode(8);  
                }
                    
            }
                
            else

            {//Si no hay result
                echo json_encode(3);
            }

            $conn->close();
            unset($conn);
            unset($result);
            unset($instruccion);
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
