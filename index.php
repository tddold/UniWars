<?php

spl_autoload_register(function($className) {
     echo $className;
    $classPathSplitted = explode('\\', $className);
    var_dump($classPathSplitted);

    $vendor = $classPathSplitted[0];
    $classPath = str_replace($vendor . "\\", "", $className);
     var_dump($classPath);

    $classPath = str_replace("\\", "/", $classPath);
     var_dump($classPath);

    require_once $classPath . ".php";
});

$configName = getenv('CONFIG_NAME');

/**
 * @var \UniWars\Configs\DbConfig $dbConfigClass
 */
$dbConfigClass = '\\UniWars\\Configs\\'
        . $configName . '\\DbConfig';

UniWars\Db::setInstance(
        $dbConfigClass::USER, $dbConfigClass::PASS, $dbConfigClass::DBNAME, $dbConfigClass::HOST
);

$instan = new \UniWars\Db;
var_dump($instan);



//\UniWars\Db::getInstance()
//        ->query("INSERT INTO players (username, password) VALUES (?,?));", ['gosho', md5('1234')]);

$player = UniWars\Repositories\PlayerRepository::create()
        ->getOneByDetails('tdd', 1234);

var_dump($player);