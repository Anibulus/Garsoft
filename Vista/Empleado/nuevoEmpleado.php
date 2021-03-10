<?php
//Si no tiene la sesion iniciada no se le permte volver a iniciar
$titulo="Registrar Empleado";
include("../Compartido/encabezado.php");

?>

<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/formg.css">
<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/botones.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<form class="form" name="nuevoe" id="nuevoe">
	<h2>Nuevo Empleado</h2>
	<div>
		<label>Nombre:</label>
		<input type="text" name="nombre" id="nombre">
	</div>
	<div class="divl">
		<label>Apellido Paterno:</label>
		<input type="text" name="apellidop" id="apellidop"><br>
		<label>E-mail:</label>
		<input type="text" name="correo" id="correo"><br>
		<label>Nombre de Usuario:</label>
		<input type="text" name="usuario" id="usuario"><br>
		<label>Contraseña:</label></span>
		<input type="password" name="pass" id="pass"><br>
	</div>
	<div class="divr">
		<label>Apellido Materno:</label>
		<input type="text" name="apellidom" id="apellidom"><br>
		<label>Telefono:</label>
		<input type="number" name="telefono" id="telefono"><br>
		<label>Tipo de Usuario:</label>
		<input type="radio" id="adm" name="tipo" value="adm" checked="true">
		<label for="adm">Administrador</label>
		<input type="radio" id="emp" name="tipo" value="emp">
		<label for="emp">Empleado</label><br> 			
		<label>Repetir Contraseña:</label>
		<input type="password" name="passr" id="passr"><br>
	</div>
</form>
<div class="divc">
	<br>
	<span id="formError" style="color:#ad472c;font-weight:bold"></span>
	<span id="formError2" style="color:#ad472c;font-weight:bold"></span>
	<span id="formError3" style="color:#ad472c;font-weight:bold"></span>
	<span id="formError4" style="color:#ad472c;font-weight:bold"></span>
	<br>
	<button name="insert" id="insert" class="botonA" disabled>Aceptar</button>
</div>
<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
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
		
			
		if($(this).val().length <=9 || $(this).val().length > 10) {
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
</script>
