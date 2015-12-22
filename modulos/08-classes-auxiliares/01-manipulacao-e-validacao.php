<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Helpers :: Manipulação e Validação</title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        //$check = new Check();
        //var_dump($check);
        
        $Email = 'bruno.gmail.com';
        if(Check::Email($Email)):
            echo 'Válido!<hr>';
        else:
            echo 'Inválido!<hr>';
        endif;
        
        $Name = 'Estamos aprendendo PHP. Veja você como é!';
        echo Check::Name($Name). '<hr>';
        
        $Data = '21/12/2015 20:36:10';
        echo Check::Data($Data) . '<hr>';
        
        ?>
    </body>
</html>
