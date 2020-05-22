<!--Page configuration-->
<?php $optionalCSS = ["message.css"];?>
<?php $optionalScripts = [];?>
<?php $title = "Not signed in";?>
<?php $mainClasses = "";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
<?php $showBreadcrumb = false;?>
<?php $breadcrumb = [];?>

<?php ob_start()?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="notsigned-template text-center text-light">
                <h1>
                    ¡No has iniciado sesión!</h1>
<<<<<<< HEAD
                <h2>Por favor <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>signin/">inicia sesión</a>. </h2>
=======
                <h2>Por favor <a href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"signin/">inicia sesión</a>. </h2>
>>>>>>> 3581ba16a411ff959f27583d19bf9007ad75c058
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>