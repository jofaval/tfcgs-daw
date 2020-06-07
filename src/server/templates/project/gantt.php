<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css"];?>
<?php $optionalScripts = ["js/project/ProjectGanttMvc.js"];?>
<?php $title = "ProjectName - Gantt";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "/daw/",
        "active" => false,
    ],
    [
        "name" => "Your projects",
        "link" => "/daw/projects/",
        "active" => false,
    ],
    [
        "name" => $viewParams["title"],
        "link" => "./project/id/" . $viewParams["id"] . "/",
        "active" => false,
    ],
    [
        "name" => $viewParams["elementName"],
        "link" => "./project/id/name/gantt/id/" . $viewParams["secondaryId"],
        "active" => true,
    ],
];
?>
<?php $currentPage = "Proyectos";?>

<?php ob_start()?>

<?php $contenido = ob_get_clean()?>

<?php include_once SystemPaths::SERVER_PROJECT_PATH . '/layoutProject.php'?>