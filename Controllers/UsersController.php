<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniWars\Controllers;

use UniWars\Models\Player;
use UniWars\Repositories\PlayerRepository;

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

            $player = PlayerRepository::create()
                    ->getOneByDetails($username, $password);

            if (!$player) {
                $this->view->error = 'Invalid ditails';
                return;
            }

            $_SESSION['userid'] = $player->getId();
            $this->view->user = $player->getUsername();
            $this->redirect('game');
        }
    }

    public function register() {

        $this->view->error = FALSE;
        if (isset($_POST['register'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $player = new Player($username, $password);

            if (!$player->save()) {
                $this->view->error = 'Duplicate users';
            }

            $this->login();
        }
    }

    public function logout() {

        session_destroy();
        die();
    }

}
