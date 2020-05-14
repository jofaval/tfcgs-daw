<!--Page configuration-->
<?php $optionalCSS = ["message.css"];?>
<?php $optionalScripts = [];?>
<?php $title = "Access";?>
<?php $mainClasses = "";?>
<?php $showFooter = Sessions::getInstance()->isUserLogged();?>
<?php $showHeader = Sessions::getInstance()->isUserLogged();?>
<?php $showBreadcrumb = true;?>
<?php $breadcrumb = [
    [
        "name" => "Go back home",
        "link" => "/daw/",
        "active" => true,
        "icon" => "home",
    ],
];?>

<?php ob_start()?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="access-template text-center text-light">
                <h1>
                    You don't have access!</h1>
                <h2>
                    It seems you don't have enough permissions for that action</h2>
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>