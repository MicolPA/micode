<?php 

require 'zmail/PHPMailerAutoload.php';

$file = "$file.pdf";
if (isset($model->factura->cliente->representante_nombre)){
    if ($model->factura->cliente->representante_nombre) {
        $nombre_cliente = $model->factura->cliente->representante_nombre .  " (" .$model->factura->cliente->empresa . ")";
    }else{
        $nombre_cliente = $model->factura->cliente->empresa;
    }
    $model->email = $model->factura->cliente->representante_correo;
}else{
    $nombre_cliente = $model->factura->cliente_nombre;
}


$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = "smtp.hostinger.com";


$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = Yii::$app->params['email'];
$mail->Password = Yii::$app->params['password'];


$mail->setFrom('contacto@micoderd.net', $config['empresa']);
$mail->addAddress("$model->email");
$mail->Subject = "$model->asunto - " . $config['empresa'];
$mail->AddAttachment($file, 'Factura');

$mail->msgHTML("$content");
if (!$mail->send()) {
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = Yii::$app->params['email'];
    $mail->Password = Yii::$app->params['password'];

    $mail->setFrom(Yii::$app->params['email'], 'MiCobro');
    $mail->addAddress("$model->email", "$nombre_cliente");
    $mail->Subject = "$model->asunto - ". $config['empresa'];;
    $mail->AddAttachment($file, 'Factura');

    $mail->msgHTML("$content");
    $mail->send();
    
}


 ?>