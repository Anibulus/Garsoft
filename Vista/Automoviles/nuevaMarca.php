<?php
    $titulo="Marca - Modelo";
    include("../Compartido/encabezado.php");

    if(isset($_SESSION["nombre"])){
        if($_SESSION["idPerfil"]!=1){
            header("location:../Inicio/Inicio");
        }
    }else{
        header("Location: ".$dominio."Vista/Inicio/Inicio");
        die();
    }
?>
<article class="container">
    <h2>Nueva Marca</h2>
    <hr/>
    <section>
    <div class="row">
        <div class="col">
            <label><span>Marca de Automóvil</span>
                <input class='input-group-text' type="text" id="txtMarca" name="txtMarca" />
            </label>
        </div>
        <div class="col">
            <input type="button" id="btnGuardarMarca" name="btnGuardarMarca" class="btn btn-primary" value="Guardar Marca"/>
        </div>
    </div>
    </section>
    
    <h2>Enlace Marca - Modelo</h2>
    <hr/>
    <section>

    <div class="row">
        <div class="col">
            <label><span>Marca de Automóvil</span>
                <select class='input-group-text' name="marcas" id="marcas">
                </select>
            </label>
        </div>

        <div class="col">
            <label><span>Modelo  de automóvil</span>
                <input class='input-group-text' type="text" id="modelo" name="modelo">
            </label>
        </div>
    </div>
    <!--TODO poner tipo de auto-->
    <div class="row">
        <div class="col">
            <label><span>Año Inicio</span>
                <input class='input-group-text' type="number" name="txtAnioInicio" id="txtAnioInicio"/>
            </label>
        </div>
        <div class="col">
            <label><span>Año Fin</span>
                <input class='input-group-text' type="number" name="txtAnioFin" id="txtAnioFin"/>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <input class="btn btn-primary" type="button" value="Guardar Modelo" id="btnGuardarModelo" name="btnGuardarModelo" />
        </div>
    </div> 
  
</article>
<?php
include("../Compartido/piePagina.php");
?>

<script>
$(document).ready(function(){    
    getMarcas();
});

function getMarcas(){
    $.ajax({
        cache:false,
        method:"GET",
        url:"<?php echo $dominio?>Controlador/Automovil/getMarcaAuto",
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


$("#btnGuardarMarca").on("click",function(){
    if($("#txtMarca").val()!=""){
        $.ajax({
            method:"POST",
            cache:false,
            url:"<?php echo $dominio?>Controlador/Automovil/guardarMarca",
            data:{marca:$("#txtMarca").val()},
            beforeSend:function(){
                $("#btnGuardarMarca").prop("disabled",true);
            },
        }).done(function(data){
            if(data==1)
            {
                //Actualiza las marcas que existen si guardó correctamente
                $("#txtMarca").val("");
                getMarcas();
                swal("Éxito","Se ha guardado correctamente","success");
            }
            else if(data==2)
                swal("Aviso","La marca ya existe", "warning");
            else
                swal("Aviso","No ha sido posible guardar", "error");
            $("#btnGuardarMarca").prop("disabled",false);
        });
    }
    else
    {
        swal("Aviso","Para guardar debe escribir la marca.","warning");
    }
});


//Seccion modelo
$("#btnGuardarModelo").on("click",function(){
    if(parseInt($("#marcas").val())>0 && $("#modelo").val()!="" && $("#txtAnioInicio").val()!="" && $("#txtAnioFin").val()!="" )
    {
        $.ajax({
            method:"post",
            cache:false,
            data:{
                marca:$("#marcas").val(),
                nombreModelo:$("#modelo").val(),
                anioInicio:$("#txtAnioInicio").val(),
                anioFin:$("#txtAnioFin").val()
            },
            url:"<?php echo $dominio?>Controlador/Automovil/guardarModelo",
            beforeSend:function(){
                $("#btnGuardarModelo").prop("disabled",true);
            }
        }).done(function(data){
            if(data==1)
            {
                //Actualiza las marcas que existen si guardó correctamente
                $("#modelo").val("");
                $("#marca").val("0");
                $("#anioInicio").val("");
                $("#anioFin").val("");
                swal("Éxito","Se ha guardado correctamente","success");
            }
            else if(data==2)
                swal("Aviso","El modelo ya existe", "warning");
            else
                swal("Aviso","No ha sido posible guardar", "error");
            $("#btnGuardarModelo").prop("disabled",false);
        });
    }
    else
        swal("Aviso","Llenar todos los campos","warning");
});
</script>