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
<link rel="stylesheet" href="<?php echo $dominio?>Contenido/css/responsive.css">
<!-- fevicon -->
<link rel="icon" href="<?php echo $dominio?>Img/fevicon.png" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="<?php echo $dominio?>Contenido/css/jquery.mCustomScrollbar.min.css">
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<!-- owl stylesheets --> 
<link rel="stylesheet" href="<?php echo $dominio?>Contenido/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo $dominio?>Contenido/css/owl.theme.default.min.css">

<!--SweetAlert-->
<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--Reportes con Js-->
<script type="text/javascript" src="<?php echo $dominio; ?>Contenido/jspdf/dist/jspdf.min.js"></script>
<!--JQuery-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
	
	<!--header section start -->
<div class="header_section">
    <div class="container">
        <?php include("menu.php")?>

    <div class="row">
        <div class="banner_section layout_padding">
            <section>
                <div id="main_slider" class="section carousel slide banner-main" data-ride="carousel">
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row marginii">
                            <div class="col-md-5 col-sm-12">
                                <div class="carousel-sporrt_text ">
                                    <h1 class="banner_taital">Classified Ads</h1>
                                    <p class="lorem_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                    <div class="ads_bt"><a href="#">Ads Now</a></div>
                                        <div class="contact_bt"><a href="#">Contact Us</a></div>
                                        </div>
                                    </div>
                                <div class="col-md-7 col-sm-12">
                                    <div class="img-box">
                                        <figure>
                                            <img src="<?php echo $dominio?>Img/banner-img1.png" style="max-width: 100%;"/>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="carousel-item">
                <div class="container">
                    <div class="row marginii">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="carousel-sporrt_text ">
                                <h1 class="banner_taital">Classified Ads</h1>
                                <p class="lorem_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                <div class="ads_bt"><a href="#">Ads Now</a></div>
                                    <div class="contact_bt"><a href="#">Contact Us</a></div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="img-box">
                                        <figure>
                                            <img src="<?php echo $dominio?>Img/banner-img1.png" style="max-width: 100%;"/>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row marginii">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="carousel-sporrt_text ">
                                        <h1 class="banner_taital">Classified Ads</h1>
                                        <p class="lorem_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,</p>
                                        <div class="ads_bt"><a href="#">Ads Now</a></div>
                                            <div class="contact_bt"><a href="#">Contact Us</a></div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                            <div class="img-box">
                                                <figure>
                                                    <img src="<?php echo $dominio?>Img/banner-img1.png" style="max-width: 100%;"/>
                                                </figure>
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
        }      
        
    ?>
<style>
td div input[type=number]{
    text-align: center; 
}
</style>