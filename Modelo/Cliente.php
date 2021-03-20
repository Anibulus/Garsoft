<?php
require("Persona.php");
class Cliente extends Persona{
    public $idPersona;
    public $nombre;
    public $apellido1;
    public $apellido2;
    public $correo;

    public function __construct (){
        $idPersona=0;
        $nombre="";
        $apellido1="";
        $apellido2="";
        $correo="";
    }//Fin del constructor
}//Fin de la clase 
?>