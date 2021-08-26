<?php

    session_start();

    $phone_number = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_NUMBER_INT);
    $msg = filter_input(INPUT_POST, 'msg', FILTER_SANITIZE_STRING);

    // VERIFY CONTENT INPUT
    if ($phone_number === "" || $msg === "") {
        echo"<script language='javascript' type='text/javascript'> alert('Você esqueceu de preencher um dos campos do formulário, por favor, preste mais atenção!');window.location.href='send_sms.php';</script>";
        return;
    }
    else {
        // API CALL
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
        /*
        echo $response;
        echo "<br>";
        */
    
        // GETTING PARTS OF THE API RESPONSE TO SEND A USER RESPONSE
        $result = substr($response, 11, 5);
        $result_quotaRemaining = substr($response, 26, 45);
        $result_number = substr($response, 26, 93);
        /*
        echo $result;
        echo "<br>";
        */
    
        /*
        echo"<script language='javascript' type='text/javascript'> console.log('$response');</script>";
        echo"<script language='javascript' type='text/javascript'> console.log('$result_quotaRemaining');</script>";
        echo"<script language='javascript' type='text/javascript'> console.log('$result_number');</script>";
        */
    
        curl_close($ch);

        // USER RESPONSE ABOUT YOUR REQUEST
        if ($result === "false") {
            if ($result_number === "Your phone number was not provided in E.164 format, or free SMS are disabled for this country") {
                echo"<script language='javascript' type='text/javascript'> alert('Número de telefone inválido ou o serviço não está funcionando no seu país!');window.location.href='send_sms.php';</script>";
                return;
            } 
            if ($result_quotaRemaining === "Only one test text message is allowed per day") {
                echo"<script language='javascript' type='text/javascript'> alert('Você pode enviar apenas 1 SMS por dia, provavelmente você já mandou um SMS hoje, por isso seu SMS não foi enviado!');window.location.href='send_sms.php';</script>";
                return;
            }
        }
        else {
            echo"<script language='javascript' type='text/javascript'> alert('SMS enviado!');window.location.href='send_sms.php';</script>";
            return;
        }   
    }
?>