<?php
// carga del modelo y los controladores
function requireAllFromDir($dir = null)
{
    $dir = SystemPaths::SERVER_PATH . "/$dir";
    foreach (scandir($dir) as $filename) {
        $path = $dir . '/' . $filename;
        if (is_file($path)) {
            require_once $path;
        }
    }
}

/* //Print URL with params
var_dump(array_merge($_REQUEST, ["URL" => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']]));
exit; */

//Basics
require_once __DIR__ . '/../server/Paths.php';
require_once SystemPaths::SERVER_CLASSES_PATH . '/Config.php';
error_reporting(Config::$developmentMode);

if (Config::$allowConsoleOutput == 0) {
    echo "<script>console.log = function() {}</script>";
    echo "<script>console.error = function() {}</script>";
    echo "<script>console.warn = function() {}</script>";
}
requireAllFromDir("classes/config");

//Core
requireAllFromDir("libs");
requireAllFromDir("classes");
require_once SystemPaths::SERVER_POPOS_PATH . '/CRUDInterface.php';
requireAllFromDir("classes/POPOs");

$map = [];
//Security
require_once SystemPaths::SERVER_PATH . '/RoutingMap.php';
require_once SystemPaths::SERVER_PATH . '/ExtraRoutes.php';
require_once SystemPaths::SERVER_PATH . '/OnlyAdmin.php';
require_once SystemPaths::SERVER_PATH . '/Access.php';

$sessions = Sessions::getInstance();

$ctl = $_GET['ctl'];
if ($ctl == "") {
    $ctl = "signin";
}

if (!in_array($ctl, Config::$dont_need_db_ctls)) {
    try {
        $model = Model::getInstance();
    } catch (\Throwable $th) {
        header("Location: " . Config::$EXECUTION_HOME_PATH . "maintenance/");
    }
}

if (!$sessions->isUserAgentTheSame() && !in_array($ctl, Config::$notuseragent_ctls) && !in_array($ctl, Config::$dont_need_db_ctls)) {
    header('Location: ' . Config::$EXECUTION_HOME_PATH . 'notuseragent/');
}

//if (!Config::$developmentMode) {
if (!$sessions->doesSessionExist("username") && !in_array($ctl, Config::$notsigned_ctls) && !in_array($ctl, Config::$dont_need_db_ctls)) {
    header("Location: " . Config::$EXECUTION_HOME_PATH . "notsigned/");
}
//}

/*
 * Access
 * 0 - Guest - ACCESS_LEVEL_GUEST
 * 1 - Not activated account - ACCESS_LEVEL_NOT_ACTIVATED
 * 2 - Teacher - ACCESS_LEVEL_TEACHER
 * 3 - Admin - ACCESS_LEVEL_ADMIN
 */

// enrutamiento
/* $map = array(
'signin' => array('controller' => 'Controller', 'action' => 'signin', 'access' => Config::$ACCESS_LEVEL_GUEST),
'signout' => array('controller' => 'Controller', 'action' => 'signout', 'access' => Config::$ACCESS_LEVEL_GUEST),
'project' => array('controller' => 'Controller', 'action' => 'project', 'access' => Config::$ACCESS_LEVEL_ADMIN),
'admin' => array('controller' => 'Controller', 'action' => 'admin', 'access' => Config::$ACCESS_LEVEL_ADMIN),
'access' => array('controller' => 'Controller', 'action' => 'access', 'access' => Config::$ACCESS_LEVEL_GUEST),
'error' => array('controller' => 'Controller', 'action' => 'error', 'access' => Config::$ACCESS_LEVEL_GUEST),
'notsigned' => array('controller' => 'Controller', 'action' => 'notsigned', 'access' => Config::$ACCESS_LEVEL_GUEST),
'notuseragent' => array('controller' => 'Controller', 'action' => 'notuseragent', 'access' => Config::$ACCESS_LEVEL_GUEST),
//AJAX Operations
'getMonthFromEvents' => array('controller' => 'AjaxController', 'action' => 'getMonthFromEvents', 'access' => Config::$ACCESS_LEVEL_TEACHER),
); */

if (Config::$developmentMode) {
    /* $map["test"] = array('controller' => 'AjaxController', 'action' => 'test', 'access' => Config::$ACCESS_LEVEL_GUEST);
$sessions->setSession("access", 20);
$sessions->setSession("username", "test"); */
}

// Parseo de la ruta
if (isset($_REQUEST["ctl"])) {
    if (isset($map[$ctl])) {
        $ruta = $ctl;
    } else {
        header('Location: ' . Config::$EXECUTION_HOME_PATH . 'no-action/');
        exit;
    }
} else {
    if (!$sessions->doesSessionExist("username")) {
        header("Location: " . Config::$EXECUTION_HOME_PATH . "signin/");
        $ruta = "signin";
    } else {
        header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/");
        $ruta = "projects";
    }
}

// Ejecución del controlador asociado a la ruta
$controlador = $map[$ruta];
if (method_exists($controlador['controller'], $controlador['action'])) {
    if ($sessions->getSession("access") >= $controlador['access']) {
        call_user_func(array(new $controlador['controller'], $controlador['action']));
    } else {
        //No tiene suficiente nivel de acceso
        header('Location: ' . Config::$EXECUTION_HOME_PATH . 'access/');
    }
} else {
    //No se ha podido ejecutar
    header('Location: ' . Config::$EXECUTION_HOME_PATH . 'execution-error/');
    exit;
}