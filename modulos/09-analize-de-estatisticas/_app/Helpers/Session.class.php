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
        else:
            $this->TrafficUpdate();
            $this->sessionUpdate();
        endif;

        $this->Date = NULL;
    }

    // Inicia a sessão do usuário
    private function setSession() {
        $_SESSION['useronline'] = [
            "online_session" => session_id(),
            "online_startviews" => date('Y-m-d H:m:s'),
            "online_endviews" => date('Y-m-d H:m:s', strtotime("+{$this->Cache}minutes")),
            "online_ip" => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP),
            "online_url" => filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT),
            "online_agent" => filter_input(INPUT_SERVER, 'HTTP_USER_AGENT', FILTER_DEFAULT)
        ];
    }

    // Atualiza sessão do usuário
    private function sessionUpdate() {
        $_SESSION['useronline']['online_endviews'] = date('Y-m-d H:m:s', strtotime("+{$this->Cache}minutes"));
        $_SESSION['useronline']['online_url'] = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_DEFAULT);
    }

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

}
