<!--Page configuration-->
<?php $optionalCSS = ["message.css", "signin.css"];?>
<?php $optionalScripts = ["js/customCursor.js"];?>
<?php $title = "404 Not found";?>
<?php $mainClasses = "waves-effect waves-light rgba-white-slight";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = false;?>
<?php $breadcrumb = [];?>

<?php ob_start()?>

<div class="container text-center" style="z-index: 50;">
    <h1 class="font-weight-bold" style="font-size: 10em;">404</h1>
    <h1 style="font-size: 6em;">Mamma mia!</h1>
    <h2>We have not found what you requested!</h2>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>