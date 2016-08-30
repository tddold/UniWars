<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniWars;

/**
 * Description of View
 *
 * @author tdd
 */
class View {

    private $controllerName;
    private $actionName;

    public function __construct($controllerName, $actionName) {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
    }

    public function render() {
        require_once 'Views/' . $this->controllerName . '/' . $this->actionName . '.php';
    }

    public function url($controller = null, $action = null, $params = []) {

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

        if ($controller) {
            $url .= "/$action";
        }

        foreach ($params as $key => $param) {
            $url .= "/$key/$param";
        }

        return $url;
    }

    public function partial($name) {
        include 'View/Partials/' . $name . ".php";
    }

}
