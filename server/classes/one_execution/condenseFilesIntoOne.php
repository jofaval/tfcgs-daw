<?php

$newFileName = "condensed.js";
$path = __DIR__ . "/scripts/$newFileName";

$filesToRead = [
    "/scripts/libs/jquery.min.js",
    "/scripts/libs/jquery-ui.min.js",
    "/scripts/libs/bootstrap.min.js",
    "/scripts/libs/bootstrap.bundle.min.js",
    "/scripts/libs/mdb.min.js",
    "/scripts/libs/jquery.sweet-modal.min.js",
    "/scripts/js/Modal.js",
    "/scripts/js/utils.js",
    "/scripts/js/ViewUtils.js",
    "/scripts/js/inputs.js",
    "/scripts/js/AjaxController.js",
    "/scripts/js/Validator.js",
    "/scripts/js/FormValidator.js",
    "/scripts/js/preloader.js",
    "/scripts/js/generalScript.js",
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