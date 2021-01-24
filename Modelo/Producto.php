<?php
require("Categoria.php");
class Producto{
    private $idProducto;
    private $nombre;
    private $categoria;
    private $stock;//Disponilidad

    public function __construct(){
        $idProducto=0;
        $nombre="";
        $categoria=new Categoria();
        $stock=0;
    }//Fin del constructor
}//Fin de la clase
?>