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
                    You're not signed in!</h1>
                <h2>Please <a href="/daw/signin/">signin</a>. </h2>
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>