<!--Page configuration-->
<?php $optionalCSS = ["style.css"];?>
<?php $optionalScripts = ["js/script.js"];?>
<?php $title = "Admin";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
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
        "name" => "Admin",
        "link" => "/daw/admin/",
        "active" => true,
        "icon" => "cogs",
    ],
];
?>

<?php ob_start()?>

<h3> Admin </h3>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>