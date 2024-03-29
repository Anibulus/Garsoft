<?php
//Si no tiene la sesion iniciada no se le permte volver a iniciar
$titulo="Inicio de sesión";
include("../Compartido/encabezado.php");

if(isset($_SESSION["nombre"])){
    header("location:../Inicio/inicio");
    echo "estoy aqui";
}
?>
<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/login.css">

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
    <div class="divc" style="background-color:#f1f1f1">
      <span class="password" align="center"><a href="recuppass">¿Olvido su contraseña?</a></span>
    </div>
</form>

<?php
include("../Compartido/piePagina.php");
?>

<script>
$('#usuario').on("keydown", function(e){
    if(e.keyCode==13){
        $('#contrasena').focus();
    }
});

$('#contrasena').on("keydown", function(e){
    if(e.keyCode==13){
        $("#btnIniciar").click();
    }
});

$("#btnIniciar").on("click",function(){
    $.ajax({
        cache:false,
        method:"Post",
        data: $("#LogIn").serialize(),//Utiliza la etiqueta "name"
        url:"../../Controlador/Sesion/InicioSesion"//.php
    }).done(function(data){
        console.log(data);
        if(data==1){
            window.location.href="../Inicio/inicio";
        }else{
            swal("Aviso","Usuario o contraseña incorrectos", "error");
        }
    });
});
</script>
