<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        
        $documentar = new DocumentacaoDeClasse();
        $documentar->Contratar($Funcionario, $Cargo, $Salario);
        ?>
    </body>
</html>
