<?php

class AgregacaoCarrinho {

    private $Cliente;
    private $Produtos;
    private $Total;

    function __construct(AssociacaoCliente $Cliente) {
        $this->Cliente = $Cliente;
        $this->Produtos = array();
    }

    public function Add(AgregacaoProduto $Produto) {
        $this->Produtos[$Produto->getProduto()] = $Produto;
        $this->Total += $Produto->getValor();
        $this->VerCarrinho($Produto, 'Adicionou');
    }

    public function Remove(AgregacaoProduto $Produto) {
        unset($this->Produtos[$Produto->getProduto()]);
        $this->Total -= $Produto->getValor();
        $this->VerCarrinho($Produto, 'Removeu');
    }

    public function VerCarrinho(AgregacaoProduto $Produto, $Action) {
        echo "Você {$Action} um {$Produto->getNome()} em seu carrinho. Valor {$this->Total}<hr>";
    }

}
