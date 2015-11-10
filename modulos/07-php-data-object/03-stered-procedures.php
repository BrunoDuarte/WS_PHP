<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        
        $Conn = new Conn();
        
        try {
            
            $Query = "Select * from ws_siteviews_agent where agent_name = :name";
            $Exec = $Conn->getConn()->prepare($Query);
            
            $Exec->bindValue(":name", 'Chrome');
            $Exec->execute();
            
            $Chrome = $Exec->fetchAll(PDO::FETCH_ASSOC); // ou apenas fetch se retornar apenas um resultado
            
            $Exec->bindValue(":name", 'Safari');
            $Exec->execute();
            
            $Safari = $Exec->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }
        
        if($Chrome):
//            var_dump($Chrome);
            echo "{$Chrome[0]['agent_name']} tem {$Chrome[0]['agent_views']} visita(s)<hr>";
        endif;
        
        if($Safari):
//            var_dump($Safari);
            echo "{$Safari['agent_name']} tem {$Safari['agent_views']} visita(s)<hr>";
        endif;
        
        ?>
    </body>
</html>
