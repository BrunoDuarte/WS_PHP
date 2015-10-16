<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './class/AtributosMetodos.class.php';
        $pessoa = new AtributosMetodos();
        $pessoa->setUsuario('Bruno', 32, 'Suporte');
        $usuario = $pessoa->getUsuario();

        $pessoa->setUsuario('Bruno', 32, 'engenheiro de suporte');
        echo '<hr>';
        $pessoa->getClasse();   
        
        ?>
    </body>
</html>
