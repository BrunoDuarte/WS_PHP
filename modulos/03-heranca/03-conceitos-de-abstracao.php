<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        
//        $conta = new Abstracao('Bruno Duarte', 500);
//        $contaDois = new Abstracao('Elisangela Duarte', 300);
//        
//        $conta->Depositar(1000);
//        $conta->Sacar(500);
//        $conta->Transferir(500, $conta);
//        $conta->Transferir(500, $contaDois);
//        
//        var_dump($conta, $contaDois);
        
        $cc = new AbstracaoCC('Bruno Duarte', 0, 1000);
        $cp = new AbstracaoCP('Elisangela Duarte', 0);
        
        $cc->Depositar(1000);
        $cc->Sacar(500);
        $cc->Transferir(500, $cp);
        
        $cc->VerSaldo();
        $cp->VerSaldo();
        
        var_dump($cc, $cp);
        ?>
    </body>
</html>
