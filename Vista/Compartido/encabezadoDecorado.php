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
<script src="https://kit.fontawesome.com/f100cb247b.js" crossorigin="anonymous"></script>
<!--Reportes con Js-->
<script type="text/javascript" src="<?php echo $dominio; ?>Contenido/jspdf/dist/jspdf.min.js"></script>
<script type="text/javascript" src="<?php echo $dominio; ?>Contenido/jspdf/dist/jspdf.plugin.autotable.min.js"></script>
<!--JQuery-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!--Najar-->
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/formg.css">
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/login.css">
<link rel="stylesheet" type="text/css" href="<?php echo $dominio?>Contenido/css/botones.css">
</head>
<body>
	
	<!--header section start -->
<div class="header_section">
    <div class="container">
        <?php include("menu.php")?>

    <div class="row">
        <div class="">
            <section>
                <div id="main_slider" class="section carousel slide banner-main" data-ride="carousel">
                <div class="carousel-inner">


                <div class="carousel-item active">
                    <div class="container">
                        <div class="row marginii">
                            <div class="col-md-5 col-sm-12">
                                <div class="carousel-sporrt_text ">
                                    <h1 class="banner_taital">Envío gratis</h1>
                                    <p class="lorem_text">¡En la compra de tu acumulador el servicio y la instalación GRATIS!</p>
                                    <div class="ads_bt"><a href="#">33 3613 3199</a></div>
                                        <div class="contact_bt"><a href="#">33 3120 8741</a></div>
                                        </div>
                                    </div>
                                <div class="col-md-7 col-sm-12">
                                    <div class="img-box">
                                        <figure>
                                            <img src="<?php echo $dominio?>Img/Bateria.png" style="max-width: 100%;"/>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                </div>
                </div>
            </section>
        </div>
    </div>
   </div>
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
</style>