<?php
// Configurações do site ####################
// Auto Load de Classes #####################

function __autoload($Class) {
    $dirname = 'class';
    
    if(file_exists("{$dirname}/{$Class}.class.php")):
        require_once "{$dirname}/{$Class}.class.php";
    else:
        die("Erro ao incluir {$dirname}/{$Class}.class.php<hr>");
    endif;
}
// Tratamento de Erros ######################
//CSS constantes :: Mensagens de Erro
define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');

//WSError :: Exibe erros lançados :: Front
function WSErro($ErrMsg, $ErrNo, $ErrDie = null){
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";
    
    if($ErrDie):
        die;
    endif;
}

//PHPError :: Personaliza o gatilho PHP 
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine){
     $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
     echo "<p class=\"trigger {$CssClass}\">";
     echo "<b> Erro na linha: {$ErrLine} :: </b> {$ErrMsg}<br>";
     echo "<small>{$ErrFile}</small>";
     echo "<span class=\"ajax_close\"></span></p>";
     
     if($ErrNo == E_USER_ERROR):
         die;
     endif;
}

set_error_handler('PHPErro');