<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/reset.css"/>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        
        trigger_error("Essa é uma NOTICE", E_USER_NOTICE);
        trigger_error("Essa é um ALERTA", E_USER_WARNING);
//        trigger_error("Essa é um ERRO", E_USER_ERROR);
        
        WSErro("Esse é um ACCEPT", WS_ACCEPT);
        ?>
    </body>
</html>
