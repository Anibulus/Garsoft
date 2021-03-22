<?php
//require("Categoria.php");
class VentasR{
    
    public $idVenta;
    public $fecha; 
    public $Cliente; 
    public $Modelo_Auto; 
    public $Marca_Auto; 
    public $Pago; 
    public $Vendio; 
    public $idProducto;
    public $Categoria; 
    public $Marca; 
    public $Tipo;

    public function __construct(){
        $idVenta=0;
        $fecha="";
        $Cliente="";
        $Modelo_Auto="";
        $Marca_Auto="";
        $Pago="";
        $Vendio="";
        $idProducto=0;
        $Categoria ="";
        $Marca ="";
        $Tipo="";
    }

    public function setidVenta($idVenta){
        $this->idVenta=$idVenta;
    }
    public function setfecha($fecha){
        $this->fecha=$fecha;
    }
    public function setCliente($Cliente){
        $this->Cliente=$Cliente;
    }
    public function setModelo_Auto($Modelo_Auto){
        $this->Modelo_Auto=$Modelo_Auto;
    }
    public function setMarca_Auto($Marca_Auto){
        $this->Marca_Auto=$Marca_Auto;
    }
    public function setPago($Pago){
        $this->Pago=$Pago;
    }
    public function setVendio($Vendio){
        $this->Vendio=$Vendio;
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
    
}
?>