<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css"];?>
<?php $optionalScripts = ["js/ProjectsCrudMvc.js"];?>
<?php $title = "Projects";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "../index.php",
        "active" => false,
    ],
    [
        "name" => "Projects",
        "link" => "",
        "active" => true,
    ],
];
?>

<?php ob_start()?>
<div class="container h-100 d-block flex-column d-sm-flex container px-0 px-sm-3 h-100" id="mainProjectPanel">
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>