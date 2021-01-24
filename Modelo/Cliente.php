<?php
require("Persona.php");
class Cliente extends Persona{
    private $idPersona;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $correo;

    public function __construct (){
        $idPersona=0;
        $nombre="";
        $apellido1="";
        $apellido2="";
        $correo="";
    }//Fin del constructor
}//Fin de la clase 
?>