<?php
require("../../Modelo/Conexion/conexion.php");
require("../../Modelo/Carrito.php");
header('Content-Type: application/json;');

session_start();
if(isset($_SESSION["nombre"])){
    try{//Validacion de sitios cruzados
                   
        $conn=Conectar::conexion();   

        $tipo=$_POST["tipo"];
        $marca=$_POST["marca"];

        
        $result=$conn->query("select p.idProducto, mp.nombre as marca, t.nombre as tipo, cp.nombre as categoria, p.cantidad, r.precio, r.idPrecio, t.idCasco as casco,(select r.precio from cascos r where r.idCasco=t.idCasco) as precioCasco from producto p join categoriaProducto cp on p.idCategoria = cp.idCategoria join tipo t on p.idTipo = t.idTipo join marcaProducto mp on p.idMarca = mp.idMarca join precios r on p.idProducto=r.idProducto where mp.idMarca = ".$marca." and t.idTipo =".$tipo.";");

        $conn->close();
        unset($conn);
        if($result){
            $listado=array();
            for($i=0;$i<$result->num_rows;$i++){
                $row=$result->fetch_assoc();
                $obj=new Carrito();
                $obj->setIdProd($row["idProducto"]);
                $obj->setMarca($row["marca"]);
                $obj->setTipo($row["tipo"]);
                $obj->setCatego($row["categoria"]);
                $obj->setCantidad($row["cantidad"]);
                $obj->setPrecio($row["precio"]);
                $obj->setIdPrecio($row["idPrecio"]);
                $obj->setCasco($row["casco"]);
                $obj->setPrecioCasco($row["precioCasco"]);
                
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