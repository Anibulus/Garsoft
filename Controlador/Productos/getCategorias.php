<?php
require("../../Modelo/Conexion/conexion.php");
require("../../Modelo/Categoria.php");
header('Content-Type: application/json; charset=iso-8859-1 ');//utf-8

session_start();
if(isset($_SESSION["nombre"])){
    $conn=Conectar::conexion();
    $result=$conn->query("select * from categoriaProducto;");
    $conn->close();
    unset($conn);
    if($result){
        $listado=array();

        for($i=0;$i<$result->num_rows;$i++){
            $row=$result->fetch_assoc();
            //Llenado del objeto
            $categoria=new Categoria();
            $categoria->setIdCategoria($row["idCategoria"]);
            $categoria->setNombre($row["nombre"]);
            array_push($listado,$categoria);
        }
        //var_dump($listado);
        echo json_encode($listado);
    }else{
        echo json_encode(array());
    }
    unset($result);
}
else{
    echo json_encode(array());
}
exit();
?>