
<?php 
session_start();
$dominio="http://localhost:8080/garsoft/";
include("../../Modelo/NoCSRF.php");
?>        
<!DOCTYPE html>
<html lang="es">
<head>
<!-- basic -->
<meta charset="UTF-8"/>
<meta name="description" content="Acumuladores Garza es un centro de distribución de baterías automotriz, ven a visitarnos."/>
<meta name="keywords" content="HTML, CSS, JavaScript, Garza, Acumuladores, Baterías, Bateria, Carro, Camion, Energia, Energía, Corriente, Servicio, Sabado, Sábado, Semana"/>
<meta name="author" content="ANJANATH"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="viewport" content="initial-scale=1, maximum-scale=1"><!-- bootstrap css -->
<title><?php echo $titulo; ?></title>

<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/bootstrap.min.css">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/style.css">
<!-- Responsive-->
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/responsive.css">
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/jquery.mCustomScrollbar.min.css">
<!-- owl stylesheets --> 
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/owl.carousel.min.css">

<!--Librerias que si le sabemos-->
<!--SweetAlert-->
<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Tweaks for older IEs-->
<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<!--Reportes con Js-->
<script type="text/javascript" src="<?php echo $dominio; ?>Contenido/jspdf/dist/jspdf.min.js"></script>
<!--JQuery-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!--Najar-->
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/formg.css">
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/login.css">
</head>
<body>
	
	<!--header section start -->
<div class="header_nondecorative">
    <div class="container">
        <?php include("menu.php")?>
   <!--header section end -->
   </div>
</div>
    <!--banner section end -->
    <?php
        if(isset($_SESSION["nombre"])){
            //Se genera el token para mas seguridad del sitio
            $token=NoCSRF::generate('csrf_token');
            echo "generado ".$token."\n";
        }
    ?>
<style>
td div input[type=number]{
    text-align: center; 
}
.tabla-Contenido-Centrado tbody tr td, .tabla-Contenido-Centrado tbody tr th{
    text-align: center;
}
</style>