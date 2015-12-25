<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        
        $Atual = filter_input(INPUT_GET, 'atual', FILTER_VALIDATE_INT);
        $Pager = new Pager('04-gestao-de-resultados.php?atual=', 'Primeira', 'Última');
        $Pager->ExePager($Atual, 1);
        
        $read = new Read();
        $read->ExeRead('ws_categories', 'limit :limit offset :offset', "limit={$Pager->getLimite()}&offset={$Pager->getOffset()}");
        
        $Pager->ExePaginator('ws_categories');
        echo $Pager->getPaginator();
        
        var_dump($Pager);
        ?>
    </body>
</html>
