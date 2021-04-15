<?php
require("../../Modelo/Conexion/conexion.php");
require("../../Modelo/Reportes/ventas.php"); 
header('Content-Type: application/json');


$conn=Conectar::conexion();

$anio = $_POST["anio"];
$mes = $_POST["mes"];

$result=$conn->query("select v.idVenta,v.fecha,
(select DISTINCT concat(p.nombre,' ',p.apellido1)from persona p join cliente cl on p.idPersona = cl.idPersona where v.idCliente=cl.idPersona limit 1) as Cliente, 
f.descripcion as Pago,pe.nombre as Vendio,p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo
from venta v
join persona pe on v.idEmpleado = pe.idPersona
join formaPago f on v.idFormaPago = f.idFormaPago
join intermediaVentaProductoSalida i on v.idVenta = i.idVenta
join producto p on p.idProducto = i.idProducto
join categoriaProducto c on p.idCategoria = c.idCategoria
join marcaProducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo
where MONTHNAME(v.fecha) = '".$anio."' and v.anio ='".$mes."' order by v.fecha desc;");
$conn->close();
unset($conn);

if($result){
    $listado=array();

    for($i=0;$i<$result->num_rows;$i++){
        $row=$result->fetch_assoc();
        //Llenado del objeto
        $ventas=new VentasR();
        $ventas->setidVenta($row["idVenta"]);
        $ventas->setfecha($row["fecha"]);
        $ventas->setCliente($row["Cliente"]);
        //$ventas->setModelo_Auto($row["Modelo_Auto"]);
        //$ventas->setMarca_Auto($row["Marca_Auto"]);
        $ventas->setPago($row["Pago"]);
        $ventas->setVendio($row["Vendio"]);
        $ventas->setidProducto($row["idProducto"]);
        $ventas->setCategoria($row["Categoria"]);
        $ventas->setMarca($row["Marca"]);
        $ventas->setTipo($row["Tipo"]);
        array_push($listado,$ventas);
    }
    //var_dump($listado);
    echo json_encode($listado);
}else{
    echo json_encode(array());
}

?>