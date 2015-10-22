<?php

class ComposicaoEndereco {
    
    private $Cidade;
    private $Estado;
    
    function __construct($Cidade, $Estado) {
        $this->Cidade = $Cidade;
        $this->Estado = $Estado;
    }
    
    function getCidade() {
        return $this->Cidade;
    }

    function getEstado() {
        return $this->Estado;
    }

}
