<?php
$titulo="Empleados";
include("../Compartido/encabezado.php");
$conn=Conectar::conexion();
?>

<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/formg.css">
<link rel="stylesheet" href="<?php echo $dominio; ?>Contenido/css/botones.css">

<article class="container">
    <h2>Editar Empleado </h2>
    <hr/>
</article>
<div class="main-wrapper">
    
    <?php 

    $id = $_GET['idPersona'];
    $sql = "Select * from persona where idPersona = ".$id."";
    $result=$conn->query($sql);
    
    while($row = mysqli_fetch_object($result)){
        ?>
        <form action="" method="post" class="formA">
            <div>
                <label>Nombre:</label><br>
                <input type="text" name="nombre" id="nombre" tabindex="1" style="width: 48%" value="<?php echo $row->nombre;?>">
            </div>
            <div class="divl">
                <label>Apellido Paterno:</label>
                <input type="text" name="apellidop" id="apellidop" tabindex="2" value="<?php echo $row->apellido1;?>"><br>
                <label>E-mail:</label>
                <input type="text" name="correo" id="correo" tabindex="4" value="<?php echo $row->correo;?>"><br>
            </div>
            <div class="divr">
                <label>Apellido Materno:</label>
                <input type="text" name="apellidom" id="apellidom" tabindex="3" value="<?php echo $row->apellido2;?>"><br>
                <label>Telefono:</label>
                <input type="text" name="telefono" id="telefono" maxlength="10" tabindex="5" value="<?php echo $row->telefono;?>"><br>
            </div>
            <div class="divc">
                <input type="submit" name="submit" id="submit" class="botonA btn"></input>
            </div>   
        </form>
        <?php 
        ;} 
        ?>
    
    <?php
    if(isset($_POST['submit'])){
        $field = array("nombre"=>$_POST['nombre'], "apellido1"=>$_POST['apellidop'],"apellido2"=>$_POST['apellidom'], "correo"=>$_POST['correo'], "telefono"=>$_POST['telefono']);

        $sql = "UPDATE persona SET ";
        $data = array();
    
        foreach($field as $column=>$value){
    
            $data[] =$column."="."'".$value."'";
        }
        $sql .= implode(',',$data);
        $sql.=" where idPersona = ".$id."";

        $result2=$conn->query($sql);
        unset($conn);
        if ($result2) {
            ?>    
            <script type="text/javascript">
                swal("Aviso","Empleado modificado", "success",{
                }).then((value)=>{
                    window.location.href= "<?php echo $dominio; ?>Vista/Empleado/manipularEmpleado";
                });
            </script>
        <?php } else {
            ?> 
            <script type="text/javascript">
                swal("Aviso","Ocurrio un error", "error");
            </script>
        <?php }
    }
    ?>  
</div>