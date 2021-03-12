
<?php
$titulo="Reportes";
include("../Compartido/encabezado.php");

//header('Content-Type: application/json');

?>
<a href="javascript:genPDF2()">Ejemplo</a>
<a href="javascript:getProductos()">Inventario</a>
<a href=""></a>
<a href=""></a>

<script type="text/javascript">

function getProductos(){
    var fruits = [];
    $.ajax({
        cache:false,
        method:"GET",
        url:"../../Controlador/Reportes/Productos",
    }).done(function(data){
        if(data.length>0){
        	const doc = new jsPDF()
        	$.each(data, function(i,item){
        		fruits.push([item.idProducto, item.categoria, item.marca,item.tipo,item.stock]);    
        	});
        
        	doc.autoTable({
        		head: [['idProducto','Categoria','Marca','Tipo','cantidad']],
        		body: fruits,
            })      
        	doc.save('table.pdf');
        }
    });
}

</script>