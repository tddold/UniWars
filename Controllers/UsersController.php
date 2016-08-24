<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniWars\Controllers;

/**
 * Description of UsersController
 *
 * @author tdd
 */
class UsersController extends Controller {

    public function login() {

        $this->view->error = FALSE;
        $this->view->user = FALSE;

        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $player = \UniWars\Repositories\PlayerRepository::create()
                    ->getOneByDetails($username, $password);

            if (!$player) {
                $this->view->error = 'Invalid ditails';
                return;
            }

            $_SESSION['userid'] = $player->getId();
            $this->view->user = $player->getUsername();
        }
    }

    public function register() {
        echo 'register calles';
    }

    public function test() {
        echo 'test';
    }

}
