<?php
// carga del modelo y los controladores
function requireAllFromDir($dir = null)
{
    $dir = __DIR__ . "/../server/$dir";
    foreach (scandir($dir) as $filename) {
        $path = $dir . '/' . $filename;
        if (is_file($path)) {
            require_once $path;
        }
    }
}

//Basics
require_once __DIR__ . '/../server/classes/Config.php';
error_reporting(Config::$developmentMode);

if (Config::$allowConsoleOutput == 0) {
    echo "<script>console.log = function() {}</script>";
    echo "<script>console.error = function() {}</script>";
}
requireAllFromDir("classes/config");

//Core
requireAllFromDir("libs");
requireAllFromDir("classes");
require_once __DIR__ . '/../server/classes/POPOs/CRUDInterface.php';
requireAllFromDir("classes/POPOs");

$map = [];
//Security
require_once __DIR__ . '/../server/RoutingMap.php';
require_once __DIR__ . '/../server/ExtraRoutes.php';
require_once __DIR__ . '/../server/OnlyAdmin.php';
require_once __DIR__ . '/../server/Access.php';

$sessions = Sessions::getInstance();

$ctl = $_GET['ctl'];
if ($ctl == "") {
    $ctl = "signin";
}

if (!in_array($ctl, Config::$dont_need_db_ctls)) {
    try {
        $model = Model::getInstance();
    } catch (\Throwable $th) {
        header("Location: /daw/maintenance/");
    }
}

if (!$sessions->isUserAgentTheSame() && !in_array($ctl, Config::$notuseragent_ctls) && !in_array($ctl, Config::$dont_need_db_ctls)) {
    header('Location: /daw/notuseragent/');
}

//if (!Config::$developmentMode) {
if (!$sessions->doesSessionExist("username") && !in_array($ctl, Config::$notsigned_ctls) && !in_array($ctl, Config::$dont_need_db_ctls)) {
    header("Location: /daw/notsigned/");
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
        header('Location: /daw/no-action/');
        exit;
    }
} else {
    if (!$sessions->doesSessionExist("username")) {
        header("Location: /daw/signin/");
        $ruta = "signin";
    } else {
        header("Location: /daw/projects/");
        $ruta = "projects";
    }
}

// Ejecución del controlador asociado a la ruta
$controlador = $map[$ruta];
if (method_exists($controlador['controller'], $controlador['action'])) {
    if ($sessions->getSession("access") >= $controlador['access']) {
        call_user_func(array(new $controlador['controller'], $controlador['action']));
    } else {
        header('Location: /daw/access/');
    }
} else {
    header('Location: /daw/execution-error/');
    exit;
}