<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';

        $read = new Read();
        $read->ExeRead('ws_categories');
        $tpl = file_get_contents('_mvc/category.tpl.html');
        
        foreach ($read->getResult() as $cat):
            extract($cat);
            //echo str_replace(array('#category_title#','#category_content#'), array($category_title, $category_content), $tpl);
            //var_dump($cat);
        
            $cat['pubdate'] = date('Y-m-d', strtotime($cat['category_date']));
            $cat['category_date'] = date('Y-m-d', strtotime($cat['category_date'])) . 'hs';
        
            $links = explode('&','#' . implode("#&#", array_keys($cat)) . '#');
            echo str_replace($links, array_values($cat), $tpl);
        
        endforeach;
        ?>
    </body>
</html>
