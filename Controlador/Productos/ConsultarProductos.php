<?php
session_start();
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    header('Content-Type: application/json;');
    if(count($_POST)>0)
    {
        $conn=Conectar::conexion();

        //TODO si garantia no es 2, cambiar a otra consulta
        $instruccion="select distinct p.idProducto, mp.nombre as marca, cp.nombre as categoria, p.cantidad, 
        r.precio, r.idPrecio ".($_POST["categoria"]==2 || $_POST["categoria"]==3 ?", t.nombre as tipo, t.idCasco as casco, c.precio as  precioCasco ":"").
        "from producto p
        join categoriaProducto cp on p.idCategoria = cp.idCategoria ".
        ($_POST["categoria"]==2 || $_POST["categoria"]==3 ?"join tipo t on p.idTipo = t.idTipo
        join cascos c on t.idCasco = c.idCasco ":"").
        "join marcaProducto mp on p.idMarca = mp.idMarca
        join precios r on p.idProducto=r.idProducto
        where p.idCategoria=".$_POST["categoria"]." and mp.idMarca=".$_POST["marca"]."
        and r.activo=1 and r.garantia=".$_POST["garantia"]."
        order by ".($_POST["categoria"]==2 || $_POST["categoria"]==3? "tipo asc, " :"")." p.cantidad ;";//TODO agregar idPrecio

        $result=$conn->query($instruccion);

        $conn->close();
        unset($conn);
        unset($instruccion);       
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
        unset($result);
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