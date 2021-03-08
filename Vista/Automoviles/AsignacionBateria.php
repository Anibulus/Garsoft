<?php
    $titulo="Asignación Batería-Automovil";
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
            <label><span>Marca de Automovil</span>
                <select class='form-control' name="marcas" id="marcas">
                </select>
            </label>
        </div>

        <div class="form-group">
            <label><span>Modelo  de automovil</span>
                <select class='form-control' name="modelo" id="modelo">
                </select>
            </label>
        </div>
    </div>
    <div class="row">
        <label><span>Tipo de Batería</span>
                <select class='form-control' name="tipo" id="tipo">
                </select>
            </label>
    </div>
    <!--TODO separar para agregar mas de un precio-->
    <div class="row">        
        <div>
            <input type="button" id="btnAgregar" name="btnAgregar" value="Añadir tipo" class="btn btn-secondary" />

            <input type="button" class="btn btn-primary" id="btnGuardar" name="btnGuardar" value="Guardar"/>
        </div>
    </div>
    
    <section id="listadoProductos" name="listadoProductos">
    <table class='tablaProducto'><tbody id="tablaBateria" name="tablaBateria" >

    </tbody></table>
    </section>
    
</article>
<?php
include("../Compartido/piePagina.php");
?>
<script>
$("#seccionTipo").hide();
$(document).ready(function(){    
    getMarcas();
});

function getModelo(marca){
    $.ajax({
        cache:false,
        method:"POST",
        data:{idMarca:marca},
        url:"<?php echo $dominio?>Controlador/Automovil/getModeloAuto",
        error: function(response){}
    }).done(function(data){       
       if(data.length>0){
            opciones="<option value='0' hidden selected>Seleccione...</option>";
           $.each(data, function(i,item){
                opciones+="<option value='"+item.idModelo+"'>"+item.nombre+" "+
                //Si el año es el mismo, asi lo imprime, sino imprime los 2 digistos de ambos
                (item.anioInicio==item.anioFin? item.anioInicio:
                String(item.anioInicio).substr(2,2)+" - "+String(item.anioFin).substr(2,2)  )+"</option>"
           });
           $("#modelo").html(opciones);
       }
    });
}//Fin de get Categoria

function getMarcas(){
    $.ajax({
        cache:false,
        method:"GET",
        url:"<?php echo $dominio?>Controlador/Automovil/getMarcaAuto",
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

function getTipo(idModelo){
    $.ajax({
        cache:false,
        method:"POST",
        data:{idModelo:idModelo},
        url:"../../Controlador/automovil/getTiposDisponibles",
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

$("#marcas").on("change",function(){
    getModelo($("#marcas").val());
    $("#tablaBateria").html("<tr><th>Tipo Batería</th><th>Modelo de Automovil</th><th>Marca de Automovil</th></tr>");
});

$("#modelo").on("change",function(){
    getTipo($("#modelo").val());
    $("#tablaBateria").html("<tr><th>Tipo Batería</th><th>Modelo de Automovil</th><th>Marca de Automovil</th></tr>");    
});


//Seccion agregar tipo a tabla
$("#btnAgregar").on("click",function(){
    //Valida que el precio tenga un valor válido
    if(parseInt($("#modelo").val())>0 && parseInt($("#tipo").val())>0)
    {
        //Generacion de tabla
        tabla="<tr><td data-idTipo='"+$("#tipo").val()+"'>"+$("#tipo option:selected").text()+"</td>"+
        "<td data-idModelo='"+$("#modelo").val()+"' >"+$("#modelo option:selected").text()+"</td>"+
        "<td data-idMarca='"+$("#marcas").val()+"' >"+$("#marcas option:selected").text()+"</td>"+
        "<td><input class='btn btn-danger' type='button' value='Quitar' /></td></tr>";
        $("#tablaBateria").append(tabla);
        //Se oculta la opcion
        $("#tipo option:selected").attr("hidden",true);
        $("#tipo").val("0");

    }
    else
    {
        swal("Aviso","Requiere introducir un valor válido","warning");
    }    
});



$("#btnGuardar").on("click",function(){
    var baterias=getProductosDeTabla();
    console.log(baterias);
    if(parseInt($("#marcas").val())>0)
    {//Debes seleccionar una categoria   
        if(baterias.length>0)
        {  
            guardarProducto(baterias);            
        }
        else
        {
            swal("Aviso","Debe agregar una batería al menos","warning");
        }
    }
    else
    {
        swal("Aviso","Debes seleccionar una marca de automovil","warning");
    }
});

//Toma los registros de la tabla
function getProductosDeTabla(){
    var tbl = $('#tablaBateria tr:has(td)').map(function(i, v) {
        var $td =  $('td', this);
        return {
                 id: ++i,
                 idTipo: $td.eq(0).attr("data-idtipo"),
                 idModelo: $td.eq(1).attr("data-idmodelo"),
                 idMarca: $td.eq(2).attr("data-idmarca"),         
               }
    }).get();
    return tbl;
}

function guardarProducto(baterias){
    $.ajax({
        cache:false,
        url:"<?php echo $dominio?>Controlador/Automovil/guardarBateriasDeAuto",
        data:{
            csrf_token:"<?php echo $token;?>",
            idMarca:$("#marcas").val(),
            idModelo:$("#modelo").val(),
            baterias:baterias
        },
        method:"POST",
        beforeSend:function(){
            $("#btnGuardar").prop("disabled",true);
        }
    }).done(function(data){
        if(data==1){
            swal("Éxito","Se ha guardado correctamente","success");
            $("#tablaBateria").html("<tr><th>Tipo Batería</th><th>Modelo de Automovil</th><th>Marca de Automovil</th></tr>");
        }
        else{
            swal("Aviso","No se ha logrado guardar el registro","warning");
        }
    }).always(function(){
        $("#btnGuardar").prop("disabled",false);
    });
    
}

$('#listadoProductos').on("click", "table>tbody>tr>td>input[type='button']",function(e){
    //Antes de remover, consigue el idTipo para regresarlo al select
    idT=$(e.currentTarget).closest("td").prev().prev().prev().attr("data-idtipo");
    console.log(idT);
    $("#tipo option[value='"+idT+"']").attr("hidden",false);
    $(e.currentTarget).closest("tr").remove(); 
});
</script>