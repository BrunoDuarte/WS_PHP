<?php

/**
 * AdminCategory.class [ MODEL ADMIN ]
 * Responsável por gerenciar as categorias do sistema no admin!
 * 
 * @copyright (c) 2014, Bruno Duarte
 */
class AdminCategory {

    private $Data;
    private $CatId;
    private $Error;
    private $Result;

    // Nome da tabela no banco de dados!
    const Entity = 'ws_categories';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;
        if (in_array('', $this->Data)):
            $this->Result = FALSE;
            $this->Error = ['<b>Erro ao cadastrar:</b> Para cadastrar uma categoria, preencha todos os campos!', WS_ALERT];
        else:
            $this->setData();
            $this->setName();
            $this->Create();
        endif;
    }

    public function ExeUpdate($CategoryId, array $Data) {
        $this->CatId = (int) $CategoryId;
        $this->Data = $Data;
        if (in_array('', $this->Data)):
            $this->Result = FALSE;
            $this->Error = ["<b>Erro ao atualizar:</b> Para atualizar a categoria <b>{$this->Data['category_title']}</b>, preencha todos os campos!", WS_ALERT];
        else:
            $this->setData();
            $this->setName();
            $this->Update();
        endif;
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    // PRIVATES
    private function setData() {
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        $this->Data['category_name'] = Check::Name($this->Data['category_title']);
        $this->Data['category_date'] = Check::Data($this->Data['category_date']);
        $this->Data['category_parent'] = ($this->Data['category_parent'] == 'null' ? NULL : $this->Data['category_parent']);
    }

    private function setName() {
        $Where = (!empty($this->CatId) ? "category_id != {$this->CatId} AND" : '');
        $readName = new Read();
        $readName->ExeRead(self::Entity, "where {$Where} category_title = :t", "t={$this->Data['category_title']}");
        if ($readName->getResult()):
            $this->Data['category_name'] = $this->Data['category_name'] . '-' . $readName->getRowCount();
        endif;
    }

    private function Create() {
        $Create = new Create();
        $Create->ExeCreate(self::Entity, $this->Data);
        if ($Create->getResult()):
            $this->Result = $Create->getResult();
            $this->Error = ["<b>Sucesso:</b> A categoria {$this->Data['category_title']} foi cadastrada no sistema", WS_ACCEPT];
        endif;
    }

    private function Update() {
        $update = new Update();
        $update->ExeUpdate(self::Entity, $this->Data, "where category_id = :catid", "catid={$this->CatId}");
        if ($update->getResult()):
            $this->Result = TRUE;
            $this->Error = ["<b>Sucesso:</b> A categoria {$this->Data['category_title']} foi atualizada no sistema", WS_ACCEPT];
        endif;
    }

}
