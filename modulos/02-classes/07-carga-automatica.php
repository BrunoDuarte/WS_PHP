<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Carga Automática</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        
        $classeA = new ClassesObjetos();
        $classeB = new AtributosMetodos();
        $classeC = new ComportamentoInicial('Bruno Duarte', 32, 'Engenheiro de Software', 6000);
        
        var_dump($classeA, $classeB, $classeC);
        ?>
    </body>
</html>
