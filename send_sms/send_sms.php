<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="send_sms.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="sortcut icon" href="../img/icon.png" type="image/x-icon"/>

    <title>SMS ANON</title>
</head>
<body>
    <div class="container">
        <form action="process_sms.php" method="post" id="form_sms">
            <h2>NÚMERO DE TELEFONE</h2>
            <label for="phone_number">Número que vai receber o SMS</label>
            <input type="text" name="phone_number" class="form_input" placeholder="Ex: +XX XX XXXXX-XXXX">
            <p class="hints">* Ex: +55 16 99999-9999</p>


            <h2 id="subtitle">MENSAGEM</h2>
            <label for="msg">Mensagem que você quer enviar</label>
            <input type="text" name="msg" class="form_input">
            <p class="hints">* Evite mensagens longas</p>
            <p class="hints">* Evite acentos</p>

            <input type="submit" value="ENVIAR SMS" id="btn_submit_sms">
        </form>
    </div>
</body>
</html>