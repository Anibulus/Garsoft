<?php
require("Categoria.php");
class Producto{
    public $idProducto;
    public $categoria;
    public $marca;
    public $tipo;
    public $stock;

    public function __construct(){
        $idProducto=0;
        $categoria="";
        $marca="";
        $tipo="";
        $stock="";//Dis
    }

    public function setIdProducto($id){
        $this->idProducto=$id;
    }
    public function setCategoria($cate){
        $this->categoria=$cate;
    }
    public function setMarca($marca){
        $this->marca=$marca;
    }
    public function setTipo($tipo){
        $this->tipo=$tipo;
    }
    public function setStock($stock){
        $this->stock=$stock;
    }
    
}
?>