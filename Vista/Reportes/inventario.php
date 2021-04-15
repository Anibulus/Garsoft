<?php
$titulo="Reportes";
include("../Compartido/encabezado.php");

//header('Content-Type: application/json');

$conn=Conectar::conexion();

$resultp=$conn->query("select * from categoriaProducto where nombre !='Servicio';");

unset($conn);

date_default_timezone_set('America/Mexico_City');
?>
<!--Reportes con Js-->

<article class="container">
    <h2>Reportes</h2>
    <hr/>
</article>

<form class="formA">
    <div class="divl">
        <h3>Inventario:</h3>
        <span>Seleccione la categoria de producto</span>
        <select class="input-group-text" name="reportP" id="reportP" onchange="getProductos()">
            <option></option>
            <?php
            while($row = mysqli_fetch_object($resultp)){
                ?>
            <option value="<?php echo $row->idCategoria;?>"><?php echo $row->nombre;?></option>
            <?php 
            ;} 
            ?>
        </select>
    </div>
    <div class="divr">
        <h3>Ventas:</h3>
        <span>Seleccione mes y año de venta</span><br>
        <div class="divl">
            <select class="input-group-text" name="reportVA" id="reportVA">
                <option value="January">Enero</option>
                <option value="February">Febrero</option>
                <option value="March">Marzo</option>
                <option value="April">Abril</option>
                <option value="May">Mayo</option>
                <option value="June">Junio</option>
                <option value="July">Julio</option>
                <option value="August">Agosto</option>
                <option value="September">Septiembre</option>
                <option value="October">Octubre</option>
                <option value="November">Noviembre</option>
                <option value="December">Diciembre</option>
            </select> 
        </div>
        <div class="divr">
            <select class="input-group-text" name="reportVM" id="reportVM">
                <option value="2021">2021</option>
                <option value="2020">2020</option>
            </select>
        </div><br>
        <input type="button" name="reportV" class="btn btn-secondary" onclick="getVentas()" value="Consultar"></input>
    </div> <br>  
</form>
<br><br><br><br><br><br><br><br>
<form class="formA">
    <!--
    <div class="divl">
        <h3>Autos para los que más compran</h3>    
        <div class="">
            <table class='table caption-top table-striped table-hover tabla-Contenido-Centrado'>
                <tr class="row">
                    <th class='col'>Modelo</th>
                    <th class='col'>Marca</th>
                    <th class='col'>Compras</th>
                </tr>
            ?php
                $conn=Conectar::conexion();
            
                $result=$conn->query("select v.idModelo, mo.nombre as Modelo_Auto, (select distinct ma.nombre from marcaAuto ma join modeloAuto mm on ma.idMarca = mm.idMarca) as Marca_Auto, count(v.idModelo) AS Total_Compras FROM venta v join modeloAuto mo on v.idModelo = mo.idModelo GROUP BY v.idModelo ORDER BY Total_Compras desc limit 5;");
                while($row = mysqli_fetch_object($result)){
                ?>
                <tr class="row">
                    <td class='col'>?php echo $row->Modelo_Auto;?></td>
                    <td class='col'>?php echo $row->Marca_Auto;?></td>
                    <td class='col'>?php echo $row->Total_Compras;?></td>
                </tr>
                ?php 
                ;} 
                ?>
            </table>
            <input type="button" name="reportAV" class="btn btn-secondary" onclick="getAutosM()" value="Obtener PDF"></input>
        </div>
    </div>
    -->
    <div class="divc">
        <h3>Productos que mas se venden</h3>
        <div class="">
            <table class='table caption-top table-striped table-hover tabla-Contenido-Centrado'>
                <tr class="row">
                    <th class='col'>Categoría</th>
                    <th class='col'>Marca</th>
                    <th class='col'>Tipo</th>
                    <th class='col'>Vendidos</th>
                </tr>
            <?php
                $conn=Conectar::conexion();
                $resultv=$conn->query("select v.idVenta, pr.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,
                SUM(i.cantidad) Vendido
                FROM venta v 
                join intermediaVentaProductoSalida i on v.idVenta = i.idVenta
                join producto pr on pr.idProducto = i.idProducto
                join categoriaProducto c on pr.idCategoria = c.idCategoria
                join marcaProducto m on pr.idMarca = m.idMarca
                join tipo t on pr.idTipo = t.idTipo GROUP by t.idTipo ORDER BY Vendido desc limit 5;");
                while($row = mysqli_fetch_object($resultv)){
                ?>
                <tr class="row">
                    <td class='col'><?php echo $row->Categoria;?></td>
                    <td class='col'><?php echo $row->Marca;?></td>
                    <td class='col'><?php echo $row->Tipo;?></td>
                    <td class='col'><?php echo $row->Vendido;?></td>
                </tr>
                <?php 
                ;} 
                ?>
            </table>
            <input type="button" name="reportPV" class="btn btn-secondary" onclick="getProductosV()" value="Obtener PDF"></input>
        </div>
    </div>
</form>
     

<?php
include("../Compartido/piePagina.php");
?>

<script type="text/javascript">

function getProductos(){
    var x = document.getElementById("reportP").value;
    
    var fruits = [];
    var cate = "";
    var pag = 1;
    $.ajax({
        cache:false,
        method:"POST",
        data:{"idc":x},
        url:"../../Controlador/Reportes/Productos",
    }).done(function(data){
        if(data.length>0){
        	const doc = new jsPDF()
            var logo = new Image();
            logo.src = '../../Img/logo2.jpg';
        	doc.page=pag;
            logo.onload = function(){
                $.each(data, function(i,item){
                    fruits.push([item.categoria, item.marca,item.tipo,item.stock,item.precio,item.preciog,item.preciot])
                    cate =item.categoria; 

                });
                doc.setFontSize(12)
                doc.text('Inventario Categoria: '+cate,80, 44)
                doc.text('<?php echo date("Y-m-d H:i:s");?>',150, 15)
                doc.text('Consulto: <?php echo $_SESSION['nombre'];?>',150, 10);
                doc.autoTable({
                    didDrawPage: function (data) {
                        doc.addImage(logo, 'JPEG', 65, 0,81,40)
                    },
                    margin: { top: 50 },
                    head: [['Categoria','Marca','Tipo','Cantidad','Precio', 'Precio Garantia','Valor Total']],
                    body: fruits,
                    pageNumber:1,
                })
                doc.save('Productos-AC.pdf');
            };  	
        } else {
            swal("Aviso","No hay datos por mostrar", "warning");
        }
    });
}

function getVentas(){
    var x = document.getElementById("reportVA").value;
    var y = document.getElementById("reportVM").value;
    var z = x;
    switch (z) {
        case z ='January':
            var z = 'Enero';
            break;
        case z ='February':
            var z = 'Febrero';
            break;
        case z ='March':
            var z = 'Marzo'; 
            break;
        case z ='April':
            var z = 'Abril';
            break;
        case z ='May':
           var z = ' Mayo';
           break;
        case z ='June':
            var z = 'Junio';
            break;
        case z ='July':
            var z = 'Julio';
            break;
        case z ='August':
            var z = 'Agosto';
            break;
        case z ='September':
            var z = 'Septiembre';
            break;
        case z ='October':
            var z = 'Octubre';
            break;
        case z ='November':
            var z = 'Noviembre';
            break;
        case z ='December':
            var z = 'Diciembre';
            break;
    }

    $.ajax({
        cache:false,
        method:"POST",
        data:{"anio":x,"mes":y},
        url:"../../Controlador/Reportes/Ventas",
    }).done(function(data){
        if(data.length>0){
            const doc = new jsPDF()
            var logo = new Image();
            logo.src = '../../Img/logo2.jpg';
            doc.setFontSize(12)
            doc.text('Ventas: '+z+' '+y,80, 44);
            doc.text('<?php echo date("Y-m-d H:i:s");?>',150, 15);
            doc.text('Consulto: <?php echo $_SESSION['nombre'];?>',150, 10);

            logo.onload = function(){
                $.each(data, function(i,item){
                    var fruits = [];

                    //fruits.push([item.fecha, item.Cliente/*,item.Modelo_Auto,item.Marca_Auto*/])
                    fruits.push([item.fecha, item.Cliente,item.Pago,item.Vendio,item.Categoria,item.Marca,item.Tipo]/*,item.Modelo_Auto,item.Marca_Auto*/)
                    //fruits2.push([item.Pago,item.Vendio,item.Categoria,item.Marca,item.Tipo])
                    doc.autoTable({
                        didDrawPage: function (data) {
                            doc.addImage(logo, 'JPEG', 65, 0,81,40)
                        },
                        margin: { top: 50 },
                        head: [['Fecha','Cliente','Pago', 'Vendio','Categoria Producto','Marca Producto','Tipo  Producto'/*,'Modelo Auto','Marca Auto'*/]],
                        body: fruits,
                    })
                   
                    var fruits = [];   
                });                
                doc.save('Ventas-AC.pdf');
            };      
        } else {
            swal("Aviso","No hay datos por mostrar", "warning");
        }
    });
}

function getAutosM(){
    var fruits = [];
    $.ajax({
        cache:false,
        method:"GET",
        url:"../../Controlador/Reportes/ModeloVendidos",
    }).done(function(data){
        if(data.length>0){
            const doc = new jsPDF()
            var logo = new Image();
            logo.src = '../../Img/logo2.jpg';
            logo.onload = function(){
                $.each(data, function(i,item){
                    fruits.push([item.Modelo_Auto,item.Marca_Auto,item.Total_Compras])
                });
                doc.setFontSize(12)
                doc.text('Autos para los que más compran',80, 44)
                doc.text('<?php echo date("Y-m-d H:i:s");?>',150, 15)
                doc.text('Consulto: <?php echo $_SESSION['nombre'];?>',150, 10);
                doc.autoTable({
                    didDrawPage: function (data) {
                        doc.addImage(logo, 'JPEG', 65, 0,81,40)
                    },
                    margin: { top: 50 },
                    head: [['Modelo Auto','Marca Auto','Total Compras']],
                    body: fruits,
                })
                doc.save('AutosCompras-AC.pdf');
            };      
        } else {
            swal("Aviso","No hay datos por mostrar", "warning");
        }
    });
}

function getProductosV(){
    var fruits = [];
    $.ajax({
        cache:false,
        method:"GET",
        url:"../../Controlador/Reportes/ProductosMasVendidos",
    }).done(function(data){
        if(data.length>0){
            const doc = new jsPDF()
            var logo = new Image();
            logo.src = '../../Img/logo2.jpg';
            logo.onload = function(){
                $.each(data, function(i,item){
                    fruits.push([item.Categoria,item.Marca,item.Tipo,item.Vendido])
                });
                doc.setFontSize(12)
                doc.text('Productos que mas se venden',80, 44)
                doc.text('<?php echo date("Y-m-d H:i:s");?>',150, 15)
                doc.text('Consulto: <?php echo $_SESSION['nombre'];?>',150, 10);
                doc.autoTable({
                    didDrawPage: function (data) {
                        doc.addImage(logo, 'JPEG', 65, 0,81,40)
                    },
                    margin: { top: 50 },
                    head: [['Categoria','Marca','Tipo','Vendido']],
                    body: fruits,
                })
                doc.save('ProductosVendidos-AC.pdf');
            };      
        } else {
            swal("Aviso","No hay datos por mostrar", "warning");
        }
    });
}

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