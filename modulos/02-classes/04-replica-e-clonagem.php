<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './class/ReplicaClonagem.class.php';
        
        $readA = new ReplicaClonagem("posts", "categoria = 'noticias'", 'order by data desc');
        $readA->Ler();
        
        $readA->setTermos("categoria = 'internet'");
        $readA->Ler();
        
        $readB = $readA;
        $readB->setTermos("categoria = 'redes_sociais'");
        $readB->Ler();
        
        $readC = clone($readA);
        $readC->setTabela('comentarios');
        $readC->setTermos("posts = 25");
        $readC->Ler();
        
        var_dump($readA, $readB, $readC);
        ?>
    </body>
</html>
