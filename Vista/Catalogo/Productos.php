<?php
    $titulo="Productos";
    include("../Compartido/encabezado.php");
?>
<article>
    <h2>Productos</h2>
    <section>
        <p>Seleccione un producto de la lista.</p>
    </section>
    <section id="listadoProductos">

    </section>
</article>
<?php
include("../Compartido/piePagina.php");
?>

<script>
$(document).ready(function(){
    prueba();
});


function prueba(){
    $.ajax({
        cache:false,
        method:"GET",
        url:"../../Controlador/ConsultarProductos",
        error: function(response){}
    }).done(function(data){
        tabla="<table class='tablaProducto'><tbody><tr class='tablaProducto__Encabezado'><th>Marca</th><th>Categoría</th><th>Cantidad</th><th>Precio</th><th>Tipo</th><th>Casco</th><th>Precio Casco</th><th></th></tr>";
        $.each(data,function(i,item){
            tabla+="<tr data-idProducto='"+item.idProducto+"' class='tablaProducto__item'><td>"+item.marca+"</td><td>"+item.categoria+"</td><td>"+item.cantidad+"</td><td>$"+item.precio+"</td><td>"+item.tipo+"</td><td>"+item.casco+"</td><td>$"+item.precioCasco+"</td><td><input type='button' class='btn btn-primary' value='Accion'/></td></tr>"
        });
        tabla+="</tbody></table>";
        $("#listadoProductos").append(tabla);
    });
}

$('#listadoProductos').on("click", " table tbody tr td input[type='button']",function(e){
    swal("Asombroso", "Haz hecho click en el producto con id : "+$(e.currentTarget).closest("tr").attr("data-idProducto"));
});

</script>