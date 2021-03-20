<?php
    $titulo="Marca - Modelo";
    include("../Compartido/encabezado.php");

    if(!isset($_SESSION["nombre"])){
        header("Location: ".$dominio."Vista/Inicio/Inicio");
        die();
    }
?>
<article class="container">
    <h2>Nueva Marca</h2>
    <hr/>
    <section>
    <div class="row">
        <div class="col">
            <label><span>Marca de Automóvil</span>
                <select class='input-group-text' name="marcas" id="marcas">
                </select>
            </label>
        </div>
        <div class="col">
            <label><span>Modelo de Automóvil</span>
                <select class='input-group-text' name="modelo" id="modelo">
                </select>
            </label>
        </div>
    </div>
    <div class='table-responsive tablaContenido'>
        <section id="tblProducto" name="tblProducto">
        </section> 
    </div>
</article>
<?php
include("../Compartido/piePagina.php");
?>

<script>
$(document).ready(function(){    
    getMarcas();
});

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
                opciones+="<option value='"+item.idMarca+"'>"+item.nombre+"</option>";
           });
           $("#marcas").html(opciones);
       }
    });
}//Fin de getMarcas

$("#marcas").on("change",function(){
    getModelo();
})

function getModelo(){
    $.ajax({
        cache:false,
        method:"POST",
        data:{idMarca:$("#marcas").val()},
        url:"<?php echo $dominio?>Controlador/Automovil/getModeloAuto",
        error: function(response){}
    }).done(function(data){
        if(data.length>0){
            opciones="<option value='0' hidden selected>Seleccione...</option>";
           $.each(data, function(i,item){
            opciones+="<option value='"+item.idModelo+"'>"+item.nombre+" "+
                //Si el año es el mismo, asi lo imprime, sino imprime los 2 digistos de ambos
                (item.anioInicio==item.anioFin? item.anioInicio:
                String(item.anioInicio).substr(2,2)+" - "+String(item.anioFin).substr(2,2)  )+"</option>";
           });
           $("#modelo").html(opciones);
       }
    });//Fin de ajax
}//Fin de getMarcas

$("#modelo").on("change",function(){
    $.ajax({
        method:"POST",
        cache:false,
        url:"<?php echo $dominio?>Controlador/Automovil/getTiposModelo",
        data:{idModelo:$("#modelo").val()}
    }).done(function(data){
        console.log(data);
        tabla="<table class='table caption-top table-dark table-striped table-hover tabla-Contenido-Centrado'>"+
        "<tbody><tr class='row'><th class='col align-items-center'>Marca</th><th class='col'>Modelo</th><th class='col'>Año Inicio</th><th class='col'>Año Fin</th><th class='col'>Tipo</th><th class='col'>Marca Tipo</th><th class='col'>Cantidad</th><th class='col'>Meses de Garantía</th>";
        $.each(data,function(i,item){
            tabla+="<tr class='row'>"+
            "<td class='col'>"+item.marca+"</td><td class='col'>"+item.modelo+"</td><td class='col'>"+item.anioInicio+"</td><td class='col'>"+item.anioFin+"</td><td class='col'>"+item.tipo+"</td><td class='col'>"+item.marcaProducto+"</td><td class='col'>"+item.cantidad+"</td><td class='col'>"+item.mesesGarantia+"</td>"+
            "</tr>";
        });
        tabla+="</tbody><table>";
        $("#tblProducto").html(tabla);
    });
});

</script>