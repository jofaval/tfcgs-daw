<!--Page configuration-->
<?php $optionalCSS = ["style.css"];?>
<?php $optionalScripts = ["js/script.js"];?>
<?php $title = "Perfil no encontrado";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php $currentPage = "Perfil";?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Perfil",
        "link" => Config::$EXECUTION_HOME_PATH . "profile/",
        "active" => false,
        "icon" => "user",
    ],
    [
        "name" => "Perfil no encontrado",
        "link" => Config::$EXECUTION_HOME_PATH . "profile/not-found/",
        "active" => true,
        "icon" => "exclamation-triangle",
    ],
];
?>

<?php ob_start()?>

<div class="m-auto container text-center">
    <span>
        <i class="fa h1 fa-user-times" style="font-size: 5rem !important;"></i>
    </span>
    <br>
    <h3>No hemos podido encontrar este perfil, lo sentimos</h3>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>