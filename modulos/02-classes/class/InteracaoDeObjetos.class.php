<?php

/**
 * InteracaoDeObjetos.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Bruno Duarte
 */
class InteracaoDeObjetos {

    public $Empresa;
    public $Setores;

    /** @var InteracaoClasse */
    public $Funcionario;

    function __construct($Empresa) {
        $this->Empresa = $Empresa;
        $this->Setores = 0;
    }

    public function Contratar($Funcionario, $Cargo, $Salario) {
        $this->Funcionario = (object) $Funcionario;
        $this->Funcionario->Trabalhar($this->Empresa, $Salario, $Cargo);
        $this->Setores += 1;
    }

    public function Pagar() {
        $this->Funcionario->Receber($this->Funcionario->Salario);
    }

    public function Promover($Cargo, $Salario = null) {
        $this->Funcionario->Profissao = $Cargo;
        if ($Salario):
            $this->Funcionario->Salario = $Salario;
        endif;
    }
    
    public function Funcionarios($Funcionario){
        $this->Funcionario = (object) $Funcionario;
    }

    public function Demitir($Recisao) {
        $this->Funcionario->Receber($Recisao);
        $this->Funcionario->Empresa = null;
        $this->Funcionario->Salario = null;
        $this->Setores -= 1;
    }

}
