<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Conceitos de Polimorfismo</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        
        $boleto = new Polimorfismo('WS PHP', '334.90');
        $boleto->Pagar();
        
        var_dump($boleto);
        echo "<hr>";
        
        $deposito = new PolimorfismoDeposito('WS PHP', '334.90');
        var_dump($deposito);
        $deposito->Pagar();
        echo '<hr>';
        
        $cartao = new PolimorfismoCartao('WS PHP', '334.90');
        $cartao->Pagar();
        $cartao->Pagar(10);
        
        var_dump($cartao);
        ?>
    </body>
</html>
