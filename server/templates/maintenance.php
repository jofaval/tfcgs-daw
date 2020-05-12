<!--Page configuration-->
<?php $optionalCSS = [];?>
<?php $optionalScripts = [];?>
<?php $title = "Mantenimiento";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "/daw/",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Mantenimiento",
        "link" => "/daw/maintenance/",
        "active" => true,
        "icon" => "cogs",
    ],
];
?>

<?php ob_start()?>

<h3> Estamos en mantenimiento! </h3>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>