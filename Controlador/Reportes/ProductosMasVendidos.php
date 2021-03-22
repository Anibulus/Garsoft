<?php
require("../../Modelo/Conexion/conexion.php");
require("../../Modelo/Reportes/productosMasVendidos.php"); 
header('Content-Type: application/json');

$conn=Conectar::conexion();

$result=$conn->query("select v.idVenta, pr.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,
count(i.idproducto) AS Vendido
FROM venta v 
join intermediaventaproductosalida i on v.idVenta = i.idVenta
join producto pr on pr.idProducto = i.idProducto
join categoriaproducto c on pr.idCategoria = c.idCategoria
join marcaproducto m on pr.idMarca = m.idMarca
join tipo t on pr.idTipo = t.idTipo
GROUP BY v.idModelo ORDER BY Vendido desc limit 50");
$conn->close();
unset($conn);

if($result){
    $listado=array();

    for($i=0;$i<$result->num_rows;$i++){
        $row=$result->fetch_assoc();
        //Llenado del objeto
        $producto=new ProductosV();
        $producto->setidVenta($row["idVenta"]);
        $producto->setidProducto($row["idProducto"]);
        $producto->setCategoria($row["Categoria"]);
        $producto->setMarca($row["Marca"]);
        $producto->setTipo($row["Tipo"]);
        $producto->setVendido($row["Vendido"]);
        array_push($listado,$producto);
    }
    //var_dump($listado);
    echo json_encode($listado);
}else{
    echo json_encode(array());
}

?>