<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './class/ModelagemDeClasse.class.php';
        
        $robson = new ModelagemDeClasse('Bruno', 32, 'Desenvolvedor', 1200);
        $robson->setProfissao('Engenheiro de Software');
        
        $robson->Trabalhar('portal', 12000);
        
        var_dump($robson);
        ?>
    </body>
</html>
