<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniWars\Controllers;

/**
 * Description of Controller
 *
 * @author tdd
 */
class Controller {

    /**
     *
     * @var type \Uniwars\View;
     */
    protected $view;
    protected $controllerName;

    public function __construct(\Uniwars\View $view, $name) {
        $this->view = $view;
        $this->controllerName = $name;
        $this->onLoad();
    }

    protected function onLoad() {
        
    }

    public function redirect($controller = null, $action = null, $params = []) {

        $requestUri = explode('/', $_SERVER['REQUEST_URI']);
        $url = "//" . $_SERVER['HTTP_HOST'] . "/";
        foreach ($requestUri as $key => $uri) {
            if ($uri == $this->controllerName) {
                break;
            }

            $url .= "$uri";
        }

        if ($controller) {
            $url .= "/$controller";
        }

        if ($action) {
            $url .= "/$action";
        }

        foreach ($params as $key => $param) {
            $url .= "/$key/$param";
        }

       
        header("Location: " . $url);
        exit();
    }

}
