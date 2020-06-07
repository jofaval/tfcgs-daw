<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css"];?>
<?php $optionalScripts = ["js/project/GanttMvc.js"];?>
<?php $title = $viewParams["ganttTitle"];?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Tus proyectos",
        "link" => Config::$EXECUTION_HOME_PATH . "projects/",
        "active" => false,
        "icon" => "folder",
    ],
    [
        "name" => $viewParams["title"],
        "link" => Config::$EXECUTION_HOME_PATH . "projects/id/" . $viewParams["id"] . "/",
        "active" => false,
        "icon" => "clipboard",
    ],
    [
        "name" => "Gantts",
        "link" => Config::$EXECUTION_HOME_PATH . "projects/id/" . $viewParams["id"] . "/gantts/",
        "active" => false,
        "icon" => "list",
    ],
    [
        "name" => $viewParams["ganttTitle"],
        "link" => Config::$EXECUTION_HOME_PATH . "projects/id/" . $viewParams["id"] . "/gantts/" . $viewParams["ganttTitle"],
        "active" => true,
        "icon" => "table",
    ],
];
?>
<?php $currentPage = "Proyectos";?>

<?php ob_start()?>

<style>
main {
    background-image: url('<?php echo Config::$EXECUTION_HOME_PATH; ?>img/projects/<?php echo $viewParams["id"]; ?>/gantts/<?php echo $viewParams["ganttTitle"]; ?>/bg.png') !important;
}
</style>

<?php $contenido = ob_get_clean()?>

<?php include_once SystemPaths::SERVER_PROJECT_PATH . '/layoutProject.php'?>