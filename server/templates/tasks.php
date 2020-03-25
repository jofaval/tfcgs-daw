<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "tasks.css"];?>
<?php $optionalScripts = ["js/TaskMvc.js"];?>
<?php $title = "ProjectName - TaskName - Task";?>
<?php $mainClasses = "h-100";?>
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
        "link" => "./project/id/name/tasklist/id/" . $viewParams["secondaryId"],
        "active" => true,
    ],
];
?>

<?php ob_start()?>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>