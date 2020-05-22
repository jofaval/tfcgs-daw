<!--Page configuration-->
<?php $optionalCSS = ["animation.css"];?>
<?php $optionalScripts = [];?>
<?php $title = "Mantenimiento";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
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
        "name" => "Mantenimiento",
        "link" => Config::$EXECUTION_HOME_PATH . "maintenance/",
        "active" => true,
        "icon" => "cogs",
    ],
];
?>

<?php ob_start()?>

<style>
.fa-big {
    font-size: 10rem !important;
}

.fa-bigger {
    font-size: 12.5rem !important;
}

main {
    background: none !important;
}
</style>

<link rel="shortcut icon" href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"img/branding/maintenance_favicon.gif"
    type="image/gif">

<div class="w-100 h-100 d-flex text-dark justify-content-center align-content-center
 flex-column justify-items-center align-items-center text-center">
    <h1>La aplicación se encuentra en mantenimiento</h1>
    <div class="cogsContainer">
        <span>
            <i class="fa fa-cog fa-big rotate-self-animation"></i>
        </span>
        <span style="margin-left: -1em;">
            <i class="fa fa-cog fa-bigger animation-delay-4 rotate-self-animation animation-reverse"></i>
        </span>
    </div>
    <p class="font-weight-bold mb-0 h1">Perdonen las molestias</p>
</div>
<script>
document.querySelector("main").classList.add("bg-warning");
</script>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>