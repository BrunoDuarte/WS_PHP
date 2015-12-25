<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        
        $read = new Read();
        $read->ExeRead('ws_siteviews_agent', 'where agent_name = :name and agent_views >= :views limit :limit', "name=firefox&views=10&limit=3");
        
        var_dump($read);
        ?>
    </body>
</html>
