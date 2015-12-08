<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        
        $Dados = ['agent_name' => 'FireFox', 'agent_views' => '120'];
        
        $update = new Update();
        $update->ExeUpdate('ws_siteviews_agent', $Dados, "where agent_id = :id", 'id=5');
        
        if($update->getResult()):
            echo "{$update->getRowCount()} dado(s) atualizados com sucesso!<hr>";
        endif;
        
        $update->setPlaces('id=6');
        $update->setPlaces('id=7');
        $update->setPlaces('id=8');
        
//        var_dump($update);
        ?>
    </body>
</html>
