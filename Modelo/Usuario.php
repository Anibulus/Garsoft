<?php
require("Persona.php");
class Usuario{
   private $idUsuario;
   private $usuario;
   private $contrasena;
   private $activo;
   private $perfil;
   private $ultimoInicio;
   private $Persona;

   public function __construct(){
       $idUsuario=0;
       $contrasena="";
       $usuario="";
       $activo=true;
       $perfil=1;
       $ultimoInicio=date();
       $Persona=new Persona();
   }//Fin del constructor
}//Fin de la clase
?>