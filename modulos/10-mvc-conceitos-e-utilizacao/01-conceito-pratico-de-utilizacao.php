<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        //CONTROLLER
        require './_app/Config.inc.php';

        //MODEL
        $read = new Read();
        $read->ExeRead('ws_categories');

        foreach ($read->getResult() as $cat):
            extract($cat);

            //VIEW
            echo "<article>"
            . "<header><h1>{$category_title}</h1></header>"
            . "<p>{$category_content}</p>"
            . "</article><hr>";
            // END VIEW
        endforeach;
        //END MODEL
        
        //END CONTROLLER
        ?>
    </body>
</html>
