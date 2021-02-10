<?php
    $titulo="Nuevo Producto";
    include("../Compartido/encabezado.php");

    if(isset($_SESSION["nombre"])){
        if($_SESSION["idPerfil"]!=1){
            header("location:../Inicio/Inicio");
        }
    }else{
        header("location:../Inicio/Inicio");
    }
?>
<article>
    <h2>Nuevo Producto</h2>
    <section>
    <div class="row">
        <div class="form-group">
            <label><span>Marca de Producto</span>
                <select class='form-control' name="marcas" id="marcas">
                </select>
            </label>
        </div>

        <div class="form-group">
            <label><span>Categoría de Producto</span>
                <select class='form-control' name="categoria" id="categoria">
                </select>
            </label>
        </div>
    </div>
    <div class="row">
    
        <div class="form-group" id="seccionTipo">
            <label><span>Tipo</span>
                <select class='form-control' name="tipo" id="tipo">
                </select>
            </label>
        </div>

        <div class="form-group">
            <label><span>Cantidad</span>
                <input class='form-control' name="cantidad" id="cantidad" value="" type="number"/>
            </label>
        </div>
    </div>
    <!--TODO separar para agregar mas de un precio-->
    <div class="row">
        <div class="form-group">
                <label><span>Tipo Precio</span>
                <div class="input-group">
                <select class='form-control' name="precio" id="precio">
                    <option value="0">Precio Al Público</option>
                    <option value="1">Con Garantía</option>
                </select>
                </div>
            </label>
        </div>
        <div class="form-group">        
                <label><span>Precio</span>
                <div class='input-group'>
                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                    <input name="precio" id="precio" type="text" class='form-control' aria-label='Amount' />
                </div>
            </label>
        </div>
    </div>
    <section id="listadoProductos" name="listadoProductos">
    </section>
</article>
<?php
include("../Compartido/piePagina.php");
?>
<script>

$(document).ready(function(){
    getCategorias();
    getMarcas();
});

function getCategorias(){
    $.ajax({
        cache:false,
        method:"GET",
        url:"../../Controlador/Productos/getCategorias",
        error: function(response){}
    }).done(function(data){       
       if(data.length>0){
            opciones="<option value='0' hidden selected>Seleccione...</option>";
           $.each(data, function(i,item){
                opciones+="<option value='"+item.idCategoria+"'>"+item.nombre+"</option>"
           });
           $("#categoria").html(opciones);
       }
    });
}//Fin de get Categoria

function getMarcas(){
    $.ajax({
        cache:false,
        method:"GET",
        url:"../../Controlador/Productos/getMarcas",
        error: function(response){}
    }).done(function(data){
        if(data.length>0){
            opciones="<option value='0' hidden selected>Seleccione...</option>";
           $.each(data, function(i,item){
                opciones+="<option value='"+item.idMarca+"'>"+item.nombre+"</option>"
           });
           $("#marcas").html(opciones);
       }
    });
}//Fin de getMarcas
</script>