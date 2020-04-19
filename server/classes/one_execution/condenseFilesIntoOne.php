<?php

$newFileName = "condensed.js";
$path = __DIR__ . "/../../../client/scripts/$newFileName";

$filesToRead = [
    "/../../../client/scripts/libs/jquery.min.js",
    "/../../../client/scripts/libs/jquery-ui.min.js",
    "/../../../client/scripts/libs/bootstrap.min.js",
    "/../../../client/scripts/libs/bootstrap.bundle.min.js",
    "/../../../client/scripts/libs/mdb.min.js",
    "/../../../client/scripts/libs/jquery.sweet-modal.min.js",
    "/../../../client/scripts/js/Modal.js",
    "/../../../client/scripts/js/utils.js",
    "/../../../client/scripts/js/ViewUtils.js",
    "/../../../client/scripts/js/inputs.js",
    "/../../../client/scripts/js/AjaxController.js",
    "/../../../client/scripts/js/Validator.js",
    "/../../../client/scripts/js/FormValidator.js",
    "/../../../client/scripts/js/preloader.js",
    "/../../../client/scripts/js/generalScript.js",
];

$content = "";

foreach ($filesToRead as $fileToRead) {
    /* echo __DIR__ . $fileToRead;
    echo "<br />"; */
    $content .= PHP_EOL . file_get_contents(__DIR__ . $fileToRead) . PHP_EOL;
}

touch($path);
file_put_contents($path, $content);
echo "Número total de líneas: " . count(explode("\n", $content));
echo "<pre>";
echo ($content);
echo "</pre>";