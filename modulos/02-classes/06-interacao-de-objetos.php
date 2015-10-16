<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>WS PHP - Interação de objetos</title>
    </head>
    <body>
        <?php
        require './class/InteracaoClasse.class.php';
        require './class/InteracaoDeObjetos.class.php';
        
        $bruno = new InteracaoClasse('Bruno Duarte', 32, 'Engenheiro', 2000);
        
        $voicercore = new InteracaoDeObjetos('VoicerCore');
        $voicercore->Contratar($bruno, 'WebMaster', 3600);
        $voicercore->Pagar();
        $voicercore->Promover('Gerente de Projetos', 12000);
        $voicercore->Pagar();
        $voicercore->Demitir(6000);
        
        var_dump($bruno, $voicercore);
        ?>
    </body>
</html>
