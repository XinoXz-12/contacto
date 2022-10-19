<?php

$para = 'Francis Perea <XXX@iesjuandelacierva.edu.es>';
$asunto = 'Mensaje del Formulario de Contacto';
$texto = "Nuevo mensaje de " . $_POST["nombre"];

mail($para, $asunto, $texto);
echo "<h1>Gracias</h1>";

?>


