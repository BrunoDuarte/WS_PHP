<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <h3>Tratamento por existência:</h3>
        <hr>
        <?php
        $string = 'contato';

        if (is_string($string)):
            echo "String é uma string!";
        elseif (!is_string($string)):
            echo "String não é uma string!";
        endif;

        echo "<hr>";

        if (!empty($string)):
            echo "String existe e tem valor";
        elseif (isset($string)):
            echo "String existe mas está em branco";
        endif;
        ?>

        <hr><hr>
        <h3>Tomada de decisão:</h3>
        <hr>

        <?php
        $decisao = 'frank.bruno555@gmail.com';

        if (!filter_var($decisao, FILTER_VALIDATE_EMAIL)):
            echo "E-mail informado não é válido";
        elseif ($decisao == 'frank.bruno555@gmail.com'):
            die('Esse e-mail é restrito');
        else:
            echo "E-mail válido";
        endif;

        echo ':)';
        ?>

        <hr><hr>
        <h3>Retorno de Flags:</h3>
        <hr>
        
        <?php
        
        function Idade($Idade = null){
            if(!$Idade):
                return false;
            elseif(!is_int($Idade)):
                return false;
            endif;
            
            return "Você nasceu em: " . (date(Y) - $Idade);
        }
        
        $idade = 'abs';
        
        if(Idade($idade)):
            echo Idade($idade);
        else:
            echo "Erro, informe um INT idade";
        endif;
        
        ?>

    </body>
</html>
