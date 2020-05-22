<!--Page configuration-->
<?php $optionalCSS = ["style.css"];?>
<?php $optionalScripts = ["js/script.js"];?>
<?php $title = "Example";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Example",
        "link" => Config::$EXECUTION_HOME_PATH . "example/",
        "active" => true,
        "icon" => "home",
    ],
];
?>

<?php ob_start()?>

<h3> Hello world! </h3>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>