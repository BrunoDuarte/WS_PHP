<?php

class ClassesObjetos {
    
    var $Classe; 
    var $Funcao;
    
    function getClass($Classe, $Funcao){
        echo "<p> A Classe {$Classe} serve para {$Funcao}";
    }
    function verClass(){
        echo '<pre>';
        print_r($this);
        echo '</pre>';
    }
    
}
