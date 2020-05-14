<!--Page configuration-->
<?php $optionalCSS = ["message.css"];?>
<?php $optionalScripts = [];?>
<?php $title = "Not user agent";?>
<?php $mainClasses = "";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
<?php $showBreadcrumb = false;?>
<?php $breadcrumb = [];?>

<?php ob_start()?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template text-center text-light">
                <h1>
                    Esto parece sospechoso...</h1>
                <h2>
                    No eres quien nos dices ser.</h2>
                <div class="error-details">
                    Por favor, vuelve a intentarlo y <a
                        href="mailto:<?php echo Config::$emailSender; ?>">contáctanos</a> si este problema persiste.
                </div>
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>