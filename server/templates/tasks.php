<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "tasks.css"];?>
<?php $optionalScripts = ["js/DashboardMvc.js"];?>
<?php $title = "ProjectName - TaskName - Task";?>
<?php $mainClasses = "h-100";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
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
        "link" => "/daw/projects/id/" . $viewParams["id"] . "/dashboards/",
        "active" => false,
    ],
    [
        "name" => $viewParams["dashboardTitle"],
        "link" => "/daw/projects/id/" . $viewParams["id"] . "/tasklist/id/" . $viewParams["dashboardTitle"],
        "active" => true,
    ],
];
?>

<?php ob_start()?>

<div class="row dashboardTopBar m-2 d-flex justify-content-space-between">
    <div class="dashboardTitleContainer align-self-center rounded grey darken-4 p-2 px-3">
        <div class="dashboardTitle align-self-center text-white"><?php echo $viewParams["dashboardTitle"]; ?></div>
    </div>
    <div class="md-form input-group col col-md-4 my-2">
        <input type="search" class="form-control text-white grey darken-4 pl-2 rounded-0" name="dashboardSearch"
            id="dashboardSearch" placeholder="Search...">
        <div class="input-group-append">
            <span class="btn btn-sm btn-primary m-0 input-group-text md-addon">Search</span>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>