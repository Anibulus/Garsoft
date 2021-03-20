<input type="button" id="btnInventario" name="btnInventario" class="btn btn-secondary" value="Obtener reporte"/>

<script>
$('#btnInventario').on("click",function(){
    /*Consiguracion y propiedades del reporte*/
    var doc = new jsPDF();
    doc.setFontSize(12);
    doc.setProperties({
    title: 'Reporte de Inventario',
    subject: 'Obtenido el dia de hoy',
    author: 'Anjanath',
    //keywords: 'generated, javascript, web 2.0, ajax',
    creator: 'Anjanath'
    });

    /*Carga contenido*/
    doc.text(20, 20, 'Reporte de inventario');

    toDataURL("../../Img/Ivan.jpg",function(dataURL){
        doc.addImage(dataURL, 'JPG', 10, 78, 12, 15);
        doc.save('Test.pdf',"application/pdf");
    });
    
    //https://www.desarrollolibre.net/blog/css/generando-reportes-pdfs-con-javascript
});

/*TODO saber como funciona (promesas)*/
function toDataURL(url, callback) {
  var xhr = new XMLHttpRequest();
  xhr.onload = function() {
    var reader = new FileReader();
    reader.onloadend = function() {
      callback(reader.result);
    }
    reader.readAsDataURL(xhr.response);
  };
  xhr.open('GET', url);
  xhr.responseType = 'blob';
  xhr.send();
}
</script>