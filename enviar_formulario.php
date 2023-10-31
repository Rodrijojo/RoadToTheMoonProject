<?php
$enviaPara = 'iphone.pablo2002@gmail.com'; // Cambia 'correo_destino@example.com' por la dirección de correo a la que deseas enviar los formularios.
$subject = 'Contacto desde la web';
$enviado = "enviado.html"; // Asegúrate de que este sea el archivo correcto donde deseas redirigir después de enviar el formulario.

$mensaje = '';
$primero = true;

$campos = array(
    'nombre' => 'Nombre',
    'apellido' => 'Apellido',
    'email' => 'Email',
    'telefono' => 'Teléfono',
    'mensaje' => 'Mensaje'
);

foreach ($_POST as $campo => $valor) {
    if (isset($campos[$campo])) {
        if ($primero) {
            $from = $valor;
            $primero = false;
        }
        $mensaje .= '<strong>' . $campos[$campo] . ':</strong>';
        $mensaje .= $valor . '<br>';
        if (filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $from = $valor;
        }
    }
}

$mail_headers = "MIME-Version: 1.0\r\n";
$mail_headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$mail_headers .= 'From: ' . $from . "\r\n";

if (isset($_POST['submit'])) {
    @mail($enviaPara, $subject, $mensaje, $mail_headers);
    header("Location: $enviado");
}
?>