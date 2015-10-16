<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './class/ClassesObjetos.class.php';
        
        $teste = new ClassesObjetos();
        $teste->getClass('de introducao', 'de mostrar uma classe');
        $teste->verClass();
        ?>
    </body>
</html>
