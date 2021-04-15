<?php
require("Marca.php");
require("Producto.php");
class Modelo{
    public $idModelo;
    public $nombre;
    public $anioInicio;
    public $anioFin;
    public $Marca;
    private $opcion;
    private $opcion2;
    private $opcion3;

    public function __construct (){
        $idModelo=0;
        $nombre="";
        $anioInicio=0;
        $anioFin=0;
        $Marca=new Marca();
        $opcion=new Producto();
        $opcion2=new Producto();
        $opcion3=new Producto();
    }//Fin del contructor
}//Fin de la clase
?>