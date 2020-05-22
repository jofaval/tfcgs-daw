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
                <a href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"profile/<?php echo $username; ?>/"
                    class="profileAdminCard text-dark row col-12 px-0 col-sm m-0 bg-grey">
                    <img src=<?php echo Config::$EXECUTION_HOME_PATH; ?>"img/users/<?php echo $username; ?>/<?php echo $username; ?>.png"
                        alt=""
                        class="profileAdminCardBgImg object-fit-cover brightness-50 position-absolute w-100 h-100 z-index">
                    <div
                        class="row profileAdminCardDetails pl-3 py-5 z-index-overlap flex-wrap center-elements w-100 m-0">
                        <h5
                            class="profileAdminCardTitle text-center text-white max-text-10 text-overflow-ellipsis overflow-hidden m-0 font-weight-bold">
                            <?php echo $username; ?></h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">
            <div class="card bg-transparent shadow-none">
                <div class="card-header bg-dark" role="tab" id="headingTwo1">
                    <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordionEx1"
                        href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                        <h5 class="mb-0">
                            Rutas <i class="fa fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>
                <div id="collapseTwo1" class="collapse" role="tabpanel" aria-labelledby="headingTwo1"
                    data-parent="#accordionEx1">
                    <div class="card-body rgba-black-light text-white">
                        <div class="card-header">
                            <a target="_blank" href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"admin/new-route/">
                                <h5 class="mb-0 text-white">
                                    Añadir nueva ruta
                                </h5>
                            </a>
                        </div>
                        <div class="card-header">
                            <a target="_blank" href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"admin/access-level/">
                                <h5 class="mb-0 text-white">
                                    Cambiar nivel de acceso
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-transparent shadow-none">
                <div class="card-header bg-dark" role="tab" id="headingTwo2">
                    <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordionEx1"
                        href="#collapseTwo21" aria-expanded="false" aria-controls="collapseTwo21">
                        <h5 class="mb-0">
                            Codificación <i class="fa fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>
                <div id="collapseTwo21" class="collapse" role="tabpanel" aria-labelledby="headingTwo21"
                    data-parent="#accordionEx1">
                    <div class="card-body rgba-black-light text-white">
                        <div class="card-header">
                            <a target="_blank" href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"admin/popo/">
                                <h5 class="mb-0 text-white">
                                    Panel de configuración de POPOs
                                </h5>
                            </a>
                        </div>
                        <div class="card-header">
                            <a target="_blank" href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"admin/testing/">
                                <h5 class="mb-0 text-white">
                                    Ventana de testing
                                </h5>
                            </a>
                        </div>
                        <div class="card-header">
                            <a target="_blank"
                                href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"admin/download-database/">
                                <h5 class="mb-0 text-white">
                                    Descargarse script de SQL
                                </h5>
                            </a>
                        </div>
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
                <input type="text" class="form-control text-white" autocomplete="off" name="searchTable"
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
            <?php include __DIR__ . "/../components/cards/dbTableCard.php";?>
            <?php endforeach;?>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>