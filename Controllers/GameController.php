<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniWars\Controllers;

/**
 * Description of GameController
 *
 * @author tdd
 */
class GameController extends Controller {

    protected function onLoad() {

        if (!isset($_SESSION['userid'])) {
            $this->redirect('users', 'login');
        }
        
        session_destroy();
    }

    public function index() {
        echo 'index';
        die();
    }

}
