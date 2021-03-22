<?php
//require("Categoria.php");
class ProductosV{

    public $idVenta;
    public $idProducto;
    public $Categoria;
    public $Marca;
    public $Tipo;
    public $Vendido;
    
    public function __construct(){
        $idVenta=0;
        $idProducto=0;
        $Categoria="";
        $Marca="";
        $Tipo="";
        $Vendido="";
    }

    public function setidVenta($idVenta){
        $this->idVenta=$idVenta;
    }
    public function setidProducto($idProducto){
        $this->idProducto=$idProducto;
    }
    public function setCategoria($Categoria){
        $this->Categoria=$Categoria;
    }
    public function setMarca($Marca){
        $this->Marca=$Marca;
    } 
    public function setTipo($Tipo){
        $this->Tipo=$Tipo;
    } 
    public function setVendido($Vendido){
        $this->Vendido=$Vendido;
    }    
}
?>