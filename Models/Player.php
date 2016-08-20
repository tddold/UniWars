<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniWars\Models;

/**
 * Description of Player
 *
 * @author User
 */
class Player {

    private $id;
    private $username;
    private $password;

    public function _construct($username, $password, $id = null) {
        $this->setId($id);
        $this->setPassword($password);
        $this->setUsername($username);
    }

    /**
     * 
     * @return type $id
     */
    function getId() {
        return $this->id;
    }

    /**
     * 
     * @return type $username
     */
    function getUsername() {
        return $this->username;
    }

    /**
     * 
     * @return type $password
     */
    function getPassword() {
        return $this->password;
    }

    /**
     * 
     * @param type $id
     */
    function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     * @param type $username
     */
    function setUsername($username) {
        $this->username = $username;
    }

    /**
     * 
     * @param type $password
     */
    function setPassword($password) {
        $this->password = md5($password);
    }

}
