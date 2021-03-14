<?php
//Si no tiene la sesion iniciada no se le permte volver a iniciar
$titulo="Empleados";
include("../Compartido/encabezado.php");
include("../../Controlador/Empleados/ManipularEmpleado.php");
?>

<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/tablas.css">
<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/botones.css">

<div class="main-wrapper">
<h2 align="center">Empleados</h2>
<br><br>
<br>

<?php
    if(isset($_POST['submit'])){
        $field = array("name"=>$_POST['name']);
        $tbl = "tabla_demo";
        insert($tbl,$field);
    }
?>
<table>
    <tr>
        <th width="22%">Nombre</th>
        <th width="22%">Apellidos</th>
        <th width="22%">Correo</th>
        <th width="22%">Telefono</th>
        <th width="12%">Opciones</th>
    </tr>
<?php
    $conn=Conectar::conexion();

    $result=$conn->query("select p.* from persona p 
            join usuario u on p.idPersona = u.idPersona
            where u.idPerfil != 3 and u.activo = 1 ;");
    unset($conn);
    while($row = mysqli_fetch_object($result)){
    ?>
    <tr>
        <td><?php echo $row->nombre;?></td>
        <td><?php echo $row->apellido1." ".$row->apellido2;?></td>
        <td><?php echo $row->correo;?></td>
        <td><?php echo $row->telefono;?></td>
        <td>
            <a class="botonE btn" href="<?php echo $dominio; ?>Vista/Empleado/editarEmpleado.php?idPersona=<?php echo $row->idPersona;?>"><img src="<?php echo $dominio; ?>Contenido/img/edit.png"></a>
            <button class="botonB btn" onclick="borrarEmpleado(<?php echo $row->idPersona;?>)"><img src="<?php echo $dominio; ?>Contenido/img/drop.png"></button>
        </td>
    </tr>
    <?php 
    ;} 
    ?>
</table>
</div>

<script type="text/javascript">
    function borrarEmpleado(idPersona){
        $.ajax({
            cache:false,
            method:"POST",
            data:{"idPersona":idPersona},
            url:"../../Vista/Empleado/borrarEmpleado",
        }).done(function(data){
            console.log(data);
            if(data==0){
                swal("Aviso","Empleado dado de baja", "success");
            }else{
                swal("Aviso","Error al dar de baja", "error");
            }
        });
    }

    function editarEmpleado(idPersona){
        $.ajax({
            cache:false,
            method:"POST",
            data:{"idPersona":idPersona},
            url:"../../Vista/Empleado/borrarEmpleado",
        }).done(function(data){
            console.log(data);
            if(data==0){
                swal("Aviso","Empleado dado de baja", "success");
            }else{
                swal("Aviso","Error al dar de baja", "error");
            }
        });
    }
</script>