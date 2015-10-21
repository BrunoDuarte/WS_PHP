<?php

function __autoload($Class) {
    $dirname = 'class';
    
    if(file_exists("{$dirname}/{$Class}.class.php")):
        require_once "{$dirname}/{$Class}.class.php";
    else:
        die("Erro ao incluir {$dirname}/{$Class}.class.php<hr>");
    endif;
}