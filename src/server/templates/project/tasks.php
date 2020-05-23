<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "tasks.css"];?>
<?php $optionalScripts = ["js/DashboardMvc.js", "webcomponents/UserSearchInput.js", "webcomponents/TimeFromMoment.js"];?>
<?php $title = $viewParams["dashboardTitle"];?>
<?php $mainClasses = "h-100 overflow-hidden";?>
<?php $showFooter = false;?>
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
        "name" => "Tableros",
        "link" => Config::$EXECUTION_HOME_PATH . "projects/id/" . $viewParams["id"] . "/dashboards/",
        "active" => false,
        "icon" => "columns",
    ],
    [
        "name" => $viewParams["dashboardTitle"],
        "link" => Config::$EXECUTION_HOME_PATH . "projects/id/" . $viewParams["id"] . "/dashboards/" . $viewParams["dashboardTitle"],
        "active" => true,
        "icon" => "columns",
    ],
];
?>

<?php ob_start()?>

<style>
main {
    background-image: url(<?php echo Config::$EXECUTION_HOME_PATH; ?>'img/projects/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $viewParams["dashboardTitle"]; ?>/bg.png') !important;
}
</style>

<div class="row dashboardTopBar m-2 d-flex justify-content-space-around">
    <div class="dashboardTitleContainer align-self-center rounded bg-dark p-2 px-3">
        <div class="dashboardTitle align-self-center"><?php echo $viewParams["dashboardTitle"]; ?></div>
    </div>
    <button class="btn btn-white align-self-center btn-sm m-0 mx-2 dropdown-toggle p-2" type="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="fa fa-ellipsis-v"></div>
    </button>

    <div class="dropdown-menu">
        <a class="dropdown-item" id="downloadJSONcontent" href="<?php echo Config::$EXECUTION_HOME_PATH; ?>projects/id/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $viewParams["dashboardTitle"]; ?>
            /json/">Descargar
            contenido</a>
        <?php if ($viewParams["projectAccessLevel"] >= Config::$PROJECT_ACCESS_MANAGER): ?>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo Config::$EXECUTION_HOME_PATH; ?>projects/id/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $viewParams["dashboardTitle"]; ?>
            /change-image/">Cambiar
            imagen</a>
        <?php endif;?>
    </div>
    <?php if ($viewParams["projectAccessLevel"] >= Config::$PROJECT_ACCESS_ADMIN): ?>
    <div class="btn btn-sm btn-danger dashboardBtnDelete align-self-center">Borrar tablero</div>
    <?php endif;?>
    <div class="md-form input-group col-md-4 my-2 m-0 p-0">
        <input type="search" class="form-control bg-dark pl-2 rounded-0" name="dashboardSearch" id="dashboardSearch"
            placeholder="Buscar...">
        <div class="input-group-append">
            <span class="btn btn-sm btn-primary m-0 input-group-text md-addon"><span><i
                        class="fa fa-search"></i></span>Buscar</span>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/layoutProject.php'?>