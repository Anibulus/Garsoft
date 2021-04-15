<?php 
session_start();

$dominio="https://acumuladoresgarza.com/";
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
<script src="https://kit.fontawesome.com/f100cb247b.js" crossorigin="anonymous"></script>
<!--Reportes con Js-->
<script type="text/javascript" src="<?php echo $dominio; ?>Contenido/jsPDF/dist/jspdf.min.js"></script>
<script type="text/javascript" src="<?php echo $dominio; ?>Contenido/jsPDF/dist/jspdf.plugin.autotable.min.js"></script>
<!--JQuery-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!--Najar-->
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/formg.css">
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/botones.css">
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

            //echo "generado ".$token."\n";
        }

    ?>
<style>
td div input[type=number]{
    text-align: center; 
}
.tabla-Contenido-Centrado tbody tr td, .tabla-Contenido-Centrado tbody tr th{
    text-align: center;
}

select, select option{
    color:#c6610f;
}
.tablaContenido{
    width:75%; 
    margin-left: auto;
    margin-right: auto;
}

</style>