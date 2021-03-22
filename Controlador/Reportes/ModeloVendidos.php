<?php
require("../../Modelo/Conexion/conexion.php");
require("../../Modelo/Reportes/modelosV.php"); 
header('Content-Type: application/json');

$conn=Conectar::conexion();

$result=$conn->query("select v.idModelo, mo.nombre as Modelo_Auto, (select distinct ma.nombre   from marcaauto ma join modeloauto mm on ma.idMarca = mm.idMarca ) as Marca_Auto, count(   v.idModelo) AS Total_Compras FROM venta v join modeloauto mo on v.idModelo = mo.idModelo   GROUP BY v.idModelo ORDER BY Total_Compras desc limit 50;");
$conn->close();
unset($conn);

if($result){
    $listado=array();

    for($i=0;$i<$result->num_rows;$i++){
        $row=$result->fetch_assoc();
        //Llenado del objeto
        $producto=new ModelosV();
        $producto->setidModelo($row["idModelo"]);
        $producto->setModelo_Auto($row["Modelo_Auto"]);
        $producto->setMarca_Auto($row["Marca_Auto"]);
        $producto->setTotal_Compras($row["Total_Compras"]);
        array_push($listado,$producto);
    }
    //var_dump($listado);
    echo json_encode($listado);
}else{
    echo json_encode(array());
}

?>