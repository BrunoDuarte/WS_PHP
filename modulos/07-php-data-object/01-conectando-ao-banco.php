<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        
        $conn = new Conn();
        $conn->getConn();
        
        var_dump($conn->getConn());
        ?>
    </body>
</html>
