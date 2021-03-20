<?php
    $titulo="Ventas";
    include("../Compartido/encabezado.php");

    if(isset($_SESSION["nombre"])){
        if($_SESSION["idPerfil"]!=1){
           header("location:../Inicio/Inicio");
        }
    }else{
        header("location:../Inicio/Inicio");
    }
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<article>
    <h2>Modulo de venta</h2>
    <section>
    <div class="row">
        <div class="form-group">
            <label><span>Categoría de Producto</span>
                <select class='form-control' name="categoriav" id="categoriav">
                </select>
            </label>
        </div>

        

    </div>
    <div class="row">
        <div class="form-group" id="seccionMarcav" name="seccionMarcav">
            <label><span>Marca de Producto</span>
                <select class='form-control' name="marcasv" id="marcasv">
                </select>
            </label>
        </div>

        

        <div class="form-group" id="seccionTipov" name="seccionTipov" >
            <label><span>Tipo</span>
                <select class='form-control' name="tipov" id="tipov">
                </select>
            </label>
        </div>

        <div id="seccionPrecio" name="seccionPrecio" class="form-group">   
            
            <label><span>Precio</span>
                <div class='input-group'>
                    <div class="input-group-prepend"></div>
                    <input name="preciov" id="preciov" type="text" class='form-control' aria-label='Amount' />
                </div>
            </label>
        </div>
        <div id="seccionPrecioC" name="seccionPrecioC" class="form-group" >
            <label><span>Precio casco</span>
                <div class='input-group'>
                    <div class="input-group-prepend"></div>
                    <input name="preciocav" id="preciocav" type="text" class='form-control' aria-label='Amount' />
                </div>
            </label>
        </div>

        <div id="seccionSubTotal" name="seccionSubTotal" class="form-group" >
            <label><span>Sub-total</span>
                <div class='input-group'>
                    <div class="input-group-prepend"></div>
                    <input name="subtotal" id="subtotal" type="text" class='form-control' aria-label='Amount' />
                </div>
            </label>
        </div>


        
    
    </div>

    <section id="elCarrito" name="elCarrito">
    <table class='tablaCarrito'><tbody id="tablaCarrito" name="tablaCarrito" ><tr><th>Categoria </th><th>Marca </th><th>Tipo </th><th></th>
        <th>Precio </th><th>Sub-total </th><th>Cantidad </th> <th>Accion </th>  </tr>

    </tbody></table>
    </section>

   


            
    <div class="row" >

            <!--<label><span>Fecha</span>
                <div class='input-group'>
                    <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
                    <input name="fechaVent" id="fechaVent" type="date" class="form-control" aria-label='Amount'>
                </div>
            </label>-->

            

            

            
        
    </div>          

    <div class="row">
            <!--<input type="button" class="btn btn-primary" id="btnGuardar" name="btnGuardar" value="Guardar"/>-->

            
          
    </div>
    </article>

    <div class="row">
        <button  id="mdlBtn" type="button" class="btn btn-info btn-lg">Cliente</button>    
    
        <input type="button" id="btnAgregarCar" name="btnAgregarCar" value="Añadir al carro" class="btn btn-secondary" />
    </div>
    


    <div class="modal fade" id="modalCli" role="dialog">
        <div class="modal-dialog">
    
            <!-- Modal content-->
            <div class="modal-content">
    
                <div class="modal-header">
                    <h4 class="modal-title">Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <div class="modal-body">
                        
                        <div id="buscarCliente">
                            <div class="form-group">   
                                <label><span>Nombre a buscar:</span>
                                    <div class='input-group'>
                                        <input autocomplete="off" list="nombreCliente" name="nomCliBusq" id="nomCliBusq" type="text" class='form-control' aria-label='Amount' />
                                        <datalist id="nombreCliente">
                                        </datalist>   
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div id="nvoCliente"> <!--Div de ingreso de nvo cliente-->
                            <div class="form-group">   
                                <label><span>Nombre</span>
                                    <div class='input-group'>
                                        <div class="input-group-prepend"></div>
                                        <input name="nomCli" id="nomCli" type="text" class='form-control' aria-label='Amount' />
                                    </div>
                                </label>
        
                                <div class="form-group">
                                    <label><span>Apellido paterno</span>
                                        <div class='input-group' >
                                            <div class="input-group-prepend"></div>
                                            <input name="apepCli" id="apepCli" type="text" class='form-control' aria-label='Amount' />
                                        </div>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label><span>Apellido materno</span>
                                        <div class='input-group'>
                                            <div class="input-group-prepend"></div>
                                            <input name="apemCli" id="apemCli" type="text" class='form-control' aria-label='Amount' />
                                        </div>
                                    </label>
                                </div>
                            
                                <div class="form-group">
                                    <label><span>Correo</span>
                                        <div class='input-group'>
                                            <div class="input-group-prepend"></div>
                                            <input name="correo" id="correo" type="email" class='form-control' aria-label='Amount' />
                                        </div>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label><span>Telefono</span>
                                        <div class='input-group'>
                                            <div class="input-group-prepend"></div>
                                            <input name="telef" id="telef" type="number" class='form-control' aria-label='Amount' />
                                        </div>
                                    </label>
                                </div>
        
                            
                            </div>
                            
                        </div>
                        <div class="row">
                            <div>
                                <input type="button" class="btn btn-primary" id="btnGuardarCli" name="btnGuardarCli" value="Guardar Cliente"/>
                            </div>
                            <div>
                                <input type="button" class="btn btn-primary" id="selectCli" value="Seleccionar Cliente">
                            </div>
                            
                        </div>
                            
        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                </div>
      
            </div>
        </div>
    </div>






<script>



$(document).ready(function(){
  $("#mdlBtn").click(function(){
    $("#modalCli").modal();
  });
});

/*Llenado de informacion y consultas*/
$("#buscarCliente").hide();
$(document).ready(function(){
    getMarcas(); 
    getCategorias();
    getTipo();
});

function getMarcas(){
    $.ajax({
        cache:false,
        method:"GET",
        url:"../../Controlador/Productos/getMarcas",
        error: function(response){}
    }).done(function(data){ 
        if(data.length>0){
            let opciones="<option value='0' hidden selected> Seleccione...</option>";
           $.each(data, function(i,item){
                opciones+="<option value='"+item.idMarca+"'>"+item.nombre+"</option>"
           });
           $("#marcasv").html(opciones);
           delete opciones;
       }
    });
}//Fin de getMarcas  

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
           $("#categoriav").html(opciones);
       }
    });
}//Fin de get Categoria

function getTipo(){
    $.ajax({
        cache:false,
        method:"GET",
        url:"../../Controlador/Productos/getTipos",
        error: function(response){}
    }).done(function(data){
        if(data.length>0){
            opciones="<option value='0' hidden selected>Seleccione...</option>";
           $.each(data, function(i,item){
                opciones+="<option value='"+item.idTipo+"'>"+item.nombre+"</option>"
           });
           $("#tipov").html(opciones);
       }
    });
}//Fin de getMarcas

//Aqui estan los select

$("#categoriav").on("change",function(e){

    if($(e.currentTarget).val()==2 ){

        $("#seccionTipov").slideDown();
        
        $("#seccionMarcav").slideDown();
        $("#seccionPrecioC").slideDown();
        

    }else if($(e.currentTarget).val()==1){

        $("#seccionMarcav").slideUp();
        
        $("#seccionTipov").slideUp();
        $("#seccionPrecioC").slideUp();
    }
    else{

        $("#seccionTipov").slideUp();
        $("#seccionPrecioC").slideUp();
        $("#seccionMarcav").slideDown();
        

    }

});



$("#nomCliBusq").on("keypress",function(){
    $.ajax({
        cache:false,
        method:"POST",
        url:"../../Controlador/Ventas/getNombreCliente",
        data: {nombre: $("#nomCliBusq").val(),
            csrf_token:"<?php echo $token;?>",
        }, 
        error: function(response){}
    }).done(function(datos){
        $("#nombreCliente").html("");
        if(datos.length>0){
            let opciones=""
           $.each(datos, function(i,item){
                //opciones+="<option value='"+item.nombre+"' data-id='"+item.idCliente+"'>";
                opciones+="<option value='"+item.idCliente+"'>"+item.nombre+"</option>";
           });//Fin de each
           $("#nombreCliente").html(opciones);
           delete opciones;
        }
    });//Fin de .done
});//Fin de get nombre de persona

$("#nomCliBusq").on("change",function(e){
    //if($("#nomCliBusq").attr("data-idCliente"))
        swal("¿Estás seguro de seleccionar este cliente?", {
        buttons: {
            cancel: "Cancelar",
            simon: "Si, seleccionar"             
        },
        })
        .then((value) => {
        switch (value) {        
            case "simon":
                $("#nomCliBusq").prop("disabled",true);

                break;
            default:
                break;
        }//Fin de switch
    });//Fin de swal
});//Fin de change

$("#selectCli").on("click",function(){

    var nombreb = $("#nomCli").val();

    
    $("#nvoCliente").hide();
    $("#buscarCliente").show();
    


});



$("#marcav").on("change",function(e){
    
    $("#cantidadv").val("");

    var marca = $("#marcasv").val();
    var tipo = $("#tipov").val();
    

    $.ajax({
            cache:false,
            url:"../../Controlador/Ventas/getPrecios",
            method:"POST",
            data:{
                 "marca":marca,
                 "tipo":tipo
                 
            }, 
        error: function(response){}
    }).done(function(data){
        
        
        if(data.length>0){


            
            
           $.each(data, function(i,item){

                $("#preciov").val(item.precio);
                $("#preciocav").val(item.preciocasc);
                //opciones+="<option value='"+item.nombre+"' data-id='"+item.idCliente+"'>";
                
           });//Fin de each

           var precio = $("#preciov").val();
    var precioca = $("#preciocav").val();
    var preciofinal = precio+precioca;
    $("#subtotal").val(cascofinal);
           
        }else{
                $("#preciov").val("");
                $("#preciocav").val("");
        }
    });


});


$("#tipov").on("change",function(e){

  

    var marca = $("#marcasv").val();
    var tipo = $("#tipov").val();
    

    $.ajax({
            cache:false,
            url:"../../Controlador/Ventas/getPrecios",
            method:"POST",
            data:{
                 "marca":marca,
                 "tipo":tipo
                 
            }, 
        error: function(response){}
    }).done(function(data){
        
        
        if(data.length>0){


            
            
           $.each(data, function(i,item){

                $("#preciov").val(item.precio);
                $("#preciocav").val(item.preciocasc);
                //opciones+="<option value='"+item.nombre+"' data-id='"+item.idCliente+"'>";
                
           });//Fin de each

        var precio = parseFloat($("#preciov").val());
        var precioca = parseFloat($("#preciocav").val());
        var preciofinal = precio+precioca;

        $("#subtotal").val(preciofinal);
           
        }else{
                $("#preciov").val("");
                $("#preciocav").val("");
        }

        
    });
});//Fin del onchange tipov

/*$("#cantidadv").bind("keyup mouseup",function(){
    var cantidad = $("#cantidadv").val();
    if(cantidad.length < 0){

    }else{

        var precio = $("#preciov").val();
    var precioca = $("#preciocav").val();
    var preciofinal = precio*cantidad;
    var cascofinal = precioca*cantidad;


                $("#preciov").val(preciofinal);
                $("#preciocav").val(cascofinal);

    }




});//Fin del evento cantidad*/



// Aqui estan los botones

$("#btnAgregarCar").on("click",function(){



    //Valida que el precio tenga un valor válido
    if($("#preciov").val()!="" && parseInt($("#preciov").val())>0 && $("#subtotal").val()!="" )
    {
        //Generacion de tabla
        
        if($("#categoriav").val() == 1 ){

            tabla="<tr><td colspan='' data-idCategoria='"+$("#categoriav").val()+"'>"+$("#categoriav option:selected").text()+
            "</td><td  value='N/A'>"+
            "</td><td value='N/A'>"+
            "</td><td>$</td><td>"+$("#preciov").val()+
            "</td><td><input type='number' class='' value='"+$("#preciov").val()+"'></td>"+
            "</td><td class=''><input type='number' class='' value='1'></td>"+
            "</td><td data><input class='btn btn-danger' type='button' value='Quitar'/></td></tr>";
            $("#tablaCarrito").append(tabla);

        }else if($("#categoriav").val()==2){   
        tabla="<tr><td colspan='' data-idCategoria='"+$("#categoriav").val()+"'>"+$("#categoriav option:selected").text()+   
        "</td><td data-marca='"+$("#marcasv").val()+"' >"+$("#marcasv option:selected").text()+
        "</td><td data-tipo='"+$("#tipov").val()+"' >"+$("#tipov option:selected").text()+
        "</td><td>$</td><td>"+$("#preciov").val()+
        "</td><td><input type='number' class='' value='"+$("#subtotal").val()+"'></td>"+
        "</td><td class=''><input type='number' class='' value='1'></td>"+
        "</td><td data><input class='btn btn-danger' type='button' value='Quitar'/></td></tr>";
        $("#tablaCarrito").append(tabla);
        }else{

            tabla="<tr><td colspan='' data-idCategoria='"+$("#categoriav").val()+"'>"+$("#categoriav option:selected").text()+
            "</td><td data-marca='"+$("#marcasv").val()+"' >"+$("#marcasv option:selected").text()+
            "</td><td value='N/A'>"+
            "</td><td>$</td><td>"+$("#preciov").val()+
            "</td><td><input type='number' class='' value='"+$("#preciov").val()+"'></td>"+
            "</td><td class=''><input type='number' class='' value='1'></td>"+
            "</td><td data><input class='btn btn-danger' type='button' value='Quitar'/></td></tr>";
            $("#tablaCarrito").append(tabla);

        }

        //Esconde el texto del select y resetea el bvalor de precio
        $("#tipov option:selected").attr("hidden",true);
        $("#tipov").val("");
        $("#preciov").val("");
        $("#preciocav").val("");
        $("#subtotal").val("");
        
    }
    else
    {
        swal("Aviso","Requiere introducir un valor válido","warning");
    }
    
});

$("#btnBuscarCli").on("click",function(){
   $("#buscarCliente").slideDown();
   $("#nvoCliente").slideUp();
   $("#btnGuardarCli").closest("div").hide();
});


$("#btnGuardarCli").on("click",function(){

  if((nombre)!="" && (apepat)!="" && (apemat)!="")//Nombre y apellidos no pueden estar vacios.
    {
        var nombre = $("#nomCli").val();
        var apepat = $("#apepCli").val();
        var apemat = $("#apemCli").val();
        var correo = $("#correo").val();
        var tele = $("#telef").val();

        $.ajax({
            cache:false,
            url:"../../Controlador/Ventas/nuevoCliente",
            method:"POST",
            data:{
                 "nombre":nombre,
                 "apepat":apepat,
                 "apemat":apemat,
                 "correo":correo,
                    "tele":tele
            },
            beforeSend:function(){$("#btnGuardarCli").prop("disabled",true)},
            
        }).done(function(data){
            if(data==1){
                             
                swal("¡Éxito!", "Se ha guardado el cliente correctamete", "success"); 
            }else{
                swal("Aviso", "Hubo un problema","error");
            }
        })
    }
    else{
        swal("Aviso","Hubo error al guardar","error");
    }
});

$('#tablaCarrito').on("click", "tr>td>input[type='button']",function(e){
    //Antes de remover, consigue el idTipo para regresarlo al select
    //idT=$(e.currentTarget).closest("td").prev().attr("data-tipoprecio");
    //$("#tipoprecio option[value='"+idT+"']").attr("hidden",false);
    $(e.currentTarget).closest("tr").remove(); 

    

 
});



</script>


<footer class="footer_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="social_icon">
                    <ul>
                        <li><a href="https://www.facebook.com/Acumuladores-Garza-1105702469636789"><img src="<?php echo $dominio?>Img/fb-icon.png"></a></li>
                        <!--<li><a href="#"><img src="<?php echo $dominio?>Img/twitter-icon.png"></a></li>                      
                        <li><a href="#"><img src="<?php echo $dominio?>Img/instagram-icon.png"></a></li>-->
                        <li><img src="<?php echo $dominio?>Img/call-icon.png"><span style="padding-left: 10px;"><a class=texto-mail href="#">33 3613 3199</a></span></li>
                        <li><img src="<?php echo $dominio?>Img/mail-icon.png"><span style="padding-left: 10px;"><a class="texto-mail" href="acumuladoresgarza@gmail.com">acumuladoresgarza@gmailcom</a></span></li>
                        
                    </ul>                       
                </div>          
            </div>
        </div>
        <div class="copyright_section">
            <p class="copyright_text">  <?php echo date("Y"); ?> Realizado por ANJANATH</p>
        </div>
    </div>
</footer>
    <!--footer section end -->
    <style>
        .texto-mail{
            color:white;
        }
        .texto-mail:hover{
            color:#EDA854;
        }
    </style>
    <!-- Javascript files-->
    
</body>
</html>
