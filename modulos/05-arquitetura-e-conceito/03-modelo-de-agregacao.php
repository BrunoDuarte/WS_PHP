<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        
        $bruno = new AssociacaoCliente('Bruno', 'frank.bruno555@gmail.com');
        
        $prophp = new AgregacaoProduto('20', 'Pro PHP', 334.90);
        $wsphp = new AgregacaoProduto('21', 'WS PHP', 289.90);
        $wshtml = new AgregacaoProduto('22', 'WS HTML', 289.90);
        
        $outroproduto = new stdClass();
        $outroproduto->Produto = '23';
        $outroproduto->Nome = 'Curso de JQuery';
        $outroproduto->Valor = 400;
        
        $carrinho = new AgregacaoCarrinho($bruno);
        
        $carrinho->Add($prophp);
        $carrinho->Add($wsphp);
        $carrinho->Add($wshtml);
        
        $carrinho->Remove($wshtml);
        
        $carrinho->Add($outroproduto);
        
        var_dump($carrinho);
        echo '<hr>';
        
        var_dump($bruno, $prophp, $outroproduto);
        ?>
    </body>
</html>
