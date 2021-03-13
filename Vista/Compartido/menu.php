<?php
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    $conn=Conectar::conexion();
    if($conn){
        $instruccion="select p.idPerfil, m.idMenu, m.nombre, m.direccion from perfil p  
        join intermediaPerfilMenu ipm on p.idPerfil=ipm.idPerfil
        join menu m on ipm.idMenu=m.idMenu where p.idPerfil=".$_SESSION["idPerfil"].";";

        $result=$conn->query($instruccion);

        $menu="<div class='row'>
        <div class='col-sm-2'>
           <div class='logo'>
              <a href='".$dominio."Vista/Inicio/inicio'>
              <img src='".$dominio."Img/logo.png'>
              </a>
           </div>
        </div>
        <div class='col-sm-6'>
           <div class='menu-area'>
              <nav class='navbar navbar-expand-lg '>
              <!-- <a class='navbar-brand' href='#'>Menu</a> -->
                 <button class='navbar-toggler collapsed' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                    <i class='fa fa-bars'></i>
                 </button>
                 <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav mr-auto'>

            
            <li class='nav-item active' href='#'><a class='nav-link' href='".$dominio."Vista/Inicio/inicio'>Inicio</a><li>";
            //Se llena el menu de las que la persona tiene acceso
        for($i=0;$i<$result->num_rows;$i++){
            $row=$result->fetch_assoc();
            $menu.="<li class='nav-item' href='#'><a class='nav-link' href='".$dominio.$row["direccion"]."'>".$row["nombre"]."</a></li>";
        }

        $menu.="</ul>
        </div>
     </nav>
  </div>
</div>
<div class='col-sm-4'>
  <ul class='top_button_section'>
     <li><a class='login-bt active' href='".$dominio."/Controlador/CerrarSesion'>Cerrar Sesión</a></li>     
  </ul>
</div>
</div>";
        echo $menu;
        

        unset($conn);
        unset($result);
        unset($instruccion);
        unset($menu);
    }
    
}
else{
    $menu="
    <div class='row'>
         <div class='col-sm-2'>
            <div class='logo'>
               <a href='".$dominio."Vista/Inicio/inicio'>
               <img src='".$dominio."Img/logo.png'>
               </a>
            </div>
         </div>
         <div class='col-sm-6'>
            <div class='menu-area'>
               <nav class='navbar navbar-expand-lg '>
               <!-- <a class='navbar-brand' href='#'>Menu</a> -->
                  <button class='navbar-toggler collapsed' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                     <i class='fa fa-bars'></i>
                  </button>
                  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                     <ul class='navbar-nav mr-auto'>
                        <li class='nav-item active'>
                        <a class='nav-link' href='".$dominio."Inicio/inicio'>Inicio<span class='sr-only'>(current)</span></a> </li>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
         <div class='col-sm-4'>
            <ul class='top_button_section'>
               <li><a class='login-bt active' href='".$dominio."Vista/Sesion/IniciarSesion'>Iniciar Sesión</a></li>
            </ul>
         </div>
      </div>";
    echo $menu;

}
?>