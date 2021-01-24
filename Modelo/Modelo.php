<?php
require("Marca.php");
require("Producto.php");
class Modelo{
    private $idModelo;
    private $nombre;
    private $anio;
    private $Marca;
    private $opcion1;
    private $opcion2;
    private $opcion3;

    public function __construct (){
        $idModelo=0;
        $nombre="";
        $anio=0;
        $Marca=new Marca();
        $opcion1=new Producto();
        $opcion2=new Producto();
        $opcion3=new Producto();
    }//Fin del contructor
}//Fin de la clase
?>