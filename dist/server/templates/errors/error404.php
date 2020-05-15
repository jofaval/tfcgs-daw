<!--Page configuration-->
<?php $optionalCSS = ["message.css"];?>
<?php $optionalScripts = ["js/customCursor.js"];?>
<?php $title = "404 Not found";?>
<?php $mainClasses = "";?>
<?php $showFooter = Sessions::getInstance()->isUserLogged();?>
<?php $showHeader = Sessions::getInstance()->isUserLogged();?>
<?php $showBreadcrumb = true;?>
<?php $breadcrumb = [
    [
        "name" => "Volver a la home",
        "link" => "/daw/client/",
        "active" => true,
        "icon" => "home",
    ],
];?>

<?php ob_start()?>

<div class="container text-center d-flex flex-column">
    <h1 class="font-weight-bold" style="font-size: 10em;">404</h1>
    <h1 style="font-size: 6em;">Mamma mia!</h1>
    <h2>¡No hemos encontrado lo que nos has pedido!</h2>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>