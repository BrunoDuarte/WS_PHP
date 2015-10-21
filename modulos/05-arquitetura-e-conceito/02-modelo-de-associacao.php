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
        $login = new AssociacaoLogin($bruno);
        
        if($login->getLogin()):
//            echo "Gerenciando o cliente id: {$login->Cliente->getCliente()}<br>";
            echo "Gerenciando o cliente id: {$login->getCliente()->getCliente()}<br>";
            echo "{$login->getCliente()->getNome()} logou com sucesso usando o e-mail {$login->getCliente()->getEmail()}<hr>";
        else:
            echo 'Erro ao logar';
        endif;
        
        var_dump($bruno, $login);
        ?>
    </body>
</html>
