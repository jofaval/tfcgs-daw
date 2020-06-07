<!--Page configuration-->
<?php $optionalCSS = ["style.css"];?>
<?php $optionalScripts = ["js/MVCadmin.js"];?>
<?php $title = "Admin";?>
<?php $showFooter = false;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php $currentPage = "Admin";?>
<?php $mainClasses = "overflow-hidden";?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Admin",
        "link" => Config::$EXECUTION_HOME_PATH . "admin/",
        "active" => true,
        "icon" => "cogs",
    ],
];
?>

<?php ob_start()?>
<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getsession("username");?>

<div class="h-100 row m-0 p-0 container-fluid">
    <div class="h-100 bg-dark" id="sidebar">
        <div class="profileInfo">
            <div class="m-auto">
                <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/<?php echo $username; ?>/"
                    class="profileAdminCard text-light row col-12 px-0 min-width-10 col-sm m-0 bg-grey"
                    style="min-width: 22.5rem !important;">
                    <img src="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/users/<?php echo $username; ?>/<?php echo $username; ?>.png"
                        class="opacity-60 object-fit-cover w-100 h-100 position-absolute" />
                    <div
                        class="row profileAdminCardDetails pl-3 py-5 z-index-overlap flex-wrap center-elements w-100 m-0">
                        <h5
                            class="profileAdminCardTitle text-center text-light max-text-10 text-overflow-ellipsis overflow-hidden m-0 font-weight-bold">
                            <?php echo $username; ?></h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">
            <div class="card bg-transparent shadow-none">
                <div class="card-header bg-white" role="tab" id="headingTwo1">
                    <a class="collapsed text-light" data-toggle="collapse" data-parent="#accordionEx1"
                        href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                        <h5 class="mb-0">
                            Rutas <i class="fa fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>
                <div id="collapseTwo1" class="collapse" role="tabpanel" aria-labelledby="headingTwo1"
                    data-parent="#accordionEx1">
                    <div class="card-body grey darken-3 text-light">
                        <?php $accordionElementTitle = "Añadir nueva ruta"?>
                        <?php $href = Config::$EXECUTION_HOME_PATH . "admin/new-route/"?>
                        <?php include SystemPaths::SERVER_COMPONENTS_PATH . '/accordionElement.php'?>

                        <?php $accordionElementTitle = "Cambiar nivel de acceso"?>
                        <?php $href = Config::$EXECUTION_HOME_PATH . "admin/access-level/"?>
                        <?php include SystemPaths::SERVER_COMPONENTS_PATH . '/accordionElement.php'?>

                    </div>
                </div>
            </div>
            <div class="card bg-transparent shadow-none">
                <div class="card-header bg-white" role="tab" id="headingTwo2">
                    <a class="collapsed text-light" data-toggle="collapse" data-parent="#accordionEx1"
                        href="#collapseTwo21" aria-expanded="false" aria-controls="collapseTwo21">
                        <h5 class="mb-0">
                            Codificación <i class="fa fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>
                <div id="collapseTwo21" class="collapse" role="tabpanel" aria-labelledby="headingTwo21"
                    data-parent="#accordionEx1">
                    <div class="card-body grey darken-3 text-light">
                        <?php $accordionElementTitle = "Panel de configuración de POPOs"?>
                        <?php $href = Config::$EXECUTION_HOME_PATH . "admin/popo/"?>
                        <?php include SystemPaths::SERVER_COMPONENTS_PATH . '/accordionElement.php'?>

                        <?php $accordionElementTitle = "Ventana de testing"?>
                        <?php $href = Config::$EXECUTION_HOME_PATH . "admin/testing/"?>
                        <?php include SystemPaths::SERVER_COMPONENTS_PATH . '/accordionElement.php'?>

                        <?php $accordionElementTitle = "Descargarse script de SQL"?>
                        <?php $href = Config::$EXECUTION_HOME_PATH . "admin/download-database/"?>
                        <?php include SystemPaths::SERVER_COMPONENTS_PATH . '/accordionElement.php'?>

                        <?php $accordionElementTitle = "Editor de templates"?>
                        <?php $href = Config::$EXECUTION_HOME_PATH . "admin/layoutEditor/"?>
                        <?php include SystemPaths::SERVER_COMPONENTS_PATH . '/accordionElement.php'?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid m-1 h-100 overflow-auto col-12 col-sm">
        <?php $mysqli = new mysqli(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);?>
        <?php $mysqli->select_db(Config::$mvc_bd_nombre);?>
        <?php $mysqli->query("SET NAMES 'utf8'");?>
        <?php $queryTables = $mysqli->query('SHOW TABLES');?>
        <?php while ($row = $queryTables->fetch_row()) {?>
        <?php $target_tables[] = $row[0];?>
        <?php }?>
        <div class="form-row p-3 mt-2 mb-1 rounded bg-dark">
            <div class="md-form mx-3 input-group mb-4">
                <input type="text" class="form-control text-light" autocomplete="off" name="searchTable"
                    id="searchTable" placeholder="" aria-describedby="btnSearch">
                <label for="searchTable">Tabla</label>
                <div class="input-group-append">
                    <span class="input-group-text md-addon btn btn-sm btn-primary" id="btnSearch">
                        <span><i class="fa fa-search"></i></span>
                        &nbsp;
                        Buscar
                    </span>
                </div>
            </div>
        </div>
        <?php $randomIndex = 0?>
        <div class="row flex-wrap center-elements">
            <?php foreach ($target_tables as $tableName): ?>
            <?php $randomIndex++?>
            <?php include SystemPaths::SERVER_CARDS_PATH . "/dbTableCard.php";?>
            <?php endforeach;?>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once SystemPaths::SERVER_TEMPLATES_PATH . '/layout.php'?>