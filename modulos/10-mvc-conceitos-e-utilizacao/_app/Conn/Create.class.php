<?php

/**
 * Create.class [ TIPO ]
 * Descricao
 * @copyright (c) year, Bruno Duarte
 */
class Create extends Conn {
    
    private $Tabela; 
    private $Dados;
    private $Resut; 
    
    /** @var PDOStatement */
    private $Create;
    
    /** @var PDO */
    private $Conn; 
    
    /**
     * <b>ExeCreate:</b> Executa um cadastro simplificado no banco de dados utilizando prepared statements. 
     * Basta informar o nome da tabela e um array atribuitivo com o nome da coluna e o valor! 
     * 
     * @param STRING $Tabela = Infomre o nome da tabela no banco!
     * @param ARRAY $Dados = Informe um array atributivo. (nome da coluna => valor).
     */
    public function ExeCreate($Tabela, array $Dados){
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;
        
        $this->getSyntax();
        $this->Execute();
    }
    
    public function getResult() {
        return $this->Result;
    }
    
    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    
    private function Connect(){
        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($this->Create);
    }
    
    private function getSyntax() {
        $Fields = implode(', ', array_keys($this->Dados));
        $Places = ':'.implode(', :', array_keys($this->Dados));
        $this->Create = "insert into {$this->Tabela} ({$Fields}) values ({$Places})";
    }
    
    private function Execute() {
        $this->Connect();
        
        try{
            $this->Create->execute($this->Dados);
            $this->Result = $this->Conn->lastInsertId();
        } catch (PDOException $e) {
            $this->Result = null;
            WSErro("<b>Erro ao cadastrar:</b> {$e->getMessage()}", $e->getCode());
        }
    }
}
