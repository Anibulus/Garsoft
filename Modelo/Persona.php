<?php
class Persona{
    private $idPersona;
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $correo;

    public function __construct(){
        $idPersona=0;
        $nombre="";
        $apellido1="";
        $apellido2="";
        $correo="";
    }//Fin el constructor


    //Codigo de sugerencias
    /*public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }

    public function get_personas(){
        $consulta=$this->db->query("select * from personas;");
        while($filas=$consulta->fetch_assoc()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }*/
}//Fin de la clase
?>