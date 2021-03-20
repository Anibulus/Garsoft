<?php
//Si no tiene la sesion iniciada no se le permte volver a iniciar
$titulo="Empleados";
include("../Compartido/encabezado.php");
include("../../Controlador/Empleados/ManipularEmpleado.php");

?>

<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/formg.css">
<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/botones.css">

<body>
<div class="main-wrapper">
<h2>Editar Registros con Función PHP </h2>
<br><br>
<?php 
$id = $_GET['idPersona'];

$sql = "Select * from persona where idPersona = ".$id."";
    $result=$conn->query($sql);
    $GLOBALS['row'] = mysqli_fetch_object($db);

    return $result;
?>
<form action="" method="post">
    <input type="text" value="<?php echo $row->nombres;?>" name="nombres">
    <input type="text" value="<?php echo $row->apellidos;?>" name="apellidos">
    <input type="submit" name="submit">
</form>

<?php
    
    if(isset($_POST['submit'])){
        $field = array("nombres"=>$_POST['nombres'], "apellidos"=>$_POST['apellidos']);
        $tbl = "tabla_demo";
        edit($tbl,$field,'id',$id);
        header("location:index.php");
    }
?>
</div>