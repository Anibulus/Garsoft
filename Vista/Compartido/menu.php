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





<?php
/*
# definimos el array de valores para el menu y submenus
if(isset($_SESSION["nombre"]))
{               
    $menu=array(
        array(
            'titulo' => '',
            'enlace' => '',
            'subcategoria' => array(
                array(
                    'id' => 'perfil.php',
                    'titulo' => 'Perfil',
                    'enlace' => 'perfil.php',
                ),
                array(
                    'id' => 'cambiar_contrasena.php',
                    'titulo' => 'Cambiar contraseña',
                    'enlace' => 'cambiar_contrasena.php',
                ),
                array(
                    'id' => 'comprobar.php',
                    'titulo' => 'Comprobar',
                    'enlace' => 'comprobar.php',
                ),
            ),#Fin de array subcategoria
        ),#Fin de array contenido
    );#Fin de array
} else {
    $menu=array(
        array(
            'titulo' => 'Registrarse',
            'enlace' => 'registro.php',
            'subcategoria' => array(
                array(
                    'id' => 'perfil.php',
                    'titulo' => 'Perfil',
                    'enlace' => 'perfil.php',
                ),
                array(
                    'id' => 'cambiar_contrasena.php',
                    'titulo' => 'Cambiar contraseña',
                    'enlace' => 'cambiar_contrasena.php',
                ),
                array(
                    'id' => 'comprobar.php',
                    'titulo' => 'Comprobar',
                    'enlace' => 'comprobar.php',
                ),
                array(
                    'id' => 'IniciarSecion.php',
                    'titulo' => 'Iniciar Sesion',
                    'enlace' => '/Garsoft/Vista/Sesion/IniciarSesion.php',
                ),
            ),#Fin de array subcategoria
        ),#Fin de array contenido
    );#Fin de array
}
/**
* Funcion para mostrar los enlaces
* Tiene que recibir el array de valores y la clase a asignar que puede ser:
* menu o submenu
*/

/*
function mostrarEnlace($menu,$class)
{
    if($menu['enlace'])
    {
    echo "<a href='".$menu['enlace']."'>";
    }

    echo "<li class='".$class."'>";
    echo $menu['titulo'];
    echo "</li>";

    if($menu['enlace'])
    {
    echo "</a>";
    }
}#Fin de mostrar menu

echo "<nav>";
echo "<ul>";
# recorremos todo el array de valores
for($i = 0; $i < count($menu); $i++)
{
    mostrarEnlace($menu[$i],"menu");

    # Si dispone de subcategorias, las mostramos
    if(count($menu[$i]["subcategoria"])>0)
    {
        for ($j=0;$j<count($menu[$i]["subcategoria"]);$j++)
        {
        mostrarEnlace($menu[$i]["subcategoria"][$j], "submenu");
        }
    }
}
echo "<ul>";
echo "</nav>";*/
?>