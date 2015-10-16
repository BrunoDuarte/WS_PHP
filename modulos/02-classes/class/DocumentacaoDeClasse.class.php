<?php

/**
 * <b>DocumentacaoDeClasse:</b>
 * Essa classe foi criada para mostrar a interação de objetos. Logo depois replicamos ela para ver
 * sobre a documentação de classes com o PHPDoc. 
 * 
 * @copyright (c) 2015, Bruno Duarte VoicerCore
 */


class DocumentacaoDeClasse {

    /** @var string Nome da empresa */
    public $Empresa;
    
    /** 
     * Esse atributo é auto gerido pela classe e incrementa o número de funcionário!
     * @var type int Número de funcionários
     */
    public $Setores;

    /** @var InteracaoClasse Objeto vindo da classe InteracaoClasse*/
    public $Funcionario;

    function __construct($Empresa) {
        $this->Empresa = $Empresa;
        $this->Setores = 0;
    }

    /**
     * <b>Contratar Funcionário:</b> Informe um objeto da classe InteracaoClasse, o cargo e o salário
     * do funcionário a ser contratado!
     * @param object $Funcionario = Objeto da classe InteracaoClasse
     * @param string $Cargo = Profissão ou cargo a ocupar
     * @param float $Salario = Salário do funcinário
     */
    public function Contratar($Funcionario, $Cargo, $Salario) {
        $this->Funcionario = (object) $Funcionario;
        $this->Funcionario->Trabalhar($this->Empresa, $Salario, $Cargo);
        $this->Setores += 1;
    }

    /**
     * <b>Pagar e obter salário:</b> Ao executar esse método, o salário do funcionário será pago. Você ainda 
     * poderá dar um eco neste mesmo para visualizar o salário!
     * @return float Retorna o salário do contratado. 
     */
    public function Pagar() {
        $this->Funcionario->Receber($this->Funcionario->Salario);
        return $this->Funcionario->Salario;
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
