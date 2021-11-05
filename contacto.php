<?php
/*
 *  Configuración
 */

// Dirección de correo que aparerá en el De
$from = 'Servidor AWS <XXX@francisperea.org>';

// Dirección de correo a la que enviar los mensajes
$sendTo = 'Francis Perea <XXX@iesjuandelacierva.edu.es>';

// Asunto de los correos
$subject = 'Mensaje del Formulario de Contacto';

// Nombres de los campos y su descripción para colocar en el cuerpo del correo
// nombre de la variable => Texto del correo
$fields = array('nombre' => 'Nombre', 'apellido' => 'Apellido', 'tipo' => 'Tipo', 'email' => 'Email', 'mensaje' => 'Mensaje'); 

// Mensaje si todo Ok
$okMessage = "<h1>Mensaje enviado correctamente. Gracias. Nos pondremos en contacto lo antes posible</h1>";

// Mensaje si algo falla
$errorMessage = "<h1>Lo sentimos pero tu mensaje no  se ha podido enviar. Vuelve a intentarlo pasados unos minutos.</h1>";

/*
 *  Envío
 */

try
{

    if(count($_POST) == 0) throw new \Exception('Formulario vacío');
            
    $emailText = "Tienes un nuevo mensaje a través del formulario de correo\n=============================\n";

    foreach ($_POST as $key => $value) {
        // Si ha llegado un campo desde el formulario, incluirlo en el correo
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    // Cabeceras del correo
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    // Enviar el correo y presenta mensaje de resultado
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}
    echo $responseArray['message'];

