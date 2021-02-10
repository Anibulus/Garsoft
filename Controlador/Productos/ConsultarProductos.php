<?php
session_start();
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    header('Content-Type: application/json;');
    if(count($_POST)>0)
    {
        $conn=Conectar::conexion();

        $instruccion="select p.idProducto, mp.nombre as marca, t.nombre as tipo, cp.nombre as categoria, p.cantidad, 
            (select
            r.precio from precios r
            where p.idProducto=r.idProducto and 
            r.activo=1 and 
            r.garantia=0 limit 1) as precio,
            t.idCasco as casco,
            (select r.precio from cascos r
            where r.idCasco=t.idCasco) as precioCasco
        from producto p
        join categoriaProducto cp on p.idCategoria = cp.idCategoria
        join tipo t on p.idTipo = t.idTipo
        join marcaProducto mp on p.idMarca = mp.idMarca
        where p.idCategoria=".$_POST["categoria"]." and mp.idMarca=".$_POST["marca"];

        $result=$conn->query($instruccion);

        if($result){
            if($result->num_rows>0){
                $arreglo='[';
                for($i=0;$i<$result->num_rows;$i++){
                    $arreglo.=json_encode($result->fetch_assoc(),\JSON_UNESCAPED_UNICODE);
                    $arreglo.=$i==($result->num_rows-1)?"":",";
                }
                /*while($row = $result->fetch_assoc()){
                    //echo "Marca ".$row["marca"]." -  Categoría ".$row["categoria"]." - tipo ".$row["tipo"]." - precio ".$row["precio"]." - casco ".$row["casco"]." - Precio Casco ".$row["precioCasco"]."<br>";
                }*/
                echo $arreglo."]";
            }
            else
            {//Si no hay resultados
                echo json_encode(array());
            }
        }
        else
        {//Si no hay result
            echo json_encode(array());
        }
    }//Si no hay post
    else
    {
        echo json_encode(array());
    }
}
else{
    echo json_encode(array());
}
exit;
?>