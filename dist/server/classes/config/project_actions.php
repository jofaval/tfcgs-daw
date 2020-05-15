<?php

$viewParams["actionGroups"] = [
    "Tablero" => [
        "access" => Config::$PROJECT_ACCESS_GUEST,
        "actions" => [
            [
                "name" => "Añadir tablero",
                "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/dashboards/",
                "icon" => "plus",
                "id" => "AddDashboard",
                "color" => "blue",
                "access" => Config::$PROJECT_ACCESS_MANAGER,
            ],
            [
                "name" => "Ver tablero",
                "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/dashboards/",
                "icon" => "eye",
                "id" => "ViewDashboard",
                "color" => "blue",
                "access" => Config::$PROJECT_ACCESS_WORKER,
            ],
            [
                "name" => "Ver tareas asignadas",
                "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/overview/assigned-tasks/",
                "icon" => "tasks",
                "id" => "DashboardTasks",
                "color" => "blue",
                "access" => Config::$PROJECT_ACCESS_WORKER,
            ]],
    ],
    "Diario" => [
        "access" => Config::$PROJECT_ACCESS_WORKER,
        "actions" => [
            [
                "name" => "Ver diario de hoy",
                "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/diary/date/" . $viewParams["diaryDate"] . "/",
                "icon" => "calendar-check-o",
                "id" => "TodayDiary",
                "color" => "green",
                "access" => Config::$PROJECT_ACCESS_WORKER,
            ],
            [
                "name" => "Ir a selección de fecha",
                "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/diary/",
                "icon" => "calendar",
                "id" => "Diary",
                "color" => "green",
                "access" => Config::$PROJECT_ACCESS_WORKER,
            ]],
    ],
    "Proyecto" => [
        "access" => Config::$PROJECT_ACCESS_MANAGER,
        "actions" => [
            [
                "name" => "Añadir colaborador",
                "link" => "",
                "icon" => "user-plus",
                "id" => "AddCollaborator",
                "color" =>
                "red",
                "access" => Config::$PROJECT_ACCESS_MANAGER,
            ],
            [
                "name" => "Eliminar colaborador",
                "link" => "",
                "icon" => "user-times",
                "id" => "RemoveCollaborator",
                "color" => "red",
                "access" => Config::$PROJECT_ACCESS_ADMIN,
            ],
            [
                "name" => "Cambiar rol colaborador",
                "link" => "",
                "icon" => "user-secret",
                "id" =>
                "ChangeRoleCollaborator",
                "color" => "red",
                "access" => Config::$PROJECT_ACCESS_ADMIN,
            ],
            [
                "name" => "Eliminar proyecto",
                "link" => "",
                "icon" => "times",
                "id" => "DeleteProject",
                "color" => "red",
                "access" => Config::$PROJECT_ACCESS_CREATOR,
            ],
        ]],
];
