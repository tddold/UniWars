<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniWars\Repositories;

use UniWars\Db;
use UniWars\Models\Player;

/**
 * Description of PlayerRepository
 *
 * @author User
 */
class PlayerRepository {

    /**
     *
     * @var type \Uniwars\Db
     */
    private $db;

    /**
     *
     * @var type PlayerRepository
     */
    private static $inst = null;

    private function _construct(Db $db) {
        $this->db = $db;
    }

    /**
     * 
     * @return PlayerRepository
     */
    public static function create() {
        if (self::$inst == NULL) {
            self::$inst = new self(Db::getInstance());
        }

        return self::$inst;
    }

    /**
     * 
     * @param type $user
     * @param type $pass
     * @return boolean
     */
    public function getOneByDetails($user, $pass) {

        $query = "SELECT id, username, password"
                . "FROM players WHERE username = ? AND password = ?";

        $this->db->query($query, [$user, md5($pass)]);

        $result = $this->db->row();

        if (empty($result)) {
            return FALSE;
        }

        return $this->getOne($result['id']);
    }

    /**
     * 
     * @param type $id
     * @return boolean|Player
     */
    public function getOne($id) {

        $query = "SELECT id, username, password"
                . "FROM players WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        return new Player(
                $result['username'], $result['password'], $result['id']
        );
    }

    /**
     * 
     * @return Player[]
     */
    public function getAll() {

        $query = "SELECT id, username, password"
                . "FROM players";

        $this->db->query($query);

        $result = $this->db->fetchAll();

        $collection = [];

        foreach ($result as $row) {
            $collection[] = new Player(
                    $row['username'], $row['password'], $row['password']
            );
        }

        return $collection;
    }

}
