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

    public function ExeDelete($CategoryId) {
        $this->CatId = (int) $CategoryId;

        $read = new Read();
        $read->ExeRead(self::Entity, "where category_id = :delid", "delid={$this->CatId}");

        if (!$read->getResult()):
            $this->Result = FALSE;
            $this->Error = ['Ops, você tentou remover uma categoria que não existe no sistema!', WS_INFOR];
        else:
            extract($read->getResult()[0]);
            if (!$category_parent && !$this->checkCats()):
                $this->Result = FALSE;
                $this->Error = ["a sessão<b> {$category_title}</b> possui categorias cadastradas. Para deletar, antes altere ou remova as categorias filhas!", WS_ALERT];
            elseif ($category_parent && !$this->checkPosts()):
                $this->Result = FALSE;
                $this->Error = ["a categoria<b> {$category_title}</b> possui artigos cadastrados. Para deletar, antes altere ou remova todos os posts desta categoria!", WS_ALERT];
            else:
                $delete = new Delete();
                $delete->ExeDelete(self::Entity, "where category_id = :deletaid", "deletaid={$this->CatId}");
                $tipo = ( empty($category_parent) ? 'sessão' : 'categoria' );
                $this->Result = TRUE;
                $this->Error = ["a {$tipo}<b> {$category_title}</b> foi removida com sucesso do sistema!", WS_ACCEPT];
            endif;
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

    // Verifica categorias da sessão
    private function checkCats() {
        $readSes = new Read();
        $readSes->ExeRead(self::Entity, "where category_parent = :parent", "parent={$this->CatId}");
        if ($readSes->getResult()):
            return FALSE;
        else:
            return TRUE;
        endif;
    }

    // Verifica artigos da categoria
    private function checkPosts() {
        $readPosts = new Read();
        $readPosts->ExeRead("ws_posts", "where post_category = :category", "category={$this->CatId}");
        if ($readPosts->getResult()):
            return FALSE;
        else:
            return TRUE;
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
