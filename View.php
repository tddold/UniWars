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

}
