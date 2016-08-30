<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniWars\Controllers;

use UniWars\Repositories\PlayerRepository;

/**
 * Description of GameController
 *
 * @author tdd
 */
class GameController extends Controller {

    /**
     *
     * @var \Uniwars\Models\Player;
     */
    protected $currentPlayer = null;

    protected function onLoad() {

        if (!isset($_SESSION['userid'])) {
            $this->redirect('users', 'login');
        }

        if ($this->currentPlayer == NULL) {
            $this->currentPlayer = PlayerRepository::create()
                    ->getOne($_SESSION['userId']);
        }

        session_destroy();
    }

    public function index() {
        foreach ($this->currentPlayer->getUniverdities() as $university) {
            echo $university->getName() ."<br/>:";
        }
    }

}
