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
        "name" => "ProjectName",
        "link" => "./project/id/name/tasks/",
        "active" => false,
    ],
    [
        "name" => "TaskName",
        "link" => "./project/id/name/tasks/taskname",
        "active" => true,
    ],
];
?>

<?php ob_start()?>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>