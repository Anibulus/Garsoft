<style>
    ul {
      list-style-type: none;
      margin: 0;
      margin-right: 2px;
      padding: 0;
      overflow: hidden;
    
    }
    
    li {
      float: left;
      margin-right: 10px;
    }
    
    li a {
      display: block;
      padding: 8px;
      background-color: #dddddd;
    }
    </style>

<?php
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    $conn=Conectar::conexion();
    if($conn){
        $instruccion="select p.idPerfil, m.idMenu, m.nombre, m.direccion from perfil p  
        join intermediaPerfilMenu ipm on p.idPerfil=ipm.idPerfil
        join menu m on ipm.idMenu=m.idMenu where p.idPerfil=".$_SESSION["idPerfil"].";";

        $result=$conn->query($instruccion);

        $menu="<nav><ul>
        <li> <a href='../Inicio/Inicio'>Incio</a></li>";
        for($i=0;$i<$result->num_rows;$i++){
            $row=$result->fetch_assoc();
            $menu.="<li><a href='".$row["direccion"]."'>".$row["nombre"]."</a></li>";
        }
        $menu.="<li><a href='../../Controlador/CerrarSesion'>Cerrar Sesión</a></li>";
        $menu.="</ul></nav>";

        echo $menu;
        

        unset($conn);
        unset($result);
        unset($instruccion);
        unset($menu);
    }
    
}
else{
    echo "


<nav>

    <ul>
        <li> <a href='../Inicio/Inicio'>Incio</a></li>
        <li> <a href='../Sesion/IniciarSesion'>Iniciar Sesión</a></li>
    </ul>
</nav>";

}
?>