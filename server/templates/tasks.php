<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "tasks.css"];?>
<?php $optionalScripts = ["js/DashboardMvc.js"];?>
<?php $title = $viewParams["title"] . " | Tablero - " . $viewParams["dashboardTitle"];?>
<?php $mainClasses = "h-100 overflow-hidden";?>
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
        "link" => "/daw/projects/id/" . $viewParams["id"] . "/",
        "active" => false,
        "icon" => "clipboard",
    ],
    [
        "name" => "Tableros",
        "link" => "/daw/projects/id/" . $viewParams["id"] . "/dashboards/",
        "active" => false,
        "icon" => "columns",
    ],
    [
        "name" => $viewParams["dashboardTitle"],
        "link" => "/daw/projects/id/" . $viewParams["id"] . "/dashboards/" . $viewParams["dashboardTitle"],
        "active" => true,
        "icon" => "columns",
    ],
];
?>

<?php ob_start()?>

<style>
main {
    background-image: url('/daw/img/projects/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $viewParams["dashboardTitle"]; ?>/bg.png') !important;
}
</style>

<div class="row dashboardTopBar m-2 d-flex justify-content-space-around">
    <div class="dashboardTitleContainer align-self-center rounded grey darken-4 p-2 px-3">
        <div class="dashboardTitle align-self-center text-white"><?php echo $viewParams["dashboardTitle"]; ?></div>
    </div>
    <button class="btn btn-dark align-self-center btn-sm m-0 mx-2 dropdown-toggle p-2" type="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="fa fa-ellipsis-v"></div>
    </button>

    <div class="dropdown-menu">
        <a class="dropdown-item"
            href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $viewParams["dashboardTitle"]; ?> /change-image/">Cambiar
            imagen</a>
        <a class="dropdown-item" id="downloadJSONcontent"
            href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $viewParams["dashboardTitle"]; ?> /json/">Descargar
            contenido</a>
        <div class="dropdown-divider"></div>
    </div>
    <?php if (Sessions::getInstance()->getSession("access") >= Config::$ACCESS_LEVEL_ADMIN): ?>
    <div class="btn btn-sm btn-danger dashboardBtnDelete align-self-center">Borrar tablero</div>
    <?php endif;?>
    <div class="md-form input-group col-md-4 my-2 m-0 p-0">
        <input type="search" class="form-control text-white grey darken-4 pl-2 rounded-0" name="dashboardSearch"
            id="dashboardSearch" placeholder="Search...">
        <div class="input-group-append">
            <span class="btn btn-sm btn-primary m-0 input-group-text md-addon"><span><i
                        class="fa fa-search"></i></span>Search</span>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>