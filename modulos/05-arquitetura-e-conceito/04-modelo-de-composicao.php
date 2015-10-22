<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './inc/Config.inc.php';
        
        $bruno = new ComposicaoUsuario('Bruno Duarte', 'frank.bruno555@gmail.com');
        $bruno->CadastrarEndereco('Fortaleza', 'CE');

        echo "O email de {$bruno->Nome} é {$bruno->Email}<br>";
        echo "{$bruno->Nome} mora em {$bruno->getEndereco()->getCidade()}/{$bruno->getEndereco()->getEstado()}";
        
        var_dump($bruno);
        ?>
    </body>
</html>
