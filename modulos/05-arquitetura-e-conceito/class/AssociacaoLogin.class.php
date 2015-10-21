<?php

class AssociacaoLogin {

    /** 
     * @var AssociacaoCliente
     */
    private $Cliente;
//    public $Cliente;
    private $Login;

    function __construct($Cliente) {
        if (is_object($Cliente)):
            $this->Cliente = $Cliente;
            $this->Login = true;
        else:
            die("Erro ao logar");
        endif;
    }
    
    function getCliente() {
        return $this->Cliente;
    }
    
    function getLogin() {
        return $this->Login;
    }

}
