<?php
session_start();

if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    require("../../Modelo/Modelo.php");
    require("../../Modelo/NoCSRF.php");
    header('Content-Type: application/json;');
    
    if(count($_POST)>0)
    {        
        try{//Validacion de sitios cruzados
            //NoCSRF::check( 'csrf_token', $_POST, true, 60*10, true );   

            $conn=Conectar::conexion();
            //Validar que el producto no exista ya
            $intruccion="select t.nombre as tipo, ma.nombre as modelo, ma.anioInicio, ma.anioFin, maa.nombre as marca, mp.nombre as marcaProducto, p.cantidad, mp.mesesGarantia
            from tipo t
            join intermediamodeloauto_tipo imt on imt.idTipo = t.idTipo
            join modeloauto ma on imt.idModelo=ma.idModelo
            join marcaauto maa on ma.idMarca=maa.idMarca
            join producto p on t.idTipo=p.idTipo
            join marcaproducto mp on p.idMarca=mp.idMarca
            where ma.idModelo=".$_POST["idModelo"]."
            order by maa.idMarca, ma.idModelo;";
            $result=$conn->query($intruccion);
            //var_dump($result);
            if($result)
            {
                $listado=array();
                    /*$row=$result->fetch_assoc();
                    $producto=new Producto();

                    //Llenado del objeto
                    $modelo=new Modelo();
                    $modelo->idModelo=$row["idModelo"];
                    $modelo->nombre=$row["modelo"];
                    $modelo->anioInicio=$row["anioInicio"];
                    $modelo->anioFin=$row["anioFin"];
                    $modelo->
                    array_push($listado,$modelo);*/
                    $arreglo='[';
                for($i=0;$i<$result->num_rows;$i++){
                    $arreglo.=json_encode($result->fetch_assoc(),\JSON_UNESCAPED_UNICODE);
                    $arreglo.=$i==($result->num_rows-1)?"":",";
                }
                echo $arreglo."]";                        
                //var_dump($listado);
                //echo json_encode($listado);
            }
            else
                echo json_encode(array());//No guardo
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
        echo json_encode(array());
    }

}
else
{

}
?>