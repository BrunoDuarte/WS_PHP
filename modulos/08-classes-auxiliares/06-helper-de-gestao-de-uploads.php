<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Helper de gestão de conteúdo</title>
        <link rel="stylesheet" href="css/reset.css" />
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';

        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($form && $form['SendImage']):

            $upload = new Upload('uploads/');
            $imagem = $_FILES['image'];
//            var_dump($imagem);
            $upload->Image($imagem);
            if (!$upload->getResult()):
                WSErro("Erro ao enviar imágem!<br><small>{$upload->getError()}</small>", WS_ERROR);
            else:
                WSErro("Imágem enviada com sucesso!<br><small>{$upload->getResult()}</small>", WS_ACCEPT);
            endif;

            echo '<hr>';
            var_dump($upload);
        endif;
        ?>

        <form name="fileform" action="" method="post" enctype="multipart/form-data">
            <label>
                <input type="file" name="image"/>
            </label>
            <input type="submit" name="SendImage" value="Enviar arquivo!"/>
        </form>
    </body>
</html>
