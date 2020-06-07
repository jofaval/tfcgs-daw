<?php

$id = 0;
$viewParams = [
    "title" => "",
    "creation_date" => "",
    "creator" => "",
    "id" => "",
    "secondaryId" => "",
    "elementName" => "Element title",
    "tabName" => "general",
    "projectData" => "general",
    "diaryDate" => DateUtils::getCurrentDateTime("Y-m-d"),
    "diaryDatePrev" => "general",
    "diaryDateNext" => "general",
    "dashboardTitle" => "Título",
];

if (Utils::exists("id")) {
    //Coger la ID y comprobar las redirecciones
    $id = Utils::getCleanedData("id");

    $validation = Validation::getInstance();
    $regla = array(
        array(
            'name' => 'id',
            'rules' => 'no-empty,numeric',
        ),
    );

    $isValid = $validation->rules($regla, $_REQUEST);
    if ($isValid !== true) {
        header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/");
    }

    $projectAccessLevel = Model::getInstance()->getProjectAccessLevel($id, Sessions::getInstance()->getSession('userId'));
    $viewParams["projectAccessLevel"] = $projectAccessLevel;
    //Si no está invitado, aquí iría la opción de privado/público
    if (is_null($projectAccessLevel)) {
        header("Location: " . Config::$EXECUTION_HOME_PATH . "projects");
    }

    if (Utils::exists("changeProjectDetails")) {
        $title = Utils::getCleanedData("projectTitle");
        $description = Utils::getCleanedData("projectDescription");

        $result = Model::getInstance()->updateProjectDetails($id, $title, $description);

        if ($result === false) {
            $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
        <p class='m-0'>No se ha subido la imagen.</p>\n
        </div>";
        }
    } else if (Utils::exists("changeProjectProfileImage")) {
        $errors = [];
        $profileImage = FileUtils::validateFile("profileImage", $this->img_path . "/projects/$id/", "profile", $errors);

        if ($profileImage === false) {
            $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
        <p class='m-0'>No se ha subido la imagen.</p>\n
        </div>";
        } else {
            $this->resizeImage($profileImage,
                400, 400);
            header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            clearstatcache(true);
        }
    } else if (Utils::exists("changeProjectBGImage")) {
        $errors = [];
        $bgImage = FileUtils::validateFile("bgImage", $this->img_path . "/projects/$id/", "bg", $errors);

        var_dump($bgImage);

        return $bgImage;

        if ($bgImage === false) {
            $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
        <p class='m-0'>No se ha subido la imagen.</p>\n
        </div>";
        } else {
            $this->resizeImage($profileImage,
                400, 400);
            header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            clearstatcache(true);
        }
    }

    //Comprobar que el tabname, no es nada raro y es uno de los admitidos
    $tabName = Utils::getCleanedData("tabName");
    if (Utils::exists("tabName")) {
        $regla = array(
            array(
                'name' => 'id',
                'rules' => 'no-empty,numeric',
            ),
        );

        $isValid = $validation->rules($regla, ["id" => $id]);
        if ($isValid !== true || !in_array($tabName, ["overview", "dashboards", "gantts", "diary", "collaborators", "details"])) {
            header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/id/$id/");
        }
    }

    //Si no tiene ni elemento al que acceder ni pestaña a la que cambiar, fuera
    if (!Utils::exists("element") && $tabName == "") {
        header("Location: ./overview/");
    }
    $viewParams["tabName"] = $tabName;

    //Conseguir los datos del proyecto
    $sqlUtils = new SQLUtils(Model::getInstance());
    $project = new Projects();
    $projectData = $project->query()[0];
    if (is_null($projectData)) {
        header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/");
    }
    $viewParams["projectData"] = $this->getProjectDetails();

    $title = $projectData["title"];
    if (strlen($title) > 10) {
        $title = substr($title, 0, 10);
    }
    $viewParams["title"] = $title;
    $viewParams["id"] = $projectData["id"];
    $viewParams["creation_date"] = $projectData["creation_date"];

    $direction = "project";

    if (Utils::exists("subView")) {
        $subView = Utils::getCleanedData("subView");

        switch ($subView) {
            case 'assingedTasks':
                $direction = $this->getAssignedTasks($id, $viewParams);
                break;
        }
    }

    //Si tiene elemento
    if (Utils::exists("element")) {
        $element = Utils::getCleanedData("element");
        $secondaryId = Utils::getCleanedData("secondaryId");
        $viewParams["secondaryId"] = $secondaryId;

        //Si el elemento que se ha introducido es uno de los aceptados
        if (in_array($element, Config::$projectElements)) {
            $direction = $element;

            //Acciones especiales para los elementos de un proyecto
            switch ($element) {
                case 'tasks':
                    $sqlUtils = new SQLUtils(Model::getInstance());
                    $dashboard_title = Utils::getCleanedData("secondaryId");
                    $viewParams["dashboardTitle"] = $dashboard_title;

                    $dashboardQueryData = $sqlUtils->complexQuery("SELECT title FROM dashboards WHERE id_project=:id_project and title=:title", ["title" => $dashboard_title, "id_project" => $id]);

                    if ($dashboardQueryData === false || count($dashboardQueryData) == 0) {
                        header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/id/$id/dashboards/");
                    }
                    $direction = $element;

                    if (Utils::exists("view")) {
                        $view = Utils::getCleanedData("view");
                        switch ($view) {
                            case 'changeImage':
                                if ($viewParams["projectAccessLevel"] >= Config::$PROJECT_ACCESS_MANAGER) {
                                    $direction = $this->changeDashboardBgImage($element, $id, $dashboard_title);
                                } else {
                                    header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/id/$id/dashboards/$secondaryId/");
                                }

                                break;
                            case 'json':
                                $direction = $this->downloadDashboardJSON($element, $id, $dashboard_title);
                                break;
                        }
                    }

                    break;
                case 'gantt':
                    $ganttTitle = Utils::getCleanedData("secondaryId");
                    $direction = "diagram_gantt";
                    $viewParams["ganttTitle"] = $ganttTitle;
                    break;
            }
        }
    }

    //Acciones especiales para los tabs
    switch ($tabName) {
        case 'diary':
            //Preparar la fecha actual
            $dateInString = DateUtils::getCurrentDateTime("Y-m-d");
            $viewParams["diaryDate"] = $dateInString;

            //Si se pasa una, trabajar con esa
            if (Utils::exists("date")) {
                $date = Utils::getCleanedData("date");

                if ($date == "") {
                    header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/id/$id/diary/");
                }

                $regla = array(
                    array(
                        'name' => 'date',
                        'rules' => 'no-empty,date',
                    ),
                );

                $isDate = $validation->rules($regla, ["date" => $date]);
                if ($isDate === true) {
                    $viewParams["diaryDate"] = $date;
                } else {
                    header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/id/$id/diary/");
                }
            }

            $viewParams["diaryDatePrev"] = DateUtils::substractDays($viewParams["diaryDate"], 1, "Y-m-d");
            $viewParams["diaryDateNext"] = DateUtils::addDays($viewParams["diaryDate"], 1, "Y-m-d");
            break;
    }

    switch ($tabName) {
        case 'overview':
            $viewParams["projectNumbers"] = Model::getInstance()->getProjectNumbers($id);
            $viewParams["recentlyCreated"] = Model::getInstance()->getRecentlyCreated($id);
            include SystemPaths::SERVER_CONFIG_PATH . "/project_actions.php";
            break;
    }

    require_once SystemPaths::SERVER_PROJECT_PATH . "/$direction.php";
} else {
    header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/");
}