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
require_once __DIR__ . '/../server/classes/Config.php';
require_once __DIR__ . '/../server/classes/POPOs/CRUDInterface.php';
error_reporting(Config::$developmentMode);
requireAllFromDir("libs");
requireAllFromDir("classes");
requireAllFromDir("POPOs");

$sessions = Sessions::getInstance();
$ctl = $_GET['ctl'];
if ($ctl == "") {
    $ctl = "signin";
}

if (!$sessions->isUserAgentTheSame() && !in_array($ctl, Config::$notuseragent_ctls)) {
    header("Location: index.php?ctl=notuseragent");
}

/*
 * Access
 * 0 - Guest - ACCESS_LEVEL_GUEST
 * 1 - Not activated account - ACCESS_LEVEL_NOT_ACTIVATED
 * 2 - Teacher - ACCESS_LEVEL_TEACHER
 * 3 - Admin - ACCESS_LEVEL_ADMIN
 */

// enrutamiento
$map = array(
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
);

if (Config::$developmentMode) {
    $map["test"] = array('controller' => 'AjaxController', 'action' => 'test', 'access' => Config::$ACCESS_LEVEL_GUEST);
    $sessions->setSession("access", 20);
    $sessions->setSession("username", "test");
}

// Parseo de la ruta
if (isset($ctl)) {
    if (isset($map[$ctl])) {
        $ruta = $ctl;
    } else {
        header('Location: ./index.php?ctl=error&message=Action isn\'t available at the moment');
        exit;
    }
} else {
    if (!$sessions->doesSessionExist("username") && !in_array($ctl, Config::$notsigned_ctls)) {
        $ruta = "signin";
    } else {
        $ruta = "project";
    }
}

if (!Config::$developmentMode) {
    if (!$sessions->doesSessionExist("username") && !in_array($ctl, Config::$notsigned_ctls)) {
        header('Location: ./index.php?ctl=notsigned');
    }
}

// Ejecución del controlador asociado a la ruta
$controlador = $map[$ruta];
if (method_exists($controlador['controller'], $controlador['action'])) {
    if ($sessions->getSession("access") >= $controlador['access']) {
        call_user_func(array(new $controlador['controller'], $controlador['action']));
    } else {
        header('Location: ./index.php?ctl=access');
    }
} else {
    header('Location: ./index.php?ctl=error&message=Action could not be executed');
    exit;
}