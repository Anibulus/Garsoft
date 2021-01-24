<?php
require("Provedor.php");
require("Producto.php");
require("Persona.php");
class Compra{
    private $idCompra;
    private $Provedor;
    private $Empleado;
    private $costo;
    private $Producto;
    private $ProductosComprados;

    public function __construct(){
        $idCompra=0;
        $Provedor=new Provedor();
        $Empleado=new Persona();
        $costo=0;
        $Producto=new Producto();
        $ProductosComprados= array();
    }//Fin del constructor
}//Fin de la compra
?>