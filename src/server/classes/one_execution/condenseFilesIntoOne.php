<?php

$newFileName = "condensed.js";
$path = SystemPaths::CLIENT_SCRIPTS_PATH . "/$newFileName";

$filesToRead = [
    SystemPaths::CLIENT_LIBS_PATH . "/jquery.min.js",
    SystemPaths::CLIENT_LIBS_PATH . "/jquery-ui.min.js",
    SystemPaths::CLIENT_LIBS_PATH . "/bootstrap.min.js",
    SystemPaths::CLIENT_LIBS_PATH . "/bootstrap.bundle.min.js",
    SystemPaths::CLIENT_LIBS_PATH . "/mdb.min.js",
    SystemPaths::CLIENT_LIBS_PATH . "/jquery.sweet-modal.min.js",
    SystemPaths::CLIENT_JS_PATH . "/Modal.js",
    SystemPaths::CLIENT_JS_PATH . "/utils.js",
    SystemPaths::CLIENT_JS_PATH . "/ViewUtils.js",
    SystemPaths::CLIENT_JS_PATH . "/inputs.js",
    SystemPaths::CLIENT_JS_PATH . "/AjaxController.js",
    SystemPaths::CLIENT_JS_PATH . "/Validator.js",
    SystemPaths::CLIENT_JS_PATH . "/FormValidator.js",
    SystemPaths::CLIENT_JS_PATH . "/preloader.js",
    SystemPaths::CLIENT_JS_PATH . "/generalScript.js",
];

$content = "";

foreach ($filesToRead as $fileToRead) {
    $content .= PHP_EOL . file_get_contents($fileToRead) . PHP_EOL;
}

touch($path);
file_put_contents($path, $content);
echo "Número total de líneas: " . count(explode("\n", $content));
echo "<pre>";
echo ($content);
echo "</pre>";