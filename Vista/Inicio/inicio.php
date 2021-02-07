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

<!--<script>
swal("Aviso","Esto es una notificacion","success");
$(document).ready(function(){
});


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
</script>-->