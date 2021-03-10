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
            <label><span>Marca de Producto</span>
                <select class='form-control' name="marcasv" id="marcasv">
                </select>
            </label>
        </div>

       <div class="form-group">   
            <label><span>Producto</span>
                <div class='input-group'>
                    <div class="input-group-prepend"></div>
                    <input name="nomPro" id="nom" type="text" class='form-control' aria-label='Amount' />
                </div>
            </label>
            <label><span>Precio</span>
                <div class='input-group'>
                    <div class="input-group-prepend"></div>
                    <input name="precio" id="precio" type="text" class='form-control' aria-label='Amount' />
                </div>
            </label>
            <input type="button" id="btnAgregar" name="btnAgregar" value="Añadir al carro" class="btn btn-secondary" />
    <div class="row" >

            <!--<label><span>Fecha</span>
                <div class='input-group'>
                    <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
                    <input name="fechaVent" id="fechaVent" type="date" class="form-control" aria-label='Amount'>
                </div>
            </label>-->

            

            

            
        
    </div>

 <label for="browser">Choose your browser from the list:</label>
<input list="browsers" name="browser" id="browser">

<datalist id="browsers">
  <option value="Edge"> 
  <option value="Firefox">
  <option value="Chrome">
  <option value="Opera">
  <option value="Safari">
</datalist>             

    <div class="row">
            <!--<input type="button" class="btn btn-primary" id="btnGuardar" name="btnGuardar" value="Guardar"/>-->

            
          
    </div>
</article>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Cliente</button>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
    
            <!-- Modal content-->
            <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Cliente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>


            <div class="modal-body">
                
                
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

                    <input type="button" class="btn btn-primary" id="btnGuardarCli" name="btnGuardarCli" value="Guardar Cliente"/>
                    <input type="button" class="btn btn-primary" id="btnBuscarCli" value="Seleccionar Cliente">
                    </div>
                </div>


        <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
      
    </div>
</div>


<script>

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
                swal("Aviso", "Hubo un problema con su vida","error");
            }
        })
    }
    else{
        swal("Aviso","Hubo error al guardar","error");
    }
});




/*$("#nvoCliente").hidden();

//busquedaCli


$("#b_cli").on("keypress",function()){

}

$("#b_cliap").on("keypress",function()){
    
}

$("#b_cliam").on("keypress",function()){
    
}*/



/*function getNombreCli(){

    $.ajax({
        cache:false,
        method:"POST",
        url:"",
        data: {nombre: $("#b_cli").val(), apellidop: $("#b_cliap").val(), apellidom: $("#b_cliam")}
        url: 
        error: function(response){}
    }).done(function(data){
        if(data.length>0){
            opciones="<option value='0' hidden selected> Seleccione...</option>";
           $.each(data, function(i,item){
                opciones+="<option value='"+item.idMarca+"'>"+item.nombre+"</option>"
           });
           $("#marcasv").html(opciones);
       }else{
        $("#b_cli")

        $("#b_cliap")

        $("#b_cliam")


       }
    });

} */


getMarcas();   


function getMarcas(){
    $.ajax({
        cache:false,
        method:"GET",
        url:"../../Controlador/Productos/getMarcas",
        error: function(response){}
    }).done(function(data){
        if(data.length>0){
            opciones="<option value='0' hidden selected> Seleccione...</option>";
           $.each(data, function(i,item){
                opciones+="<option value='"+item.idMarca+"'>"+item.nombre+"</option>"
           });
           $("#marcasv").html(opciones);
       }
    });
}//Fin de getMarcas

$("#marcasv").on("change",function(){
    alert("wacha!")
})

/*function guardarCliente(e, nombre, apepat, apemat, correo, tel){

    if((nombre)!="" && (apepat)!="" && (apemat)!="")//Nombre y apellidos no pueden estar vacios.
    {
        $.ajax({
            cache:false,
            url:"../../Controlador/Ventas/nuevoCliente",
            method:"POST",
            data:{
                csrf_token:"<?php echo $token;?>",
                nombre:$("#nomCli").val(),
                apepat:$("#apepCli").val(),
                apemat:$("#apemCli").val(),
                correo: $("#correo").val(),
                tele: $("telef").val(),
            
            },
            beforeSend:function(){$(e.currentTarget).prop("disabled",true)},
            error:function(){}
        }).done(function(data){
            if(data==1){
                             
                swal("¡Éxito!", "Se ha guardado el cliente correctamete", "success"); 
            }
        })
    }
    else{
        swal("Aviso","Hubo error al guardar","error");
    }
}//fin de guardar cliente*/

</script>

