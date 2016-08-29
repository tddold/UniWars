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

    private function __construct(Db $db) {
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

        $query = "SELECT id, username, password "
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

        $query = "SELECT id, username, password "
                . "FROM players WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $player = new Player(
                $result['username'], $result['password'], $result['id']
        );

        $this->db->query("SELECT id, name, player_id,"
                . "FROM universities WHERE player_id =?", [$id]);

        $universiriesResult = $this->db->fetchAll();

        $unversities = [];

        foreach ($universiriesResult as $universityResult) {
            $unversities [] = new Uneversity(
                    $universityResult['id'], $universityResult['name'], $player, $universityResult['money'], $universityResult['lecturues']
            );
        }
        
        $player->setUniverdities($unversities);

        return $player;
    }

    /**
     * 
     * @return Player[]
     */
    public function getAll() {

        $query = "SELECT id, username, password "
                . "FROM players";

        $this->db->query($query);

        $result = $this->db->fetchAll();

        $collection = [];

        foreach ($result as $row) {
            $collection[] = new Player($row['username'], $row['password'], $row['id']
            );
        }

        return $collection;
    }

    public function save(Player $player) {
        $query = "INSERT INTO players (username, password) VALUES (?,?)";
        $params = [$player->getUsername(), $player->getPassword()];

        if ($player->getId()) {
            $query = "UPDATE players SET username = ?, password = ? WHERE id = ?";
            $params[] = $player->getId();
        }

        $this->db->query($query, $params);
        return $this->db->row() > 0;
    }

}
