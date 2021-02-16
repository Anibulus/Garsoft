


<link rel="stylesheet" href="<?php echo $dominio?>/Contenido/css/menu.css">
            
             



<?php
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    $conn=Conectar::conexion();
    if($conn){
        $instruccion="select p.idPerfil, m.idMenu, m.nombre, m.direccion from perfil p  
        join intermediaPerfilMenu ipm on p.idPerfil=ipm.idPerfil
        join menu m on ipm.idMenu=m.idMenu where p.idPerfil=".$_SESSION["idPerfil"].";";

        $result=$conn->query($instruccion);

        $menu="<div class='sidenav'>
             <a href='".$dominio."/Inicio/Inicio'>Inicio</a>";
        for($i=0;$i<$result->num_rows;$i++){
            $row=$result->fetch_assoc();
            $menu.="<a href='".$dominio.$row["direccion"]."'>".$row["nombre"]."</a>";
        }
        
        $menu.="<a href='".$dominio."/Controlador/CerrarSesion'>Cerrar Sesión</a>";

        $menu.="</div>";

        echo $menu;
        

        unset($conn);
        unset($result);
        unset($instruccion);
        unset($menu);
    }
    
}
else{
    echo "


<div class='sidenav'>

    <a href='../Inicio/Inicio'>Inicio</a>
    <a href='../Sesion/IniciarSesion'>Iniciar Sesión</a>
   
</div>";

}
?>