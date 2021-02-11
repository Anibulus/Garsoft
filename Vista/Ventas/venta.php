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

    <h2>La vendimia</h2>
    <section>

    </section>
</article>