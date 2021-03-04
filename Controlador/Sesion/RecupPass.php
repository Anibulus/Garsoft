<?php
require("../../Modelo/Conexion/conexion.php");
//header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../Contenido/PHPMailer/Exception.php';
require '../../Contenido/PHPMailer/PHPMailer.php';
require '../../Contenido/PHPMailer/SMTP.php';

$correo=$_POST["correo"];

$conn=Conectar::conexion();
$result=$conn->query("select u.contrasena 
from usuario u
join persona p on p.idPersona = u.idPersona
where correo ='".$correo."';");
$conn->close();

unset($conn);

if($result ->num_rows > 0){
    $row=$result->fetch_assoc(); //Fetch row es oatra manera
    $pass = $row['contrasena'];
    
    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
		$headMail="Content-Type: text/html; charset=UTF-8";
   		//Server settings
   		$mail->SMTPDebug = 0;                      //Enable verbose debug output
   		$mail->isSMTP();                                            //Send using SMTP
   		$mail->Host       = 'mail.acumuladoresgarza.com';                     //Set the SMTP server to send through
   		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
   		$mail->Username   = 'no-reply@acumuladoresgarza.com';                     //SMTP username
   		$mail->Password   = 'jairotieneunahermanayomy';                               //SMTP password
   		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
   		$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    	//Recipients
    	$mail->setFrom('no-reply@acumuladoresgarza.com', 'Acumuladores Garza');
    	$mail->addAddress($correo);     //Add a recipient
    	/*
    	$mail->addAddress('ellen@example.com');               //Name is optional
    	$mail->addReplyTo('info@example.com', 'Information');
    	$mail->addCC('cc@example.com');
    	$mail->addBCC('bcc@example.com');
	
    	//Attachments
    	$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    	$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
	    */
    	//Content
    	$mail->isHTML(true);                                  //Set email format to HTML
    	$mail->Subject = 'Recuperar Contrase&ntilde;a';
    	$mail->Body    = 'Ha solicitado la consulta de su clave de acceso <br/>
    	                  la cual es la siguiente: '.$pass.' Elimine este correo para mayor seguridad';
    	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
    	$mail->send();
    	
    	echo json_encode(1);
    	
    } catch (Exception $e) {
    	
    	echo json_encode(2);
    }
}
else {
     echo json_encode(0);
}

?>