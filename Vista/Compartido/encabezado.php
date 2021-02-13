<!DOCTYPE HTML>
<html>
    <head> 
        <meta charset="UTF-8"/>
        <meta name="description" content="Acumuladores Garza es un centro de distribución de baterías automotriz, ven a visitarnos."/>
        <meta name="keywords" content="HTML, CSS, JavaScript, Garza, Acumuladores, Baterías, Bateria, Carro, Camion, Energia, Energía, Corriente, Servicio, Sabado, Sábado, Semana"/>
        <meta name="author" content="ANJANATH"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- Estilo Texto -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!--Los main son archivos que no pertenecen a bpptstrap. Son modificables-->
        <link rel="stylesheet" href="../../Contenido/css/main.css">
        <script type="text/javascript" src="../../Contenido/js/main.js"></script>
        <!--SweetAlert-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!--Reportes con Js-->
        <script src="../../Contenido/jspdf/dist/jspdf.min.js"></script>
        <!--JQuery-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <title><?php echo $titulo; ?></title>
    </head>
    <body class="container">
    <?php
        session_start();
        if(isset($_SESSION["nombre"])){
            //TODO mostrar mensaje de bienvenida
        }
        include("menu.php");
    ?>