<?php

/**
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        
        if (isset($url[0])) {
            $controller = ucwords($url[0]);
            // Look in controllers for first val
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/app/controllers/" . $controller . ".php")) {
                // If exists set as curretn controller
                $this->currentController = $controller;
                // Unset 0 index
                unset($url[0]);
            }
        }



        // Require the controller
        require_once $_SERVER['DOCUMENT_ROOT'] . "/app/controllers/" . $this->currentController . ".php";

        // Instantiate
        $this->currentController = new $this->currentController;

        // check for second part of url
        if (isset($url[1])) {
            // Check if method ecists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // get params
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            // last / will be trimmed
            $url = rtrim($_GET['url'], '/');
            // no non-html chars
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // Form Array of params
            $url = explode('/', $url);
            return $url;
        }
    }
}
