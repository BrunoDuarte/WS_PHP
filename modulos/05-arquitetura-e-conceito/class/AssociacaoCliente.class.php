<?php

class AssociacaoCliente {
    
    private $Cliente;
    private $Nome;
    private $Email;
    
    function __construct($Nome, $Email) {
        $this->Cliente = md5($Nome);
        $this->Nome = $Nome;
        $this->Email = $Email;
    }
    
    function getNome() {
        return $this->Nome;
    }

    function getEmail() {
        return $this->Email;
    }
    
    function getCliente() {
        return $this->Cliente;
    }

}
