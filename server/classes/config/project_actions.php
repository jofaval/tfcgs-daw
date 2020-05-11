<?php

$viewParams["actionGroups"] = [
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