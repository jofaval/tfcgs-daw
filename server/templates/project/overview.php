<?php
$modelInstance = Model::getInstance();
$projectNumbers = $modelInstance->getProjectNumbers($viewParams["id"]);
?>

<div class="w-100 h-100 tabContent container-fluid p-0 p-sm-3 d-block" id="tabContent1">
    <div class="w-100 display-none display-sm-block p-2 text-white d-flex justify-content-start">
        <div class="collaborators mx-2">
            <span id="numberOfCollaborators"><?php echo $projectNumbers["numberOfCollaborators"]; ?></span>
            <span class="font-weight-bold">
                <a class=""><i class="fa fa-lg fa-users"></i></a>
                <span class="d-none d-sm-inline-block">colaborador(es)</span>
            </span>
        </div>
        <div class="dashboards mx-2">
            <span id="numberOfDashboards"><?php echo $projectNumbers["numberOfDashboards"]; ?></span>
            <span class="font-weight-bold">
                <a class=""><i class="fa fa-lg fa-columns"></i></a>
                <span class="d-none d-sm-inline-block">tablero(s)</span>
            </span>
        </div>
        <div class="activeTime mx-2">
            <?php echo $projectData["projectCreationDate"]; ?>
        </div>
    </div>
    <div class="row m-0 p-0">
        <div class="col-sm p-0">
            <?php $actionGroups = [
    "Tablero" => [
        "access" => Config::$ACCESS_LEVEL_GUEST,
        "actions" => [
            [
                "name" => "Añadir tablero",
                "link" => "/daw/projects/id/" . $viewParams["id"] . "/dashboards/",
                "icon" => "plus",
                "id" => "AddDashboard",
                "color" => "blue",
                "access" => Config::$ACCESS_LEVEL_ADMIN,
            ],
            [
                "name" => "Ver tablero",
                "link" => "/daw/projects/id/" . $viewParams["id"] . "/dashboards/",
                "icon" => "eye",
                "id" => "ViewDashboard",
                "color" => "blue",
                "access" => Config::$ACCESS_LEVEL_GUEST,
            ],
            [
                "name" => "Ver tareas asignadas",
                "link" => "/daw/projects/id/" . $viewParams["id"] . "/overview/assigned-tasks/",
                "icon" => "tasks",
                "id" => "DashboardTasks",
                "color" => "blue",
                "access" => Config::$ACCESS_LEVEL_GUEST,
            ]],
    ],
    "Diario" => [
        "access" => Config::$ACCESS_LEVEL_GUEST,
        "actions" => [
            [
                "name" => "Ver diario de hoy",
                "link" => "/daw/projects/id/" . $viewParams["id"] . "/diary/date/" . $viewParams["diaryDate"] . "/",
                "icon" => "calendar-check-o",
                "id" => "TodayDiary",
                "color" => "green",
                "access" => Config::$ACCESS_LEVEL_GUEST,
            ],
            [
                "name" => "Ir a selección de fecha",
                "link" => "/daw/projects/id/" . $viewParams["id"] . "/diary/",
                "icon" => "calendar",
                "id" => "Diary",
                "color" => "green",
                "access" => Config::$ACCESS_LEVEL_GUEST,
            ]],
    ],
    "Proyecto" => [
        "access" => Config::$ACCESS_LEVEL_ADMIN,
        "actions" => [
            [
                "name" => "Añadir colaborador",
                "link" => "",
                "icon" => "user-plus",
                "id" => "AddCollaborator",
                "color" =>
                "red",
                "access" => Config::$ACCESS_LEVEL_USER,
            ],
            [
                "name" => "Eliminar colaborador",
                "link" => "",
                "icon" => "user-times",
                "id" => "RemoveCollaborator",
                "color" => "red",
                "access" => Config::$ACCESS_LEVEL_ADMIN,
            ],
            [
                "name" => "Cambiar rol colaborador",
                "link" => "",
                "icon" => "user-secret",
                "id" =>
                "ChangeRoleCollaborator",
                "color" => "red",
                "access" => Config::$ACCESS_LEVEL_ADMIN,
            ],
            [
                "name" => "Eliminar proyecto",
                "link" => "",
                "icon" => "times",
                "id" => "DeleteProject",
                "color" => "red",
                "access" => Config::$ACCESS_LEVEL_ADMIN,
            ],
        ]],
];

$userAccessLevel = Sessions::getInstance()->getSession("access");

foreach ($actionGroups as $actionGroupTitle => $actionGroupDetails):
    if ($userAccessLevel < $actionGroupDetails["access"]): continue;endif;
    ?> <div class="actionsGroup my-3">
                <h4 class="actionsTitle text-white"><?php echo $actionGroupTitle; ?></h4>
                <div class="actionsButton d-flex justify-content-space-between flex-wrap">
                    <?php
    $actionGroup = $actionGroupDetails["actions"];
    foreach ($actionGroup as $action):
        if ($userAccessLevel >= $action["access"]):
        ?>
                    <a href="<?php echo $action["link"]; ?>"
                        class="action cursor-pointer <?php echo $action["color"]; ?> m-2"
                        id="action<?php echo $action["id"]; ?>">
                        <div class="actionIcon h-75 text-white p-3">
                            <i class="fa fa-<?php echo $action["icon"]; ?>"></i>
                        </div>
                        <div class="actionTitle h-25 text-center d-flex justify-content-center text-white bg-dark">
                            <p class="align-self-center fixed-line-spacing mb-0"><?php echo $action["name"]; ?></p>
                        </div>
                    </a>
                    <?php
    endif;
endforeach;
?>
                </div>
            </div> <?php
endforeach;
?>
        </div>
        <div class="col-sm p-0 mx-3 mx-sm-0">
            <div class="row text-white p-0 m-0">
                <h4 class="h4 text-white">Creado recientemente</h4>
                <div class="recentlyCreated text-dark">
                    <div class="card w-100">
                        <div class="card-body p-0">
                            <p class="card-text my-auto d-inline">Test</p>
                            <a href="#" class="btn btn-primary float-right">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card w-100">
                        <div class="card-body p-0">
                            <p class="card-text my-auto d-inline">Test</p>
                            <a href="#" class="btn btn-primary float-right">Go somewhere</a>
                        </div>
                    </div>
                    <div class="card w-100">
                        <div class="card-body p-0">
                            <p class="card-text my-auto d-inline">Test</p>
                            <a href="#" class="btn btn-primary float-right">Go somewhere</a>
                        </div>
                    </div>
                    <span class="btn btn-primary w-100">Ver todos</span>
                </div>
            </div>
            <br>
            <div class="row text-white p-0 m-0">
                <h4 class="h4 text-white">Invitados recientemente</h4>
                <div class="recentlyInvited text-dark collaboratorsContainer"></div>
            </div>
        </div>
    </div>
</div>