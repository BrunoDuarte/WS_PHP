<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require './_app/Config.inc.php';
        $sessao = new Session();
        
//        View::Load('_mvc/category');
//        
//        $read = new Read();
//        $read->ExeRead('ws_categories');
//        
//        foreach ($read->getResult() as $cat):
//            View::Show($cat);
//        endforeach;
//        
//        echo '<h1>Request</h1>';
//        
//        foreach ($read->getResult() as $cat):
//            View::Request('_mvc/category', $cat);
//        endforeach;
  
        $read = new Read();
        $read->ExeRead('ws_siteviews_agent');
        View::Load('_mvc/navegador');
        
        foreach ($read->getResult() as $nav):
            View::Show($nav);
        endforeach;
        
        ?>
    </body>
</html>
