<?php
class Producto{
    private $db;
    private $id;
    private $nombre;
    private $stock;//Disponilidad    
 
    //TODO incuirlas en un DAO
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }

    public function get_personas(){
        $consulta=$this->db->query("select * from personas;");
        while($filas=$consulta->fetch_assoc()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }
}//Fin de la clase
?>