<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css"];?>
<?php $optionalScripts = ["js/project/ProjectsCrudMvc.js"];?>
<?php $title = "Proyectos";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php $currentPage = "Proyectos";?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Projects",
        "link" => Config::$EXECUTION_HOME_PATH . "projects",
        "active" => true,
        "icon" => "folder",
    ],
];
?>

<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<?php ob_start()?>

<div class="w-100 p-0">
    <div class="row py-5 m-0 projectHeader pr-sm-5">
        <style>
        .projectHeader {
            background-image: url(<?php echo Config::$EXECUTION_HOME_PATH; ?>"img/users/<?php echo $username; ?>/bg-<?php echo $username; ?>.png") !important;
        }
        </style>
        <div class="projectImageContainer mx-auto mx-sm-0">
            <img class="projectImage shadow mx-sm-5"
                src=<?php echo Config::$EXECUTION_HOME_PATH; ?>"img/users/<?php echo $username; ?>/<?php echo $username; ?>.png"
                alt="" width="200" height="200">
        </div>
        <div class="d-none d-sm-block projectDetails bg-dark rounded text-white col">
            <h1 class="projectTitle font-weight-bold">
                <?php echo $viewParams["profile"]["name"] . " " . $viewParams["profile"]["surname"]; ?></h1>

            <p class="projectCreatedBy mb-2"><a id="projectCreator"
                    href="http://<?php echo $viewParams["profile"]["website"]; ?>"
                    class="text-white"><?php echo $viewParams["profile"]["website"]; ?></a></p>

            <div class="md-form m-0 p-0">
                <textarea id="projectDescription" disabled="true"
                    class="md-textarea text-white form-control m-0 p-0 description"
                    rows="3"><?php echo $viewParams["profile"]["biography"]; ?></textarea>
            </div>

            <a href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"profile/<?php echo $username; ?>/" class="text-white">
                <span><i class="fa fa-eye"></i></span>&nbsp;Ver perfil</a>
            &nbsp;
            <a href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"profile/" class="text-white">
                <span><i class="fa fa-pencil"></i></span>&nbsp;Editar perfil </a>
        </div>
    </div>
    <div
        class="row tabs d-flex text-white justify-content-center justify-items-center align-content-center align-items-center shadow w-100 m-0 tabs">
        <div class="projectsCount ml-3">
            <span class="numberOfProjects">0</span>&nbsp;
            <span class="font-weight-bold">proyecto(s)</span>
        </div>
        <div class="btn-group projectsBtnFilters">
            <div class="projectsBtnBookmarked btn btn-sm btn-warning">Favorito</div>
            <div class="projectsBtnCreated btn btn-sm btn-success">Creado</div>
            <div class="projectsBtnShared btn btn-sm btn-primary">Compartido</div>
        </div>
        <div class="row w-auto mx-2">
            <p class="m-0 align-self-center text-white">Mostrar&nbsp;</p>
            <select class="custom-select bg-dark border-0 custom-select-sm align-self-center w-auto"
                id="selectNumberOfRows">
                <option value="1" class="d-block d-sm-none">2</option>
                <option value="1" class="d-none d-sm-block">1</option>
                <option value="2" class="d-block d-sm-none">4</option>
                <option value="2" class="d-none d-sm-block">2</option>
                <option value="3" class="d-block d-sm-none">6</option>
                <option value="3" class="d-none d-sm-block" selected>3</option>
                <option value="4" class="d-block d-sm-none">8</option>
                <option value="4" class="d-none d-sm-block">4</option>
                <option value="5" class="d-block d-sm-none">10</option>
                <option value="5" class="d-none d-sm-block">5</option>
            </select>
            <p class="m-0 align-self-center text-white">&nbsp;fila(s).</p>
        </div>
        <div class="btn btn-success btn-sm projectBtnAdd">+ Añadir</div>
        <div class="md-form input-group col-12 col-sm my-2">
            <input type="search" class="form-control text-white pl-0 rounded-0" name="projectSearch" id="projectSearch"
                placeholder="Buscar...">
            <div class="input-group-append">
                <span class="btn btn-sm btn-primary m-0 input-group-text md-addon">
                    <span class="d-none d-sm-inline-block">Buscar&nbsp;</span>
                    <span><i class="fa fa-search fa-2x"></i></span>
                </span>
            </div>
        </div>
    </div>
    <div class="tabContentContainer m-0 mx-auto px-2 pt-2">
        <div class="projectsContainer text-white text-center col-md-10 m-0 mx-auto">
        </div>
        <div class="row d-flex justify-content-center py-3">
            <nav aria-label="Page navigation example" class="bg-transparent">
                <ul class="pagination pg-blue mb-0">
                    <li class="page-item nav-previous">
                        <a class="page-link text-white" tabindex="-1">Anterior</a>
                    </li>
                    <li class="page-item nav-next">
                        <a class="page-link text-white">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>