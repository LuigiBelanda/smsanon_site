<?php

    session_start();

    $phone_number = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_NUMBER_INT);
    $msg = filter_input(INPUT_POST, 'msg', FILTER_SANITIZE_STRING);

    $ch = curl_init('https://textbelt.com/text');
    $data = array(
        'phone' => $phone_number,
        'message' => $msg,
        'key' => 'textbelt',
    );

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $result = substr($response, 11, 5);

    curl_close($ch);

    if ($result === "false") {
        echo"<script language='javascript' type='text/javascript'> alert('Não foi possível enviar o SMS');window.location.href='send_sms.php';</script>";
        return;
    }
    else {
        echo"<script language='javascript' type='text/javascript'> alert('SMS enviado');window.location.href='send_sms.php';</script>";
        return;
    }
?>