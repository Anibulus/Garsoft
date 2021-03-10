<?php
class Categoria {
    public $idCategoria;
    public $nombre;

    public function __construct(){
        $this->idCategoria=0;
        $this->nombre="";
    }//Fin del contructor

    public function setIdCategoria($id){
        $this->idCategoria=$id;
    }
    public function setNombre($name){
        $this->nombre=$name;
    }
}//Fin de la clase
?>