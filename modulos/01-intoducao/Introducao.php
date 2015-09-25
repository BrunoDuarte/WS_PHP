<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (phpversion() >= 5.4):
            echo phpversion() . " Olá mundo, prodemos programar";
        else:
            echo phpversion() . " Olá mundo, preciso atualizar o PHP";
            echo phpinfo();
        endif;
        ?>
    </body>
</html>
