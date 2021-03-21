<?php
class Carrito{
    
      public $idProd;
      public $marca;
      public $tipo;
      public $categoria;
      public $cantidad;
      public $precio;
      public $idprecio;
      public $casco;
      public $preciocasc;

    public function __construct(){

        $idProd=0;
        $marca="";
        $tipo="";
        $categoria="";
        $cantidad="";
        $precio="";
        $idprecio="";
        $casco="";
        $preciocasc="";
    }


    public function setIdProd($id){
    	$this->idProd = $id;
    }

    public function setMarca($marca){
    	$this->marca = $marca;
    }

    public function setTipo($tipo){
    	$this->tipo = $tipo;
    }

    public function setCatego($categoria){
    	$this->categoria = $categoria;
    }

    public function setCantidad($cantidad){
    	$this->cantidad = $cantidad;
    }

    public function setPrecio($precio){
    	$this->precio = $precio;
    }

    public function setIdPrecio($idPrecio){
    	$this->idprecio = $idPrecio;
    }

    public function setCasco($casco){
    	$this->casco = $casco;
    }

    public function setPrecioCasco($precasc){
    	$this->preciocasc = $precasc;
    }
    
    //Fin el constructor
}//Fin de la clase
?>