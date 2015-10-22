<?php

class AgregacaoProduto {

    private $Produto;
    private $Nome;
    private $Valor;

    function __construct($Produto, $Nome, $Valor) {
        $this->Produto = $Produto;
        $this->Nome = $Nome;
        $this->Valor = $Valor;
    }

    function getProduto() {
        return $this->Produto;
    }

    function getNome() {
        return $this->Nome;
    }

    function getValor() {
        return $this->Valor;
    }

}
