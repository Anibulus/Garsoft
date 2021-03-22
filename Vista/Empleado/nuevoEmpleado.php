<?php
//Si no tiene la sesion iniciada no se le permte volver a iniciar
$titulo="Empleados";
include("../Compartido/encabezado.php");

?>

<article class="container">
	<h2>Nuevo Empleado</h2>
	<hr/>
</article>
<form class="formA" name="nuevoe" id="nuevoe">
	<div>
		<label>Nombre:</label><br>
		<input type="text" name="nombre" id="nombre" tabindex="1" style="width: 48%">
		<div class="divr">
			<a class="btn btn-secondary" href="<?php echo $dominio; ?>Vista/Empleado/manipularEmpleado">Ver Empleados</a>
		</div>
	</div>
	<div class="divl">
		<label>Apellido Paterno:</label>
		<input type="text" name="apellidop" id="apellidop" tabindex="2"><br>
		<label>E-mail:</label>
		<input type="text" name="correo" id="correo" tabindex="4"><br>
		<label>Nombre de Usuario:</label>
		<input type="text" name="usuario" id="usuario" tabindex="6"><br>
		<label>Contraseña:</label>
		<input type="password" name="pass" id="pass" tabindex="8"><br>
		<span class="field-icon"></span>
	</div>
	<div class="divr">
		<label>Apellido Materno:</label>
		<input type="text" name="apellidom" id="apellidom" tabindex="3"><br>
		<label>Telefono:</label>
		<input type="text" name="telefono" id="telefono" maxlength="10" tabindex="5"><br>
		<label>Tipo de Usuario:</label><br>
		<select name="tipo" id="tipo" tabindex="7" class="input-group-text">
  			<option value="1">Administrador</option>
  			<option selected="true" value="2">Empleado</option>
  		</select>
  		<br>	
		<label>Repetir Contraseña:</label>
		<input type="password" name="passr" id="passr" tabindex="9"><br>
	</div>
</form>
<div class="divc">
	<br>
	<span id="formError" style="color:#ad472c;font-weight:bold"></span>
	<span id="formError2" style="color:#ad472c;font-weight:bold"></span>
	<span id="formError3" style="color:#ad472c;font-weight:bold"></span>
	<span id="formError4" style="color:#ad472c;font-weight:bold"></span>
	<br>
	<button name="insert" id="insert" class="botonA btn" disabled>Aceptar</button>
</div>

<?php
include("../Compartido/piePagina.php");
?>

<script>
$(document).ready(function() {

    cor=0; 
    pas=0;
    pasr=0;
    tel=0;

    errorSpan = document.getElementById("formError");
    errorSpan2 = document.getElementById("formError2");
    errorSpan3 = document.getElementById("formError3");
    errorSpan4 = document.getElementById("formError4");

    $("#correo").keyup(function() {
		if($("#correo").val().indexOf('@', 0)== -1 || $("#correo").val().indexOf('.', 0) == -1) {
			$("#insert").prop("disabled", true);
			errorSpan2.innerHTML = "Ingrese un e-mail valido";	
			cor=0
		} else {
			errorSpan2.innerHTML = "";
			cor=1;
		}
	});

	$("#pass").keyup(function() {
			
		if($("#pass").val().length <= 5) {
			$("#insert").prop("disabled", true);
			errorSpan3.innerHTML = "La constraseña Minimo 6 caracteres";
			pas=0
		} 
		else { 
			errorSpan3.innerHTML = "";
			pas=1;
		}
	});
	
	$("#passr").keyup(function() {
		
		pass1 = $("#pass").val();
    	pass2 = $("#passr").val();
		
		if(pass1 == pass2) {
			errorSpan4.innerHTML = "";
			pasr=1;
		}
		else { 
			$("#insert").prop("disabled", true);
			errorSpan4.innerHTML = "Las constraseñas no coinciden";
			pasr=0
		}
	});

	$("#telefono").keyup(function() {
		
		if($(this).val().length <=9) {
			$("#insert").prop("disabled", true);
			errorSpan4.innerHTML = "Ingrese un telefono valido";
			tel=0
		}
		else { 
			errorSpan4.innerHTML = "";
			tel=1;
		}
	});

	$("#nuevoe input").keyup(function(){
		var form = $(this).parents("#nuevoe");
		var check = checkCampos(form);
		console.log(check);

		pass1 = $("#pass").val();
    	pass2 = $("#passr").val();

		if(check && cor==1 && pas==1 && pass1 == pass2 && tel==1) {
			$("#insert").prop("disabled", false);
			errorSpan4.innerHTML = "";
		} else if (pass2.length !=0 && pass1 != pass2){
			$("#insert").prop("disabled", true);
			errorSpan4.innerHTML = "Las constraseñas no coinciden";
		} else {
			$("#insert").prop("disabled", true);
		}
	});
			
});
	
//Función para comprobar los campos de texto
function checkCampos(obj) {

	obj.find("input").each(function() {
		var $this = $(this);

		if($this.val().length <= 0) {
			camposRellenados = false;
			return false;
		}
		else {
			camposRellenados = true;
			return true;
		}
	});

	if(camposRellenados == false) {
		return false;
	}
	else {
		return true;
	}
}

$("#insert").on("click",function(){
    $.ajax({
        cache:false,
        method:"Post",
        data: $("#nuevoe").serialize(),//Utiliza la etiqueta "name"
        url:"../../Controlador/Empleados/NuevoEmpleado",//.php
        beforeSend:function(){ $("#insert").prop("disabled",true);}
    }).done(function(data){
        console.log(data);
        if(data==0){
            swal("Aviso","Correo registrado anteriormente", "warning");
            $("#correo").val('');
        }else if(data==1){
            swal("Aviso","Usuario no disponible", "warning");
            $("#usuario").val('');
        }else if(data==2){
            $("#nuevoe")[0].reset();
            swal("Aviso","Nuevo empleado registrado", "success");
        }else if(data==3){
            swal("Aviso","Ocurrio un error al registrar", "error");
        }
    });
});
</script>
</script>
