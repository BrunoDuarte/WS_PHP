<?php

/**
 * Login.class [ MODEL ]
 * Responsável por autenticar, validar e checar usuário do sistema de login!
 * @copyright (c) 2016, Bruno Duarte
 */
class Login {

    private $Level;
    private $Email;
    private $Senha;
    private $Error;
    private $Result;

    function __construct($Level) {
        $this->Level = (int) $Level;
    }

    public function ExeLogin(array $UserDate) {
        $this->Email = (string) strip_tags(trim($UserDate['user']));
        $this->Senha = (string) strip_tags(trim($UserDate['pass']));
        $this->setLogin();
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }
    
    public function CheckLogin(){
        if(empty($_SESSION['userlogin']) || $_SESSION['userlogin']['user_level'] < $this->Level):
            unset($_SESSION['userlogin']);
            return FALSE;
        else:
            return TRUE;
        endif;
    }

    //PRIVATES
    private function setLogin() {
        if (!$this->Email || !$this->Senha || !Check::Email($this->Email)):
            $this->Error = ['Informe seu E-mail e senha para efetuar o login', WS_INFOR];
            $this->Result = FALSE;
        elseif (!$this->getUser()):
            $this->Error = ['Os dados informados não são compatíveis!', WS_ALERT];
            $this->Result = FALSE;
        elseif ($this->Result['user_level'] < $this->Level):
            $this->Error = ["Desculpe {$this->Result['user_name']}, você não tem permissão para acessar esta área!", WS_ERROR];
            $this->Result = FALSE;
        else:
            $this->Execute();
        endif;
    }

    private function getUser() {
        $this->Senha = md5($this->Senha);
        
        $read = new Read();
        $read->ExeRead("ws_users", "WHERE user_email = :e AND user_password = :p", "e={$this->Email}&p={$this->Senha}");
        if ($read->getResult()):
            $this->Result = $read->getResult()[0];
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    private function Execute() {
        if (!session_id()):
            session_start();
        endif;

        $_SESSION['userlogin'] = $this->Result;
        $this->Error = ["Olá {$this->Result['user_name']}, seja bem vindo(a). Aguarde redirecionamento!", WS_ACCEPT];
        $this->Result = TRUE;
    }

}
