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
<article class="container">
    <h2>Nuevo Producto</h2>
    <hr/>
    <section>
    <div class="container">
        <div class="row">
            <div class="col">
                <label><span>Marca de Producto</span>
                    <select class='input-group-text' name="marcas" id="marcas">
                    </select>
                </label>
            </div>

            <div class="col">
                <label><span>Categoría de Producto</span>
                    <select class='input-group-text' name="categoria" id="categoria">
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div id="seccionCantidad" name="seccionCantidad" class="col">
                <label><span>Cantidad</span>
                    <input class='input-group-text' name="cantidad" id="cantidad" value="" type="number"/>
                </label>
            </div>
        </div>
        <!--Separacion para agregar una batteria que requiera mas informacion-->
        <div>
            <div class="col" id="seccionTipo" name="seccionTipo" >
                <label><span>Tipo</span>
                    <select class='input-group-text' name="tipo" id="tipo">
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col">   
                <label><span>Precio $</span>
                    <input name="precio" id="precio" type="text" class='input-group-text'/>
                </label>
            </div>

            <div class="col">
                    <label><span>Tipo Precio</span>
                    <select class="input-group-text" name="tipoprecio" id="tipoprecio">
                        <option value="" hidden selected>Seleccione...</option>
                        <option value="0">Precio Al Público</option>
                        <option value="1">Con Garantía</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <input type="button" id="btnAgregar" name="btnAgregar" value="Añadir precio" class="btn btn-secondary" />
        </div>
    </div>
        <section id="listadoProductos" name="listadoProductos">
            <div class="table-responsive tablaContenido">
                <table class='table caption-top table-dark table-striped table-hover tabla-Contenido-Centrado'>
                    <tbody id="tablaPrecio" name="tablaPrecio" >
                        <tr class="row">
                            <th class='col-1'></th>
                            <th class='col'>Precio $</th>
                            <th class='col'>Tipo</th>
                            <th class='col'>Acción</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <input type="button" class="btn btn-primary" id="btnGuardar" name="btnGuardar" value="Guardar"/>
            </div>    
        </div>
</article>
<?php
include("../Compartido/piePagina.php");
?>
<script>
$("#seccionTipo").hide();
$(document).ready(function(){
    getCategorias();
    getMarcas();
    getTipo();
    $("#cantidad").val(0);
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

function getTipo(){
    $.ajax({
        cache:false,
        method:"GET",
        url:"../../Controlador/Productos/getTipos",
        error: function(response){}
    }).done(function(data){
        if(data.length>0){
            opciones="<option value='0' hidden selected>Seleccione...</option>";
           $.each(data, function(i,item){
                opciones+="<option value='"+item.idTipo+"'>"+item.nombre+"</option>"
           });
           $("#tipo").html(opciones);
       }
    });
}//Fin de getMarcas

//Donde si es categoria 2 o 3 se muestra el tipo
$("#categoria").on("change",function(e){
    if($(e.currentTarget).val()==2 || $(e.currentTarget).val()==3){
        $("#seccionTipo").slideDown();
        $("#seccionCantidad").slideDown();
    }
    else if($(e.currentTarget).val()==1){
        $("#seccionCantidad").slideUp();
        $("#seccionTipo").slideUp();
    }
    else{
        $("#seccionTipo").slideUp();
        $("#seccionCantidad").slideDown();
    }
});

$("#btnAgregar").on("click",function(){
    //Valida que el precio tenga un valor válido
    if($("#precio").val()!="" && parseInt($("#precio").val())>0 && $("#tipoprecio").val()!="")
    {
        //Generacion de tabla
        tabla="<tr class='row'><td style='text-align: right;' class='col-1'>$</td><td class='col'>"+$("#precio").val()+"</td><td class='col' data-tipoPrecio='"+$("#tipoprecio").val()+"' >"+$("#tipoprecio option:selected").text()+"</td><td class='col'><input class='btn btn-danger' type='button' value='Quitar' /></td></tr>";
        console.log(tabla);
        $("#tablaPrecio").append(tabla);
        //Esconde el texto del select y resetea el bvalor de precio
        $("#tipoprecio option:selected").attr("hidden",true);
        $("#tipoprecio").val("");
        $("#precio").val("");
    }
    else
    {
        swal("Aviso","Requiere introducir un valor válido","warning");
    }
    
});

$("#btnGuardar").on("click",function(){
    console.log(getPreciosDeTabla());
    var productos=getPreciosDeTabla();
    if(parseInt($("#categoria").val())>0)
    {//Debes seleccionar una categoria   
        if(productos.length>0){   
            if(parseInt($("#categoria").val())==1)//Si es servicio
            {
                if(parseInt($("#marcas").val())>0 && parseInt($("#tipo").val())>0)
                    guardarProducto(productos);
                else
                    swal("Aviso","Llene los campos para ingresar "+$("#categoria option:selected").val(),"warning");
                
            }
            else if(parseInt($("#categoria").val())==2 || parseInt($("#categoria").val())==3)//Si es bateria
            {
                if(parseInt($("#marcas").val())>0 && parseInt($("#cantidad").val())>0 && parseInt($("#tipo").val())>0)                    
                    guardarProducto(productos);                
                else
                    swal("Aviso","Llene los campos para ingresar "+$("#categoria option:selected").text(),"warning");
                
            }
            else//Si es producto X
            {
                if(parseInt($("#marcas").val())>0 && parseInt($("#cantidad").val())>0)
                    guardarProducto(productos);
                else
                    swal("Aviso","Llene los campos para ingresar "+$("#categoria option:selected").val(),"warning");                
            }
        }
        else
        {
            swal("Aviso","Debe agregar un precio al menos","warning");
        }
    }
    else
    {
        swal("Aviso","Debes seleccionar una categoría","warning");
    }
});

//Toma los registros de la tabla
function getPreciosDeTabla(){
    var tbl = $('#tablaPrecio tr:has(td)').map(function(i, v) {
        var $td =  $('td', this);
        return {
                 id: ++i,
                 precio: $td.eq(1).text(),
                 desc: $td.eq(2).text(),
                 tipoprecio: $td.eq(2).attr("data-tipoprecio")             
               }
    }).get();
    return tbl;
}

function guardarProducto(precios){
    if(precios.length>0){
        $.ajax({
            cache:false,
            url:"<?php echo $dominio?>Controlador/Productos/nuevoProducto",
            data:{
                csrf_token:"<?php echo $token;?>",
                marca:$("#marcas").val(),
                categoria:$("#categoria").val(),
                cantidad:$("#cantidad").val(),
                tipo: $("#tipo").val(),
                precios:precios
            },
            method:"POST",
            beforeSend:function(){
                $("#btnGuardar").prop("disabled",true);
            }
        }).done(function(data){
            if(data==1){
                swal("Éxito","Se ha guardado correctamente","success");
            }
            else if(data==2){
                swal("Aviso","El producto que deseas ingresar, ya existe","warning");
            }
            else{
                swal("Aviso","No se ha logrado guardar el registro","warning");
            }
        }).always(function(){
            $("#btnGuardar").prop("disabled",false);
        });
    }
    else
    {
        swal("Aviso","Debe contener por lo menos un precio añadido.","warning");
    }
}

//Funciones complementaria en validacion
$("#cantidad").on("keypress",function(e){
    return false;
});

$("#precio").on("keypress",function(e){
    valor=$(e.currentTarget).val();
    if(e.keyCode==46 &&!valor.includes(".")&&valor.length>0)//Si es punto y no lo contiene
    {
        return true;
    }
    else if(e.keyCode>=48 && e.keyCode<=57) //Si son numeros
    {
        return true;
    }
    else
    {
        return false;
    }
});//Fin de listener

$('#listadoProductos').on("click", "div>table>tbody>tr>td>input[type='button']",function(e){
    //Antes de remover, consigue el idTipo para regresarlo al select
    idT=$(e.currentTarget).closest("td").prev().attr("data-tipoprecio");
    $("#tipoprecio option[value='"+idT+"']").attr("hidden",false);
    $(e.currentTarget).closest("tr").remove(); 
});
</script>