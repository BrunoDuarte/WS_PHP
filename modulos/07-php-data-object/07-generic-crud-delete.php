<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        
        $delete = new Delete();
        $delete->ExeDelete('ws_siteviews_agent', "where agent_id = :id", 'id=3');
        
        if($delete->getResult()):
            echo "{$delete->getRowCount()} registro(s) removido(s) com sucesso!<hr>";
        endif;
        
//        var_dump($delete);
        ?>
    </body>
</html>
