<?php

ini_set('display_errors', 1);
spl_autoload_register(function($className) {
    // echo $className;
    $classPathSplitted = explode('\\', $className);

    $vendor = $classPathSplitted[0];
    $classPath = str_replace($vendor . "\\", "", $className);

    $classPath = str_replace("\\", "/", $classPath);

    if (!is_readable($classPath . '.php')) {
        throw new \Exception();
    }

    require_once $classPath . ".php";
});

$configName = getenv('CONFIG_NAME');

/**
 * @var \UniWars\Configs\DbConfig $dbConfigClass
 */
$dbConfigClass = '\\UniWars\\Configs\\'
        . $configName . '\\DbConfig';

\UniWars\Db::setInstance(
        $dbConfigClass::USER, $dbConfigClass::PASS, $dbConfigClass::DBNAME, $dbConfigClass::HOST
);

/**
 * REQUEST_URI' => string '/UniWars/user/login' (length=19)
  'SCRIPT_NAME' => string '/UniWars/index.php' (length=18)
  'PHP_SELF' => string '/UniWars/index.php' (length=18)
 */
$scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
$requestUri = explode('/', $_SERVER['REQUEST_URI']);
$customUri = [];
$controllerIndex = 0;
foreach ($scriptName as $key => $value) {
    if ($value == 'index.php') {
        $controllerIndex = $key;
        break;
    }
}

$actionIndex = $controllerIndex + 1;

$controllerName = $requestUri[$controllerIndex];
$actionName = $requestUri[$actionIndex];

$controllerClassName = '\\Uniwars\\Controllers\\' . ucfirst($controllerName) . 'Controller';

$view = new \UniWars\View($controllerName, $actionName);

try {
    $controller = new $controllerClassName($view);
} catch (Exception $ex) {
    echo 'No such controller!';
}

if (!method_exists($controller, $actionName)) {
    die('No sush action!');
}
$controller->$actionName();
$view->render();

