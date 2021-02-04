<?php
    $titulo="Productos";
    include("../Compartido/encabezado.php");
?>
<form id="datosPrueba">
    <fieldset>
        <legend>
        Registrar nuevos productos (prueba de envio de datos con ajax)
        </legend>
        <div class="row">
            <div class="form-group">                     
            <label><span>Nombre</span>
            <input name="nombre" id="nombre" type="text">
            </div>
        </div>
        <div class="row">
            <div class="form-group">                     
            <label><span>Stock</span>
            <input name="stock" id="stock" type="text">
            </div>
        </div><div class="row">
            <div class="form-group">                     
            <label><span>cosa</span>
            <input name="cosa" id="cosa" type="text">
            </div>
        </div>
        <input type="button" value="Enviar" />
    </fieldset>
</form>
<?php
include("../Compartido/piePagina.php");
?>

<script>
$(document).ready(function(){
    swal("Estoy listo");
});

$("input[type='button']").on("click",function(){
    alert($("#datosPrueba").serialize());
    $.ajax({
        cache:false,
        method:"Post",
        data: $("#datosPrueba").serialize(),//Utiliza la etiqueta "name"
        url:"prueba"//´prueba.php
    }).done(function(data){
        if(data){
            swal("Ya termine alaverga");
        }else{
            swal("Y No se pudo carnal");
        }
    });
});
</script>