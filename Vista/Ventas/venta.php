<?php
    $titulo="La vendimia";
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
    <h2>Modulo de venta</h2>
    <section>
    <div class="row">
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
                    <input name="nomPro" id="nom" type="text" class='form-control' aria-label='Amount' />
                </div>
            </label>
    <div class="row" >

            <label><span>Fecha</span>
                <div class='input-group'>
                    <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
                    <input name="fechaVent" id="fechaVent" type="date" class="form-control" aria-label='Amount'>
                </div>
            </label>

            <label><span>Total</span>
                <div class='input-group'>
                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                    <input name="precio" id="precio" type="text" class='form-control' aria-label='Amount' />
                </div>
            </label>

            
        
    </div>
            

    <div class="row">
            <input type="button" class="btn btn-primary" id="btnGuardar" name="btnGuardar" value="Guardar"/>
            </div>
    </div>
</article>