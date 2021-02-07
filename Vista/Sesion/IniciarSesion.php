<?php
//Si no tiene la sesion iniciada no se le permte volver a iniciar
$titulo="Inicio de sesión";
include("../Compartido/encabezado.php");

if(isset($_SESSION["nombre"])){
    header("location:../Inicio/inicio");
    echo "estoy aqui";
}
?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="/Garsoft/Contenido/css/login.css">

<form class="modal-content animate" id="LogIn" name="LogIn">

    <div class="container" style="text-align: center;">
        <table align="center"> 
            <tr>
                <legend>Ingrese los datos para iniciar sesión</legend>
                <td align="left"><label><span>Usuario:</span></label></td>
                <td style= "width:200px"><input type="text" id="usuario" name="usuario" maxlength="10"></label></td>
            </tr>
            <tr>
                <td align="left"><label><span>Contraseña:</span></label></td>
                <td><input type="password" id="contrasena" name="contrasena" maxlength="10"></td>
            </tr>
        </table>

        <input type="button" class="btn btn-primary" id="btnIniciar" value="Iniciar Sesión"/>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <span class="password" align="center"><a href="#">¿Olvido su contraseña?</a></span>
    </div>
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
