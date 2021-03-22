<?php
//require("Categoria.php");
class ModelosV{

    public $idModelo;
    public $Modelo_Auto;
    public $Marca_Auto;
    public $Total_Compras;

    public function __construct(){
        $idModelo=0;
        $Modelo_Auto="";
        $Marca_Auto="";
        $Total_Compras="";
    }

    public function setidModelo($idModelo){
        $this->idModelo=$idModelo;
    }
    public function setModelo_Auto($Modelo_Auto){
        $this->Modelo_Auto=$Modelo_Auto;
    }
    public function setMarca_Auto($Marca_Auto){
        $this->Marca_Auto=$Marca_Auto;
    }
    public function setTotal_Compras($Total_Compras){
        $this->Total_Compras=$Total_Compras;
    }    
}
?>