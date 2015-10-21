<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        
        $cliente = new ObjetoDinamico();
        
        /**
         * Classe genérica que não existe de verdade
         * não possui métodos nem atributos
         * serve apenas para que você instancie um objeto novo
         */
        $bruno = new stdClass();
        $bruno->Nome = 'Bruno';
        $bruno->Email = 'frank.bruno555@gmail.com';
        
        $cliente->Novo($bruno);
        
        $elisangela = clone($bruno);
        $elisangela->Nome = 'Elisangela';
        $elisangela->Email = 'test';
        
        var_dump($cliente, $bruno, $elisangela);
        ?>
    </body>
</html>
