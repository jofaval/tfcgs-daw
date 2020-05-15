<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css", "project.css"];?>
<?php $optionalScripts = [];?>
<?php $title = "Tareas asginadas";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php $currentPage = "Proyectos";?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "/daw/client/",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Tus proyectos",
        "link" => "/daw/client/projects/",
        "active" => false,
        "icon" => "folder",
    ],
    [
        "name" => $viewParams["title"],
        "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/",
        "active" => false,
        "icon" => "clipboard",
    ],
    [
        "name" => "Tareas asignadas",
        "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/assigned-tasks/",
        "active" => true,
        "icon" => "tasks",
    ],
];
?>

<?php ob_start()?>

<?php $projectData = $viewParams["projectData"];?>

<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>
<?php $controller = new Controller();?>

<div class="w-100 p-0">
    <style>
    .projectHeader {
        background-image: url("/daw/client/img/projects/<?php echo $viewParams["id"]; ?>/bg.png") !important;
    }
    </style>
    <div class="row py-5 projectHeader m-0 pr-sm-5">
        <div class="projectImageContainer mx-auto mx-sm-0">
            <img class="projectImage mx-sm-5 shadow"
                src="/daw/client/img/projects/<?php echo $viewParams["id"]; ?>/profile.png" alt="" width="200" height="200">
        </div>
        <div class="d-none d-sm-block projectDetails bg-dark rounded text-white col">
            <h1 class="projectTitle font-weight-bold"><?php echo $projectData["projectTitle"]; ?></h1>
            <p class="projectCreatedBy mb-2">creado por <a
                    href="/daw/client/profile/<?php echo $projectData["projectCreatorUsername"]; ?>/" id="projectCreator"
                    class="font-weight-bold text-white"><?php echo $projectData["projectCreator"]; ?></a></p>

            <div class="md-form m-0 p-0">
                <textarea id="projectDescription" disabled="true"
                    class="md-textarea text-white form-control m-0 p-0 description"
                    rows="3"><?php echo $projectData["projectDescription"]; ?></textarea>
            </div>

            <a href="/daw/client/projects/id/<?php echo $viewParams["id"] ?>/details/" class="">
                Modificar información del proyecto...<span><i class="fa fa-pencil"></i></span>
            </a>
        </div>
    </div>
    <div class="row tabs shadow w-100 m-0 text-white">
        <a href="/daw/client/projects/id/<?php echo $viewParams["id"]; ?>/overview/"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "overview" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-cogs"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">General</span></a>
        <a href="/daw/client/projects/id/<?php echo $viewParams["id"]; ?>/dashboards/"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "dashboards" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-columns"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Tableros</span></a>
        <a href="/daw/client/projects/id/<?php echo $viewParams["id"]; ?>/diary/"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "diary" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-book"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Diario</span></a>
        <a href="/daw/client/projects/id/<?php echo $viewParams["id"]; ?>/collaborators/"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "collaborators" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-users"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Colaboradores</span></a>
        <a href="/daw/client/projects/id/<?php echo $viewParams["id"]; ?>/details/"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "details" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-info-circle"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Detalles</span></a>
    </div>
    <div class="row tabContentContainer m-0 px-2">
        <div class="w-100 h-100 tabContent min-height-40 container-fluid text-white p-0 p-sm-3 d-block">
            <div class="row">
                <div class="col-sm d-flex flex-column">
                    <div class="accordion md-accordion" id="asignedByYouUnfinished" role="tablist"
                        aria-multiselectable="true">
                        <div class="accordionContainer">
                            <div class="card-header bg-dark" role="tab" id="headingTwo1">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#asignedByYouUnfinished" href="#assignedByYouUnfinishedCollapse"
                                    aria-expanded="false" aria-controls="assignedByYouUnfinishedCollapse">
                                    <h5 class="mb-0">
                                        Asignadas por tí (sin terminar) <i class="fa fa-angle-down rotate-icon"></i>
                                    </h5>
                                </a>
                            </div>
                            <div id="assignedByYouUnfinishedCollapse" class="collapse" role="tabpanel"
                                aria-labelledby="headingTwo1" data-parent="#asignedByYouUnfinished">
                                <div class="card-body max-height-20 overflow-y-auto">
                                    <?php foreach ($viewParams["assignedTasksByYouUnfinished"] as $assignedTask):
    $assginedByUsername = $controller->getUsernameFromClientId($assignedTask["assigned_by"]);
    $assginedtoUsername = $controller->getUsernameFromClientId($assignedTask["assigned_to"]);
    require __DIR__ . "/../components/cards/assignedCard.php";
endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm d-flex flex-column">
                    <div class="accordion md-accordion" id="assignedByYouFinished" role="tablist"
                        aria-multiselectable="true">
                        <div class="accordionContainer">
                            <div class="card-header bg-dark" role="tab" id="headingTwo1">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#assignedByYouFinished" href="#assignedByYouFinishedCollapse"
                                    aria-expanded="false" aria-controls="assignedByYouFinishedCollapse">
                                    <h5 class="mb-0">
                                        Asignadas por tí (terminadas) <i class="fa fa-angle-down rotate-icon"></i>
                                    </h5>
                                </a>
                            </div>
                            <div id="assignedByYouFinishedCollapse" class="collapse" role="tabpanel"
                                aria-labelledby="headingTwo1" data-parent="#assignedByYouFinished">
                                <div class="card-body max-height-20 overflow-y-auto">
                                    <?php foreach ($viewParams["assignedTasksByYouFinished"] as $assignedTask):
    $assginedByUsername = $controller->getUsernameFromClientId($assignedTask["assigned_by"]);
    $assginedtoUsername = $controller->getUsernameFromClientId($assignedTask["assigned_to"]);
    require __DIR__ . "/../components/cards/assignedCard.php";
endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm d-flex flex-column">
                    <div class="accordion md-accordion" id="assignedToYouUnfinsihed" role="tablist"
                        aria-multiselectable="true">
                        <div class="accordionContainer">
                            <div class="card-header bg-dark" role="tab" id="headingTwo1">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#assignedToYouUnfinsihed" href="#assignedToYouUnfinsihedCollapse"
                                    aria-expanded="false" aria-controls="assignedToYouUnfinsihedCollapse">
                                    <h5 class="mb-0">
                                        Asignadas a tí (sin terminar) <i class="fa fa-angle-down rotate-icon"></i>
                                    </h5>
                                </a>
                            </div>
                            <div id="assignedToYouUnfinsihedCollapse" class="collapse" role="tabpanel"
                                aria-labelledby="headingTwo1" data-parent="#assignedToYouUnfinsihed">
                                <div class="card-body max-height-20 overflow-y-auto">
                                    <?php foreach ($viewParams["assignedTasksToYouUnfinished"] as $assignedTask):
    $assginedByUsername = $controller->getUsernameFromClientId($assignedTask["assigned_by"]);
    $assginedtoUsername = $controller->getUsernameFromClientId($assignedTask["assigned_to"]);
    require __DIR__ . "/../components/cards/assignedCard.php";
endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm d-flex flex-column">
                    <div class="accordion md-accordion" id="assignedToYouFinsihed" role="tablist"
                        aria-multiselectable="true">
                        <div class="accordionContainer">
                            <div class="card-header bg-dark" role="tab" id="headingTwo1">
                                <a class="collapsed text-white" data-toggle="collapse"
                                    data-parent="#assignedToYouFinsihed" href="#assignedToYouFinsihedCollapse"
                                    aria-expanded="false" aria-controls="assignedToYouFinsihedCollapse">
                                    <h5 class="mb-0">
                                        Asignadas a tí (terminadas) <i class="fa fa-angle-down rotate-icon"></i>
                                    </h5>
                                </a>
                            </div>
                            <div id="assignedToYouFinsihedCollapse" class="collapse" role="tabpanel"
                                aria-labelledby="headingTwo1" data-parent="#assignedToYouFinsihed">
                                <div class="card-body max-height-20 overflow-y-auto">
                                    <?php foreach ($viewParams["assignedTasksToYouFinished"] as $assignedTask):
    $assginedByUsername = $controller->getUsernameFromClientId($assignedTask["assigned_by"]);
    $assginedtoUsername = $controller->getUsernameFromClientId($assignedTask["assigned_to"]);
    require __DIR__ . "/../components/cards/assignedCard.php";
endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>