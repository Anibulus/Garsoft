<?php
require("../../Modelo/Conexion/conexion.php");
require("../../Modelo/Producto.php"); 
header('Content-Type: application/json');


$conn=Conectar::conexion();
$result=$conn->query("select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,p.cantidad 
from producto p 
join categoriaproducto c on p.idCategoria = c.idCategoria
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo order by p.idProducto limit 100;");
$conn->close();
unset($conn);

if($result){
    $listado=array();

    for($i=0;$i<$result->num_rows;$i++){
        $row=$result->fetch_assoc();
        //Llenado del objeto
        $producto=new Producto();
        $producto->setIdProducto($row["idProducto"]);
        $producto->setCategoria($row["Categoria"]);
        $producto->setMarca($row["Marca"]);
        $producto->setTipo($row["Tipo"]);
        $producto->setStock($row["cantidad"]);
        array_push($listado,$producto);
    }
    //var_dump($listado);
    echo json_encode($listado);
}else{
    echo json_encode(array());
}

?>