<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniWars\Models;

/**
 * Description of University
 *
 * @author tdd
 */
class University {

    private $id;
    private $name;

    /**
     *
     * @var Player;
     */
    private $players;
    private $money;
    private $lecturues;

    function __construct($id, $name, Player $player, $money, $lecturues) {
        $this->serId($id);
        $this->setName($name);
        $this->setPlayers($player);
        $this->setMoney($money);
        $this->setLecturues($lecturues);
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPlayers() {
        return $this->players;
    }

    function getMoney() {
        return $this->money;
    }

    function getLecturues() {
        return $this->lecturues;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPlayers(Player $player) {
        $this->players = $player;
    }

    function setMoney($money) {
        $this->money = $money;
    }

    function setLecturues($lecturues) {
        $this->lecturues = $lecturues;
    }

}
