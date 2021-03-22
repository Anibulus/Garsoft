<?php
//Si no tiene la sesion iniciada no se le permte volver a iniciar
$titulo="Empleados";
include("../Compartido/encabezado.php");
//require("../../Modelo/Conexion/conexion.php");
?>

<!--<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/tablas.css">-->
<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/botones.css">

<article class="container">
    <h2>Empleados</h2>
    <hr/>
    <div class="table-responsive tablaContenido">
        <table class='table caption-top table-dark table-striped table-hover tabla-Contenido-Centrado'>
            <tr class="row">
                <th class='col' width="22%">Nombre</th>
                <th class='col' width="22%">Apellidos</th>
                <th class='col' width="22%">Correo</th>
                <th class='col' width="22%">Telefono</th>
                <th class='col' width="12%">Opciones</th>
            </tr>
        <?php
            $conn=Conectar::conexion();
        
            $result=$conn->query("select p.* from persona p 
                    join usuario u on p.idPersona = u.idPersona
                    where u.idPerfil != 3 and u.activo = 1 ;");
            unset($conn);
            while($row = mysqli_fetch_object($result)){
            ?>
            <tr class="row">
                <td class='col'><?php echo $row->nombre;?></td>
                <td class='col'><?php echo $row->apellido1." ".$row->apellido2;?></td>
                <td class='col'><?php echo $row->correo;?></td>
                <td class='col'><?php echo $row->telefono;?></td>
                <td class='col'>
                    <a class="botonE btn" href="<?php echo $dominio; ?>Vista/Empleado/editarEmpleado.php?idPersona=<?php echo $row->idPersona;?>"><img src="<?php echo $dominio; ?>Contenido/img/edit.png"></a>
                    <button class="botonB btn" onclick="borrarEmpleado(<?php echo $row->idPersona;?>)"> <img src="<?php echo $dominio; ?>Contenido/img/drop.png"></button>
                </td>
            </tr>
            <?php 
            ;} 
            ?>
        </table>
    </div>
</article>

<?php
include("../Compartido/piePagina.php");
?>

<script type="text/javascript">
    function borrarEmpleado(idPersona){
        swal("¿Quiere dar de baja al empleado?", {
            buttons: {
                cancel: "Cancelar",
                simon: "Aceptar"             
            },
        })
        .then((value) => {
            switch (value) {        
                case "simon":
                $.ajax({
                    cache:false,
                    method:"POST",
                    data:{"idPersona":idPersona},
                    url:"../../Vista/Empleado/borrarEmpleado",
                }).done(function(data){
                    console.log(data);
                    if(data==0){
                        swal("Aviso","Empleado dado de baja", "success",{
                        }).then((value)=>{
                            location.reload();
                        });
                    }else{
                        swal("Aviso","Error al dar de baja", "error");
                    }
                });
                break;
                default:
                break;
            }
        });
    }

    function editarEmpleado(idPersona){
        $.ajax({
            cache:false,
            method:"POST",
            data:{"idPersona":idPersona},
            url:"../../Vista/Empleado/editarEmpleado",
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