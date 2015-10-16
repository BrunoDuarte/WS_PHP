<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './class/ComportamentoInicial.class.php';
        
        $robson = new ComportamentoInicial('Bruno', 32, 'Eng. de Suporte', 6500);
        $robson->ver();
        ?>
    </body>
</html>
