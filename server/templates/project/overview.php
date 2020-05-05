<div class="w-100 h-100 tabContent d-block" id="tabContent1">
    <div class="w-100 display-none display-sm-block p-2 text-white d-flex justify-content-start">
        <div class="collaborators mx-2">
            <span id="numberOfCollaborators">24</span>
            <span class="font-weight-bold">
                <a class=""><i class="fa fa-lg fa-user"></i></a>
                <span class="d-none d-sm-inline-block">colaborador(s)</span>
            </span>
        </div>
        <div class="dashboards mx-2">
            <span id="numberOfDashboards">24</span>
            <span class="font-weight-bold">
                <a class=""><i class="fa fa-lg fa-columns"></i></a>
                <span class="d-none d-sm-inline-block">tablero(s)</span>
            </span>
        </div>
        <div class="activeTime mx-2">
            <?php echo $projectData["projectCreationDate"]; ?>
        </div>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php $actionGroups = [
    "Tablero" => [
        ["name" => "Añadir tablero", "link" => "/daw/projects/id/" . $viewParams["id"] . "/dashboards/", "icon" => "plus", "id" => "AddDashboard", "color" => "blue"],
        ["name" => "Ver tablero", "link" => "/daw/projects/id/" . $viewParams["id"] . "/dashboards/", "icon" => "eye", "id" => "ViewDashboard", "color" => "blue"],
        ["name" => "Ver tareas asignadas", "link" => "/daw/projects/id/" . $viewParams["id"] . "/dashboards/", "icon" => "tasks", "id" => "DashboardTasks", "color" => "blue"],
    ],
    "Diario" => [
        ["name" => "Ver diario de hoy", "link" => "/daw/projects/id/" . $viewParams["id"] . "/diary/date/" . $viewParams["diaryDate"] . "/",
            "icon" => "calendar-check-o", "id" => "TodayDiary", "color" => "green"],
        ["name" => "Ir a selección de fecha", "link" => "/daw/projects/id/" . $viewParams["id"] . "/diary/", "icon" => "calendar", "id" => "Diary", "color" => "green"],
    ],
    "Proyecto" => [
        ["name" => "Añadir colaborador", "link" => "", "icon" => "user-plus", "id" => "AddCollaborator", "color" =>
            "red"],
        ["name" => "Eliminar colaborador", "link" => "", "icon" => "user-times", "id" => "RemoveCollaborator",
            "color" => "red"],
        ["name" => "Cambiar rol colaborador", "link" => "", "icon" => "user-secret", "id" =>
            "ChangeRoleCollaborator", "color" => "red"],
        ["name" => "Eliminar proyecto", "link" => "", "icon" => "times", "id" => "DeleteProject", "color" => "red"],
    ],
];

foreach ($actionGroups as $actionGroupTitle => $actionGroup) {
    ?> <div class="actionsGroup">
                <h4 class="actionsTitle text-white"><?php echo $actionGroupTitle; ?></h4>
                <div class="actionsButton d-flex justify-content-space-between flex-wrap">
                    <?php
foreach ($actionGroup as $action) {
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
}
    ?>
                </div>
            </div> <?php
}
?>
        </div>
        <div class="col-md-6 mx-3 mx-sm-0">
            <div class="row text-white">
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
            <div class="row text-white">
                <h4 class="h4 text-white">Invitados recientemente</h4>
                <div class="recentlyInvited text-dark collaboratorsContainer"></div>
            </div>
        </div>
    </div>
</div>