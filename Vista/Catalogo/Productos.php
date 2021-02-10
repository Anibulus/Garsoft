<?php
    $titulo="Productos";
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
    <h2>Productos</h2>
    <section>
    <div class="row">
        <div class="form-group">
            <label><span>Marca de Producto</span>
                <select name="marcas" id="marcas">
                </select>
            </label>
        </div>

        <div class="form-group">
            <label><span>Categoría de Producto</span>
                <select name="categoria" id="categoria">
                </select>
            </label>
        </div>

        <div class="form-group">
            <label><span>Precio</span>
                <select name="precio" id="precio">
                <option value="0">Precio Al Público</option>
                <option value="1">Con Garantía</option>
                </select>
            </label>
        </div>

    </div>
        <input type="button" id="btnInventario" name="btnInventario" class="btn btn-secondary" value="Obtener reporte"/>
        <p>Seleccione un producto de la lista.</p>
    </section>
    <section id="listadoProductos" name="listadoProductos">
    </section>
</article>
<?php
include("../Compartido/piePagina.php");
?>

<script>
$(document).ready(function(){
    getCategorias();
    getMarcas();
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

/*Valida que el otro valor no sea vacio para poder realizar la búsqueda*/
$("#marcas").on("change",function(){
    if(parseInt($("#categoria").val())>0)
        cargarProductos();
});
$("#categoria").on("change",function(){
    if(parseInt($("#marcas").val())>0)
        cargarProductos();
});

function cargarProductos(){
    $.ajax({
        cache:false,
        method:"POST",
        data:{ categoria:$("#categoria").val(), marca:$("#marcas").val(), garantia:$("#precio").val() },
        url:"../../Controlador/Productos/ConsultarProductos",
        error: function(response){}
    }).done(function(data){
        if(data.length>0)
        {
            tabla="<table data-categoria='"+$("#categoria").val()+"' class='tablaProducto'>"+
            "<tbody><tr class='tablaProducto__Encabezado'>"+
            "<th>Marca</th><th>Categoría</th><th>Tipo</th><th>Casco</th><th>Precio Casco</th><th>Cantidad</th><th>Precio</th><th>Accion</th></tr>";
            $.each(data,function(i,item){
                tabla+="<tr data-idPrecio='"+item.idPrecio+"' data-idProducto='"+item.idProducto+"' class='tablaProducto__item'>"+
                //Contenido
                "<td>"+item.marca+"</td><td>"+item.categoria+"</td><td>"+item.tipo+"</td><td>"+item.casco+"</td>"+
                "<td>$"+item.precioCasco+"</td><td data-cantidad='"+item.cantidad+"'>"+item.cantidad+"</td>"+
                "<td data-precio='"+item.precio+"'>$"+item.precio+"</td>"+
                //Boton
                "<td data-accion='0'><input type='button' class='btn btn-primary' value='Editar'/></td></tr>"
            });
            tabla+="</tbody></table>";
            //TODO si el producto es diferente de bateria, cargar una tabla con menos campos
        }else{
            tabla="<table class='tablaProducto'><tbody><tr class='tablaProducto__Encabezado'><th>Marca</th><th>Categoría</th><th>Cantidad</th><th>Precio</th><th>Tipo</th><th>Casco</th><th>Precio Casco</th><th></th></tr>"+
            "<tr class='tablaProducto__item'><td colspan='8'>No hay registros que mostrar</td></tr></tbody></table>";
        }
        $("#listadoProductos").html(tabla);
    });
}

//Cuando se da click en el boton de acción
$('#listadoProductos').on("click", " table tbody tr td input[type='button']",function(e){
    //Si hace click para editar
    if(parseInt($(e.currentTarget).closest("td").attr("data-accion"))==0)
    {
        hacerEditable(e);
    }
    //Cuando se da click por segunda vez
    else
    {
        swal("¿Estás seguro de guardar los nuevos cambios?", {
        buttons: {
            cancel: "Ay no",
            simon: "Jalo"             
        },
        })
        .then((value) => {
        switch (value) {        
            case "simon":
                //Se toman los valores para ser enviados
                let idProducto=$(e.currentTarget).closest("tr").attr("data-idProducto");
                let idPrecio=$(e.currentTarget).closest("tr").attr("data-idPrecio");
                let cantidad=$(e.currentTarget).closest("td").prev().prev().children("div").children("input").val();
                let precio=$(e.currentTarget).closest("td").prev().children("div").children("input").val();
                guardarProducto(e,cantidad, precio, idProducto, idPrecio);                
                break;

            default:
                //Se devuelven los valores como estaban
                regresarDiseno(e);
                swal("Aviso", "No se ha modificado nada.", "warning");
                break;
        }//Fin de switch
        });//Fin de swal
    }//Fin desaber que accion ejecutar
});//Fin de listener on click

function regresarDiseno(e)
{
    let cant=$(e.currentTarget).closest("td").prev().prev().attr("data-cantidad");
    let pre=$(e.currentTarget).closest("td").prev().attr("data-precio");
    $(e.currentTarget).closest("td").prev().prev().text(cant);
    $(e.currentTarget).closest("td").prev().text("$"+pre);
    $(e.currentTarget).closest("td").attr("data-accion","0");
    $(e.currentTarget).val("Editar");
    $(e.currentTarget).toggleClass("btn-secondary btn-primary ");
}

function hacerEditable(e)
{
    $(e.currentTarget).closest("td").attr("data-accion","1");
    $(e.currentTarget).val("Guardar");
    $(e.currentTarget).toggleClass("btn-primary btn-secondary");
    //Se modfica la tabla para poder editarla
    let cantidad=$(e.currentTarget).closest("td").prev().prev().attr("data-cantidad");
    let precio=$(e.currentTarget).closest("td").prev().attr("data-precio");   
    $(e.currentTarget).closest("td").prev().prev().html("<div class='input-group'><input type='number' value='"+cantidad+"' class='form-control' aria-label='Amount' /></div>")
    $(e.currentTarget).closest("td").prev().html('<div class="input-group"><div class="input-group-prepend"><span class="input-group-text">$</span></div><input type="text" value='+precio+' class="form-control" aria-label="Amount"></div>'); 
}

//En el segundo click y con permiso va y guarda los valores
function guardarProducto(e, cantidad, precio, idProducto, idPrecio){
    if(parseInt(cantidad)>0)//La cantidad no puede ser menor a 0
    {
        $.ajax({
            cache:false,
            url:"../../Controlador/Productos/modificarProducto",
            method:"POST",
            data:{cantidad:cantidad, precio:precio, idProducto:idProducto, idPrecio:idPrecio},
            beforeSend:function(){$(e.currentTarget).prop("disabled",true)},
            error:function(){}
        }).done(function(data){
            if(data==1){
                $(e.currentTarget).closest("td").prev().prev().attr("data-cantidad",cantidad);
                $(e.currentTarget).closest("td").prev().attr("data-precio",precio);                
                //Reestablece el valor del boton
                regresarDiseno(e);
                swal("¡Éxito!", "Se ha guardado correctamete", "success"); 
            }
        }).always(function(){
            $(e.currentTarget).prop("disabled",false)
        });
    }
    else{
        swal("Aviso","La cantidad no puede ser menor a 0","error");
    }
}//Fin de guardar producto individualmente

//Valida que se esten ingresando los datos correctamente
$("#listadoProductos").on("keypress","table tbody tr td div input[type='number']",function(e){
    return false;
});

$("#listadoProductos").on("keypress","table tbody tr td div input[type='text']",function(e){
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