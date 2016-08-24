<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UniWars;

/**
 * Description of Db
 *
 * @author tdd
 */
class Db {

    /**
     *
     * @var \PDO
     */
    private $conn;

    /**
     *
     * @var \PDOStatement
     */
    private $stmt;

    /**
     *
     * @var Db
     */
    private static $inst = null;

    private function __construct($user, $pass, $dbName, $host) {

        $dsn = 'mysql:dbname=' . $dbName . ';host=' . $host;
        $this->conn = new \PDO($dsn, $user, $pass);
    }

    public static function setInstance($user, $pass, $dbName, $host) {

        if (self::$inst == NULL) {

            self::$inst = new self($user, $pass, $dbName, $host);
        }
    }

    /**
     * 
     * @return Db
     */
    public static function getInstance() {

        return self::$inst;
    }

    /**
     * @param $query
     * @param array $params
     */
    public function query($query, array $params = []) {

        if (!$this->conn) {

            throw new \Exception('The conection string is null!');
        }

        $this->stmt = $this->conn->prepare($query);
        $this->stmt->execute($params);
    }

    /**
     * 
     * @return array
     */
    public function fetchAll() {

        return $this->stmt->fetchAll();
    }

    /**
     * 
     * @return mixed
     * 
     */
    public function row() {

        return $this->stmt->fetch();
    }

    /**
     * 
     * @return int
     */
    public function rows() {

        return $this->stmt->rowCount();
    }

}
