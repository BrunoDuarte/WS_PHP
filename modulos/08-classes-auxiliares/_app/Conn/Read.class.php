<?php

/**
 * Read.class [ TIPO ]
 * Descricao
 * @copyright (c) 2015, Bruno Duarte
 */
class Read extends Conn {

    private $Select;
    private $Places;
    private $Resut;

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function ExeRead($Tabela, $Termos = null, $ParseString = null) {
        if (!empty($ParseString)):
            $this->Places = $ParseString;
            parse_str($ParseString, $this->Places);
        endif;
        
        $this->Select = "SELECT * FROM {$Tabela} {$Termos}";
//        $this->Execute();
    }

    public function getResult() {
        return $this->Result;
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($this->Select);
        // Retornar resultados em arrays
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
    }

    private function getSyntax() {
        if($this->Places):
            foreach ($this->Places as $Vinculo => $Valor):
            
            endforeach;
        endif;
    }

    private function Execute() {
        
    }

}
  