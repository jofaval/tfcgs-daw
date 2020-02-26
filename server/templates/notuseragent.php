<!--Page configuration-->
<?php $optionalCSS = [];?>
<?php $optionalScripts = [];?>
<?php $title = "Error";?>
<?php $mainClasses = "";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = false;?>
<?php $breadcrumb = [];?>

<?php ob_start()?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template text-center text-light">
                <h1>
                    This seems suspicous...</h1>
                <h2>
                    It seems you're not who you're telling.</h2>
                <div class="error-details">
                    Please, go back and <a href="mailto:admin@iesabastos.org">contact us</a> if it happens
                    again!
                </div>
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>