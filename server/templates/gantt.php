<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css"];?>
<?php $optionalScripts = ["js/GanttMvc.js"];?>
<?php $title = "ProjectName - Gantt";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "index.php",
        "active" => false,
    ],
    [
        "name" => "Projects",
        "link" => "./projects/",
        "active" => false,
    ],
    [
        "name" => "ProjectName",
        "link" => "./project/id/name/",
        "active" => false,
    ],
    [
        "name" => "Gantt",
        "link" => "./project/id/name/gantt/",
        "active" => true,
    ],
];
?>

<?php ob_start()?>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>