<?php
//Si no tiene la sesion iniciada no se le permte volver a iniciar
if(isset($_SESSION["nombre"])){
    header("location:../Inicio/inicio");
}
$titulo="Inicio de sesión";
include("../Compartido/encabezado.php");
?>
<form id="LogIn" name="LogIn">
<fieldset>
<legend>Ingrese los datos para iniciar seión</legend>
<label><span>Usuario:</span>
<input type="text" id="usuario" name="usuario" maxlength="10"></label>
<label><span>Contraseña:</span>
<input type="password" id="contrasena" name="contrasena" maxlength="10"></label>
<input type="button" class="btn btn-primary" id="btnIniciar" value="Iniciar Sesión"/>
</fieldset>
</form>
<?php
include("../Compartido/piePagina.php");
?>
<script>
$("#btnIniciar").on("click",function(){
    $.ajax({
        cache:false,
        method:"Post",
        data: $("#LogIn").serialize(),//Utiliza la etiqueta "name"
        url:"../../Controlador/InicioSesion"//.php
    }).done(function(data){
        console.log(data);
        if(data==1){
            window.location.href="../Inicio/inicio.php";
        }else{
            swal("Aviso","Usuario o contraseña incorrectos", "error");
        }
    });
});
</script>