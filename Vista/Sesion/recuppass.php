<?php
//Si no tiene la sesion iniciada no se le permte volver a iniciar
$titulo="Recuperar Contraseña";
include("../Compartido/encabezado.php");

?>


<link rel="stylesheet" href="<?php echo $dominio?>Contenido/css/login.css">

<form class="modal-content animate" id="recup" name="recup">

    <div class="container" style="text-align: center;">
        <table align="center"> 
            <tr>
                <legend>Ingrese los datos para la recuperación</legend>
                <td align="left"><label><span>Correo:</span></label></td>
                <td style= "width:200px"><input type="text" id="correo" name="correo"></label></td>
            </tr>
        </table>
        <input type="button" class="btn btn-primary" id="btnAceptar" value="Aceptar"/>
    </div>
</form>

<?php
include("../Compartido/piePagina.php");
?>

<script>

$("#btnAceptar").on("click",function(){
    $.ajax({
        cache:false,
        method:"Post",
        data: $("#recup").serialize(),//Utiliza la etiqueta "name"
        url:"../../Controlador/Sesion/RecupPass",//.php
        beforeSend:function(){ $("#btnAceptar").prop("disabled",true);}
    }).done(function(data){
        console.log(data);
        if(data==1){
            swal("Aviso","Correo Enviado, Verifique", "success");
        } if(data== 2){
            swal("Error","Hubo un problema al enviar el correo electronico", "error");
        } if(data== 0){
            swal("Aviso","Ingrese un correo electronico valido", "error");
        }
        $("#btnAceptar").prop("disabled",false);
    });
});
</script>