<?php

/**
 * AdminPost [ MODEL ADMIN ]
 * Responsável por genrênciar os posts do Admin no sistema!
 * @copyright (c) 2016, Bruno Duarte
 */
class AdminPost {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    // Nome da tabela no banco de dados
    const Entity = 'ws_posts';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrar: Para criar um post, favor preencher todos os campos", WS_INFOR];
            $this->Result = FALSE;
        else:
            $this->setData();
            $this->setName();
        endif;
    }

    // Privates
    private function setData() {
        $Cover = $this->Data['post_cover'];
        $Content = $this->Data['post_content'];
        unset($this->Data['post_cover'], $this->Data['post_content']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['post_name'] = Check::Name($this->Data['post_title']);
        $this->Data['post_date'] = Check::Data($this->Data['post_date']);
        $this->Data['post_type'] = 'post';

        $this->Data['post_cover'] = $Cover;
        $this->Data['post_content'] = $Content;

        $this->Data['post_cat_parent'] = $this->getCatParent();
    }

    private function getCatParent() {
        $rCat = new Read();
        $rCat->ExeRead("ws_categories", "where category_id = :id", "id={$this->Data['post_category']}");
        if ($rCat->getResult()):
            return $rCat->getResult()[0]['category_parent'];
        else:
            return NULL;
        endif;
    }

    private function setName() {
        $Where = (isset($this->Post) ? "post_id != {$this->Post} and" : '');
        $readName = new Read();
        $readName->ExeRead(self::Entity, "where {$Where} post_title = :t", "t={$this->Data['post_title']}");
        if ($readName->getResult()):
            $this->Data['post_name'] = $this->Data['post_name'] . '-' . $readName->getRowCount(); 
        endif;
    }

}
