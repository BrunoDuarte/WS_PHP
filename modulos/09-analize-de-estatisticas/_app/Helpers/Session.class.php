<?php

/**
 * Session.class [ HELPER ]
 * Responsável pelas estatísticas, sessões e atualizações de tráfego do sistema!
 * @copyright (c) 2015, Bruno Duarte
 */
class Session {

    private $Date;
    private $Cache;
    private $Traffic;
    private $Browser;

    function __construct($Cache = NULL) {
        session_start();
        $this->CheckSession($Cache);
    }

    // Verifica e executa todos os métodos da classe
    private function CheckSession($Cache = NULL) {
        $this->Date = date('Y-m-d');
        $this->Cache = ( (int) $Cache ? $Cache : 20 );

        if (empty($_SESSION['useronline'])):
            $this->setTraffic();
            $this->setSession();
            $this->CheckBrowser();
            $this->setUsuario();
            $this->BrowserUpdate();
        else:
            $this->TrafficUpdate();
            $this->sessionUpdate();
            $this->CheckBrowser();
            $this->UsuarioUpdate();
        endif;

        $this->Date = NULL;
    }

    /*
     * ***********************************
     * ******** SESSÃO DE USUÁRIO ********
     * ***********************************
     */

    // Inicia a sessão do usuário
    private function setSession() {
        $_SESSION['useronline'] = [
            "online_session" => session_id(),
            "online_startview" => date('Y-m-d H:m:s'),
            "online_endview" => date('Y-m-d H:m:s', strtotime("+{$this->Cache}minutes")),
            "online_ip" => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP),
            "online_url" => filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT),
            "online_agent" => filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_DEFAULT)
        ];
    }

    // Atualiza sessão do usuário
    private function sessionUpdate() {
        $_SESSION['useronline']['online_endview'] = date('Y-m-d H:m:s', strtotime("+{$this->Cache}minutes"));
        $_SESSION['useronline']['online_url'] = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT);
    }

    /*
     * ****************************************
     * *** USUÁRIOS, VISITAS E ATUALIZAÇÕES ***
     * ****************************************
     */

    // Verifica e insere o tráfego na tabela
    private function setTraffic() {
        $this->getTraffic();
        if (!$this->Traffic):
            $ArrSiteViews = [
                'siteviews_date' => $this->Date,
                'siteviews_users' => 1,
                'siteviews_views' => 1,
                'siteviews_pages' => 1];
            $createSiteViews = new Create();
            $createSiteViews->ExeCreate('ws_siteviews', $ArrSiteViews);
        else:
            if (!$this->getCookie()):
                $ArrSiteViews = [
                    'siteviews_users' => $this->Traffic['siteviews_users'] + 1,
                    'siteviews_views' => $this->Traffic['siteviews_views'] + 1,
                    'siteviews_pages' => $this->Traffic['siteviews_pages'] + 1];
            else:
                $ArrSiteViews = [
                    'siteviews_views' => $this->Traffic['siteviews_views'] + 1,
                    'siteviews_pages' => $this->Traffic['siteviews_pages'] + 1];
            endif;

            $updateSiteViews = new Update();
            $updateSiteViews->ExeUpdate('ws_siteviews', $ArrSiteViews, "where siteviews_date = :date", "date={$this->Date}");
        endif;
    }

    // Verifica e atualiza os pageviews
    private function TrafficUpdate() {
        $this->getTraffic();
        $ArrSiteViews = ['siteviews_pages' => $this->Traffic['siteviews_pages'] + 1];
        $updatePageViews = new Update();
        $updatePageViews->ExeUpdate('ws_siteviews', $ArrSiteViews, "where siteviews_date = :date", "date={$this->Date}");

        $this->Traffic = NULL;
    }

    // Obtem dados da tabela [ HELPER TRAFFIC ]
    private function getTraffic() {
        $readSiteViews = new Read();
        $readSiteViews->ExeRead('ws_siteviews', "where siteviews_date = :date", "date={$this->Date}");
        if ($readSiteViews->getRowCount()):
            $this->Traffic = $readSiteViews->getResult()[0];
        endif;
    }

    // Verifica, cria e atualiza Cookie do usuário [ HELPER TRAFFIC ]
    private function getCookie() {
        setcookie("useronline", base64_encode("voicercore"), time() + 86400);
        $Cookie = filter_input(INPUT_COOKIE, 'useronline', FILTER_DEFAULT);
        if (!$Cookie):
            return FALSE;
        else:
            return TRUE;
        endif;
    }

    /*
     * *************************************
     * ******* NAVEGADORES DE ACESSO *******
     * *************************************
     */

    // Identifica navegador de usuário
    private function CheckBrowser() {
        $this->Browser = $_SESSION['useronline']['online_agent'];
        if (strpos($this->Browser, 'Chrome')):
            $this->Browser = 'Chrome';
        elseif (strpos($this->Browser, 'Firefox')):
            $this->Browser = 'Firefox';
        elseif (strpos($this->Browser, 'MSIE') || strpos($this->Browser, 'Trident/')):
            $this->Browser = 'IE';
        else:
            $this->Browser = 'Outros';
        endif;
    }

    // Atualiza tabela com dados de navegadores
    private function BrowserUpdate() {
        $readAgent = new Read();
        $readAgent->ExeRead('ws_siteviews_agent', "where agent_name = :agent", "agent={$this->Browser}");
        if (!$readAgent->getResult()):
            $ArrAgent = ['agent_name' => $this->Browser, 'agent_views' => 1];
            $createAgent = new Create();
            $createAgent->ExeCreate('ws_siteviews_agent', $ArrAgent);
        else:
            $ArrAgent = ['agent_views' => $readAgent->getResult()[0]['agent_views'] + 1];
            $updateAgent = new Update();
            $updateAgent->ExeUpdate('ws_siteviews_agent', $ArrAgent, "where agent_name = :name", "name={$this->Browser}");
        endif;
    }

    /*
     * ***********************************
     * ********* USUÁRIOS ONLINE *********
     * ***********************************
     */

    // Cadastra usuário online na table
    private function setUsuario() {
        $sesOnline = $_SESSION['useronline'];
        $sesOnline['agent_name'] = $this->Browser;
        $userCreate = new Create();
        $userCreate->ExeCreate('ws_siteviews_online', $sesOnline);
    }

    // Atualiza navegação do usuário online
    private function UsuarioUpdate() {
        $ArrOnline = [
            'online_endview' => $_SESSION['useronline']['online_endview'],
            'online_url' => $_SESSION['useronline']['online_url']
        ];

        $userUpdate = new Update();
        $userUpdate->ExeUpdate('ws_siteviews_online', $ArrOnline, "where online_session = :ses", "ses={$_SESSION['useronline']['online_session']}");

        if (!$userUpdate->getRowCount()):
            $readSes = new Read();
            $readSes->ExeRead('ws_siteviews_online', "where online_session = :onses", "onses={$_SESSION['useronline']['online_session']}");
            if (!$readSes->getRowCount()):
                $this->setUsuario();
            endif;
        endif;
    }

}
