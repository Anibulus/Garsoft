<?php
require("Persona.php");
require("Empresa.php");
class Provedor extends Persona{
    private $idPersona;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $correo;
    private $Empresa;
    
    public function __construct (){
        $idPersona=0;
        $nombre="";
        $apellido1="";
        $apellido2="";
        $correo="";
        $Empresa=new Empresa();
    }//Fin del constructor
}//Fin de la clase
?>