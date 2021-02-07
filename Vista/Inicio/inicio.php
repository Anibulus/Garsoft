<?php
    $titulo = 'Inicio';
    include('../Compartido/encabezado.php');
?>

<h1>Acumuladores Garza</h1>
<!--TODO buscar diferencia de include y require-->
<article>
    <section>
    <h1>¿Quiénes somos?</h1>
    <p></p>
    </section>
    <section>
    <h1>¿Dónde puedes encontrarnos?</h1>
    <p>Av. 16 de Septiembre 561, Mexicaltzingo, 44180 Guadalajara, Jal.</p>
    <iframe width="520" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=Av.%2016%20de%20Septiembre%20561,%20Mexicaltzingo%20Guadalajara+()&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> 
    
    <h1>¿Por qué nosotros?</h1>
    <p>Nosotros</p>

    <h1>Garantía</h1>
    <p>Garantia</p>

    <h1>¿Cuentas con baterías usadas?</h1>
    <p>Nosotros te las compramos</p>
    </section>
</article>
<?php
    include('../Compartido/piePagina.php');
?>

<style>

table {
    border-style: ridge;
    border-width: 150px;
    border-color: #8ebf42;
    background-color: #d9d9d9;
  }
  th {
    border: 5px solid #095484;
    color: red;
  }
  td {
    border: 20px groove #1c87c9;
  }


table,
th,
td {
    padding: 10px;
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
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
        tabla="<table style='background-color:#d9d9d9;'><tbody><tr><th>Marca</th><th>Categoría</th><th>Cantidad</th><th>Precio</th><th>Tipo</th><th>Casco</th><th>Precio Casco</th><th></th></tr>";
        $.each(data,function(i,item){
            tabla+="<tr data-idProducto='"+item.idProducto+"'><td>"+item.marca+"</td><td>"+item.categoria+"</td><td>"+item.cantidad+"</td><td>"+item.precio+"</td><td>"+item.tipo+"</td><td>"+item.casco+"</td><td>"+item.precioCasco+"</td><td><input type='button' class='btn btn-primary' value='Accion'/></td></tr>"
        });
        tabla+="</tbody></table>";
        $("body").append(tabla);
    });
}

$('body').on("click", " table tbody tr td input[type='button']",function(e){
    swal("Asombroso", "Haz hecho click en el producto con id : "+$(e.currentTarget).closest("tr").attr("data-idProducto"));
});

/*
var doc = new jsPDF('landscape');
doc.text(20, 20, 'Hello landscape world!');

doc.save('Test.pdf',"application/pdf");
//https://www.desarrollolibre.net/blog/css/generando-reportes-pdfs-con-javascript


var doc = new jsPDF();
console.log(doc);
var imgData = 'data:image/jpeg;base64,/ …;

doc.setFontSize(40);
doc.text(40, 20, "Octocat loves jsPDF");
doc.addImage(imgData, 'JPEG', 10, 40, 180, 180);
*/
</script>