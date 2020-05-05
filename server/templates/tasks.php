<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "tasks.css"];?>
<?php $optionalScripts = ["js/DashboardMvc.js"];?>
<?php $title = $viewParams["title"] . " | Tablero - " . $viewParams["dashboardTitle"];?>
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
        "icon" => "home",
    ],
    [
        "name" => "Your projects",
        "link" => "/daw/projects/",
        "active" => false,
        "icon" => "folder",
    ],
    [
        "name" => $viewParams["title"],
        "link" => "/daw/projects/id/" . $viewParams["id"] . "/dashboards/",
        "active" => false,
        "icon" => "clipboard",
    ],
    [
        "name" => $viewParams["dashboardTitle"],
        "link" => "/daw/projects/id/" . $viewParams["id"] . "/tasklist/id/" . $viewParams["dashboardTitle"],
        "active" => true,
        "icon" => "columns",
    ],
];
?>

<?php ob_start()?>

<div class="row dashboardTopBar m-2 d-flex justify-content-space-around">
    <div class="dashboardTitleContainer align-self-center rounded grey darken-4 p-2 px-3">
        <div class="dashboardTitle align-self-center text-white"><?php echo $viewParams["dashboardTitle"]; ?></div>
    </div>
    <div class="btn btn-sm btn-danger dashboardBtnDelete align-self-center">Delete dashboard</div>
    <div class="md-form input-group col col-md-4 my-2 m-0 p-0">
        <input type="search" class="form-control text-white grey darken-4 pl-2 rounded-0" name="dashboardSearch"
            id="dashboardSearch" placeholder="Search...">
        <div class="input-group-append">
            <span class="btn btn-sm btn-primary m-0 input-group-text md-addon">Search</span>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>