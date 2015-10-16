<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Conceito de herança</title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';

        $pessoa = new Heranca('Bruno Duarte', 32);
        $pessoa->Formar('Pro PHP');
        $pessoa->Formar('WS PHP');
        $pessoa->Envelhecer();
        $pessoa->VerPessoa();

        var_dump($pessoa);
        echo '<hr>';

        $pessoaME = new HerancaJuridica('Bruno Duarte', 32, 'VoicerCore');
        $pessoaME->Formar('Pro PHP');
        $pessoaME->Formar('WS PHP');
        $pessoaME->Envelhecer();
        $pessoaME->VerPessoa();

        $pessoaME->Contratar('Desenvolvedor Senior');
        $pessoaME->VerEmpresa();
        
        var_dump($pessoaME);
        ?>
    </body>
</html>
