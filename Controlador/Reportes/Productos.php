<?php
require("../../Modelo/Conexion/conexion.php");
require("../../Modelo/Producto.php"); 
header('Content-Type: application/json');


$conn=Conectar::conexion();

$idc = $_POST["idc"];

$result=$conn->query("select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,p.cantidad,
(select pr.precio from precios pr where pr.idProducto = p.idProducto and pr.garantia=0 limit 1) as precioPublico,
(select pr2.precio from precios pr2 where pr2.idProducto = p.idProducto and pr2.garantia=1 limit 1) as precioGarantia
from producto p 
join categoriaProducto c on p.idCategoria = c.idCategoria
join marcaProducto m on p.idMarca = m.idMarca
left join tipo t on p.idTipo = t.idTipo
where c.idCategoria = '".$idc."'
order by p.idProducto");
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
        $producto->setPrecio($row["precioPublico"]);
        $producto->setPrecioGarantia($row["precioGarantia"]);
        $cant = $row["cantidad"];
        if ($cant = 0) {
            $producto->setPrecioTotal('0');
        }else{
            $cant = $row["cantidad"];
            $precio = $row["precioPublico"];
            $producto->setPrecioTotal($cant*$precio);
        }
        array_push($listado,$producto);
    }
    //var_dump($listado);
    echo json_encode($listado);
}else{
    echo json_encode(array());
}

?>