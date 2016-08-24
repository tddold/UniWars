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

    public function __construct(\Uniwars\View $view) {
        $this->view = $view;
    }

}
