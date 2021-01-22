<nav>
    <ul>
        <li>Incio</i>
        <li>Catálogo</i>
        <li>Contacto</i>
    </ul>
</nav>

<?php
# definimos el array de valores para el menu y submenus
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
        ),#Fin de array subcategoria
    ),#Fin de array contenido
);#Fin de array

/**
* Funcion para mostrar los enlaces
* Tiene que recibir el array de valores y la clase a asignar que puede ser:
* menu o submenu
*/
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
echo "</nav>";
?>