<?php
session_start();
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    require("../../Modelo/NoCSRF.php");
    header('Content-Type: application/json;');
    
    if(count($_POST)>0)
    {
        if(intval($_POST["marca"])>=0 && intval($_POST["categoria"])>=0)
        {//Si contienen valores válidos
            try{//Validacion de sitios cruzados
                NoCSRF::check( 'csrf_token', $_POST, true, 60*10, true );   

                $conn=Conectar::conexion();

                //Validar que el producto no exista ya
                $instruccion="select * from producto
                where idCategoria=".$_POST["categoria"].", idMarca=".$_POST["marca"].", idTipo=".$_POST["tipo"].";";
                $result=$conn->query($instruccion);
                if($result){
                    $conn->close();
                    unset($conn);
                    unset($result);
                    unset($instruccion);
                    echo json_encode(2); // El producto ya existe
                }
                else
                {
                    /*Al insetar valida categoria entre otrad cosas para na correcta insercion*/
                    $instruccion="insert into producto 
                    (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) 
                    values
                    (null,";
                    //Si categoria es bateria 2 o 3, se deja el tipo
                    $instriccion.=($_POST["categoria"]!=1?$_POST["cantidad"]:"0").",
                    ".$_POST["categoria"].",
                    ".$_POST["marca"].",
                    ".($_POST["categoria"]==2 || $_POST["categoria"]==3?$_POST["tipo"]:"null")."
                    ,1);";

                    $result=$conn->query($instruccion);
                    $last_id = $conn->insert_id;
                    //todo  for
                    //Modificacion de precio
                    for($i =0; $i<count($_POST["precios"]);$i++){
                        $instruccion="insert into precios 
                        (idPrecio, idProducto, precio, garantia, fecha, activo) 
                        values 
                        (null,".$last_id.",".$_POST["precios"][$i]["precio"].",".$_POST["precios"][$i]["tipoprecio"].",curdate(),1);";

                        $result=$conn->query($instruccion);
                    }
                    

                    $conn->close();
                    unset($conn);        
                    if($result)
                    {
                        echo json_encode(1);
                    }
                    else
                    {//Si no hay result
                        echo json_encode(3);
                    }
                    unset($result);
                    unset($instruccion);
                }
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