<!--Page configuration-->
<?php $optionalCSS = ["message.css"];?>
<?php $optionalScripts = [];?>
<?php $title = "Error";?>
<?php $mainClasses = "";?>
<?php $showFooter = Sessions::getInstance()->isUserLogged();?>
<?php $showHeader = Sessions::getInstance()->isUserLogged();?>
<?php $showBreadcrumb = true;?>
<?php $breadcrumb = [
    [
        "name" => "Volver a la home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => true,
        "icon" => "home",
    ],
];?>

<?php ob_start()?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template text-center text-light">
                <h1>
                    Oopsie!</h1>
                <h2>
                    ¡Ha ocurrido un error!</h2>
                <h4><?php echo preg_replace("/\_/", " ", Utils::getCleanedData("message")); ?></h4>
                <div class="error-details">
                    Por favor, vuelve y <a href="mailto:<?php echo Config::$emailSender; ?>">contáctanos</a> si vuelve a
                    ocurrir de nuevo.
                </div>
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>