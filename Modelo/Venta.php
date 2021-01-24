<?php
require("Usuario.php");
require("Cliente.php");
require("Producto.php");
class Venta{
    private $Usuario;
    private $Cliente;
    private $productos;//Array

    public function __construct(){
        $Usuario= new Usuario();
        $Cliente= new Cliente();
        $productos=array();//Aqui se ingresaran todos los productos comprados
    }//Fin del constructor
}//Fin de la clase
?>