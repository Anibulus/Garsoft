<?php
session_start();
if(isset($_SESSION["nombre"])){
    require("../../Modelo/Conexion/conexion.php");
    require("../../Modelo/NoCSRF.php");
    header('Content-Type: application/json;');
    $conn=Conectar::conexion();

    if(count($_POST)>0)
    {

        if (isset($_POST['nombre']) && isset($_POST['apepat']) && isset($_POST['apemat']) && isset($_POST['correo']) && isset($_POST['tele'])) {

            $nombre = $_POST["nombre"];
            $apepat = $_POST["apepat"];
            $apemat = $_POST["apemat"];
            $correo = $_POST["correo"];
            $tele = $_POST["tele"];


            /*$instruccion="insert into persona 
                    (idPersona, nombre, apellido1, apellido2, correo, telefono) 
                    values
                    (null,".$_POST["nombre"].",".$_POST["apepat"].",".$_POST["apemat"].",".$_POST["correo"].",".$_POST["tele"].";";*/
                    

                    $result=$conn->query("insert into persona  
                    values
                    (null,'".$nombre."','".$apepat."','".$apemat."','".$correo."',".$tele.");");

                    $last_id = $conn->insert_id;

                    




                     

                    if($result)
                    {
                        
                        $result=$conn->query("insert into Cliente(idPersona) values (".$last_id.");");
                        echo json_encode(1);
                    }

                    else

                    {//Si no hay result
                        echo json_encode(3);
                    }

                    $conn->close();
                    unset($conn);
                    unset($result);
                    unset($instruccion); 
            # code...
        }
        /*
        if(intval($_POST["marca"])>=0 && intval($_POST["categoria"])>=0)
        {//Si contienen valores válidos 
            try{//Validacion de sitios cruzados
                NoCSRF::check( 'csrf_token', $_POST, true, 60*10, true );   

                

                //Validar que el cliente no exista ya
                $instruccion="select * from Persona
                where nombre=".$_POST["nomCli"].", apellido1=".$_POST["apepCli"].", apellido2=".$_POST["apemCli"].";";
                $result=$conn->query($instruccion);
                if($result){
                    $conn->close();
                    unset($conn);
                    unset($result);
                    unset($instruccion);
                    echo json_encode(2); // El cliente ya existe
                }
                else
                {
                    //Se insertan los datos en la tabla Persona
                    
                   

                    $result=$conn->query($instruccion);
                    $last_id = $conn->insert_id;
                    
                    
                    if($instruccion){

                    //Se guarda el Id en la tabla cliente
                    $instruccion2="insert into Cliente(idPersona) values (".$last_id.");";

                    }

                    $conn->close();
                    unset($conn);        
                    if($result)
                    {
                        echo json_encode(1);
                    }
                    else
                    {//Si no hay result
                        echo json_encode(3);
                    }
                    unset($result);
                    unset($instruccion);
                }
            }catch(Exception $ex){
                echo $ex->getMessage();
            }
        }*/
        else
        {
            echo json_encode(0);
        }
    }//Fin de post
    else
    {
        echo json_encode(0);
    }

}
else
{

}
?>