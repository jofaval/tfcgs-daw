<?php

class Controller
{
    public function __construct()
    {
        $this->img_path = __DIR__ . "/../../client/img";
    }

    public function error()
    {
        require __DIR__ . '/../templates/errors/error.php';
    }

    public function access()
    {
        require __DIR__ . '/../templates/errors/access.php';
    }

    public function notsigned()
    {
        require __DIR__ . '/../templates/errors/notsigned.php';
    }

    public function notuseragent()
    {
        require __DIR__ . '/../templates/errors/notuseragent.php';
    }

    public function projects()
    {
        $clientId = Sessions::getInstance()->getSession("userId");

        $viewParams["profile"] = Model::getInstance()->getProfileInformation(
            $clientId
        );

        require __DIR__ . '/../templates/project/projects.php';
    }

    public function getDatabase()
    {
        require __DIR__ . '/../classes/one_execution/ExportDatabase-backup.php';
    }

    public function about()
    {
        require_once __DIR__ . "/../templates/about.php";
    }

    public function profile()
    {
        $viewParams = [
            "editable" => false,
        ];

        $username = Utils::getCleanedData("username");
        $userId = Sessions::getInstance()->getSession("userId");
        $clientId = $userId;

        if ($username == "") {
            $viewParams["editable"] = true;
        } else {
            $clientId = $this->getClientIdFromUsername($username);
        }
        $username = $this->getUsernameFromClientId($clientId);

        $result = true;

        if ($userId == $clientId) {

            if (Utils::exists("reset")) {
                $reset = Utils::getCleanedData("reset");
                switch ($reset) {
                    case 'profileImage':
                        $randomImage = $this->img_path . "/projects/templates/profile-" . rand(1, 6) . ".png";
                        $finalPath = $this->img_path . "/users/$username/$username.png";

                        FileUtils::copy($randomImage, $finalPath);
                        break;
                    case 'bgImage':
                        $randomImage = $this->img_path . "/projects/templates/bg-" . rand(1, 6) . ".png";
                        $finalPath = $this->img_path . "/users/$username/bg-$username.png";

                        FileUtils::copy($randomImage, $finalPath);
                        break;
                }

                header("Location: " . Config::$EXECUTION_HOME_PATH . "profile/");
            }

            if (Utils::exists("updateProfile")) {
                $name = Utils::getCleanedData("name");
                $surname = Utils::getCleanedData("surname");
                $email = Utils::getCleanedData("email");
                $biography = Utils::getCleanedData("biography");

                $result = Model::getInstance()->updateProfile($clientId, $name, $surname, $email, $biography);
            } else if (Utils::exists("updatePassword")) {
                $oldPassword = Utils::getCleanedData("oldPassword");
                $password = Utils::getCleanedData("password");
                $repeatPassword = Utils::getCleanedData("repeatPassword");

                if ($password == $repeatPassword) {
                    $result = Model::getInstance()->updatePassword($clientId, $password, $oldPassword);
                } else {
                    $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
                <p class='m-0'>Error: Las contraseñas no coinciden.</p>\n
                </div>";
                }
            } else if (Utils::exists("updateProfileImage")) {
                $errors = [];
                $profileImage = FileUtils::validateFile("profileImage", $this->img_path . "/users/$username/", $username, $errors);

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
            } else if (Utils::exists("updateBackgroundImage")) {
                $username = $this->getUsernameFromClientId($clientId);
                $errors = [];
                $bgImage = FileUtils::validateFile("bgImage", $this->img_path . "/users/$username/", "bg-$username", $errors);

                if ($bgImage === false) {
                    $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
                <p class='m-0'>No se ha subido la imagen.</p>\n
                </div>";
                } else {
                    $this->resizeImage($bgImage,
                        1750, 400);
                    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
                    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
                    header("Cache-Control: post-check=0, pre-check=0", false);
                    header("Pragma: no-cache");
                    clearstatcache(true);
                }
            }
        }

        if ($result === false && !isset($viewParams["error"])) {
            $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
        <p class='m-0'>Ha surgido un error.</p>\n
        </div>";
        }

        $viewParams["profile"] = Model::getInstance()->getProfileInformation(
            $clientId
        );

        if (is_null($viewParams["profile"])) {
            //header("Location: " . Config::$EXECUTION_HOME_PATH . "profile/");
            header("Location: " . Config::$EXECUTION_HOME_PATH . "profile/not-found/");
        }

        require_once __DIR__ . "/../templates/profile/profile.php";
    }

    public function getAssignedDashboardItems()
    {
        $id_project = Utils::getCleanedData("id_project");

        $validation = Validation::getInstance();
        $regla = array(
            array(
                'name' => 'id_project',
                'rules' => 'no-empty,numeric',
            ),
        );

        $isValid = $validation->rules($regla, $_REQUEST);

        if ($isValid !== true) {
            return false;
        }

        $userId = Sessions::getInstance()->getSession("userId");

        return Model::getInstance()->getAssignedDashboardItems($id_project, $userId);
    }

    public function project()
    {
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
                if ($isValid !== true || !in_array($tabName, ["overview", "dashboards", "diary", "collaborators", "details"])) {
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
                    include __DIR__ . "/config/project_actions.php";
                    break;
            }

            require_once __DIR__ . "/../templates/project/$direction.php";
        } else {
            header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/");
        }
    }

    public function getAssignedTasks($id, &$viewParams)
    {
        $userId = Sessions::getInstance()->getSession("userId");
        $limit = "";
        $assignedTasksByYouUnfinished = [];
        $assignedTasksToYouUnfinished = [];
        $assignedTasksByYouFinished = [];
        $assignedTasksToYouFinished = [];
        $assignedTasks = Model::getInstance()->getAssignedDashboardItems($id, $userId, $limit);
        $viewParams["assignedTasks"] = $assignedTasks;
        $viewParams["userId"] = $userId;

        foreach ($assignedTasks as $assignedTask) {
            if ($assignedTask["assigned_to"] == $userId) {
                if ($assignedTask["finished"] != 0) {
                    $assignedTasksToYouUnfinished[] = $assignedTask;
                } else {
                    $assignedTasksToYouFinished[] = $assignedTask;
                }
            }
            if ($assignedTask["assigned_by"] == $userId) {
                if ($assignedTask["finished"] != 0) {
                    $assignedTasksByYouUnfinished[] = $assignedTask;
                } else {
                    $assignedTasksByYouFinished[] = $assignedTask;
                }
            }
        }

        $viewParams["assignedTasksByYouUnfinished"] = $assignedTasksByYouUnfinished;
        $viewParams["assignedTasksToYouUnfinished"] = $assignedTasksToYouUnfinished;
        $viewParams["assignedTasksByYouFinished"] = $assignedTasksByYouFinished;
        $viewParams["assignedTasksToYouFinished"] = $assignedTasksToYouFinished;

        return "assignedTasks";
    }

    public function downloadDashboardJSON($element, $id, $dashboard_title)
    {
        $ajaxController = new AjaxController();

        $_REQUEST["id_project"] = $id;
        $_REQUEST["dashboard"] = $dashboard_title;

        $ajaxController->getListsOfDashboard();
    }

    public function changeDashboardBgImage($element, $id, $dashboard_title)
    {
        if (Utils::exists("updateBackgroundImage")) {
            $errors = [];

            $bgImage = FileUtils::validateFile("bgImage", $this->img_path . "/projects/$id/dashboards/$dashboard_title/", "bg", $errors);
            if ($bgImage !== false) {
                $this->resizeImage($bgImage, 1920, 1080);
            }
        }

        return "/tasks/change-image";
    }

    public function getProjectsOfUser()
    {
        $userId = Sessions::getInstance()->getSession("userId");

        return Model::getInstance()->getProjectsOfUser($userId);
    }

    public function getDashboardsOfProject()
    {
        $id_project = Utils::getCleanedData("id_project");

        return Model::getInstance()->getDashboardsOfProject($id_project);
    }

    public function getProjectDetails()
    {
        $id_project = Utils::getCleanedData("id");
        $userId = Sessions::getInstance()->getSession("userId");

        return Model::getInstance()->getProjectDetails($id_project, $userId);
    }

    public function getListsOfDashboard()
    {
        $id_project = Utils::getCleanedData("id_project");
        $dashboard_title = Utils::getCleanedData("dashboard");
        $modelInstance = Model::getInstance();

        $validation = Validation::getInstance();

        $rules = array(
            array(
                "name" => "id_project",
                "rules" => "no-empty,numeric",
            ),
            array(
                "name" => "dashboard",
                "rules" => "no-empty,text",
            ),
        );

        $isValid = $validation->rules($rules, $_REQUEST);

        if ($isValid !== true) {
            return false;
        };

        $lists = $modelInstance->getListsOfDashboard($id_project, $dashboard_title);
        foreach ($lists as $listKey => $list) {
            $items = $this->getDashboardItemsOfList($list["id"]);

            foreach ($items as $itemKey => $item) {
                $itemAssignationData = $modelInstance->getAssignationDataFromItem($item["id"], Sessions::getInstance()->getSession("userId"));

                $items[$itemKey]["assigned"] = $itemAssignationData !== false && !is_null($itemAssignationData);
                $items[$itemKey]["finished"] = $itemAssignationData["finished"];
                $items[$itemKey]["start_date"] = $itemAssignationData["start_date"];
                $items[$itemKey]["end_date"] = $itemAssignationData["end_date"];
                $items[$itemKey]["assignation_id"] = $itemAssignationData["id"];
                $items[$itemKey]["assigned_by"] = $this->getUsernameFromClientId($itemAssignationData["assigned_by"]);
            }

            $lists[$listKey]["items"] = $items;
        }

        return $lists;
    }

    public function getDashboardItemsOfList($id_dashboard_list)
    {
        return Model::getInstance()->getDashboardItemsOfList($id_dashboard_list);
    }

    public function bookmarkProject()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $bookmarked = Utils::getCleanedData("bookmarked");

        $projectId = Utils::getCleanedData("id_project");

        $projects = $this->getProjectsOfUser();

        $found = false;
        foreach ($projects as $project) {
            if ($project["id"] == $projectId) {
                $found = true;
                break;
            }
        }

        if (!$found) {
            return false;
        }

        $bookmarked = Utils::getCleanedData("bookmarked");
        if ($bookmarked) {
            return $sqlUtils->delete("bookmarked", ["id_project" => $projectId, "id_client" => Sessions::getInstance()->getSession("userId")]);
        } else {
            return $sqlUtils->insert("bookmarked", ["id_project" => $projectId, "id_client" => Sessions::getInstance()->getSession("userId")]);
        }
    }

    public function bookmarkDashboard()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $bookmarked = Utils::getCleanedData("bookmarked");

        $projectId = Utils::getCleanedData("id_project");
        $title = Utils::getCleanedData("title");

        $dashboards = $this->getDashboardsOfProject();
        $found = false;
        //$test = [];
        foreach ($dashboards as $key => $dashboard) {
            /* $test[$key] = [
            "title" => $dashboard["title"] == $title,
            "title_original" => $title,
            "title_introducido" => $title,
            "id_project" => $dashboard["id_project"] == $projectId,
            "id_project_original" => $dashboard["id_project"],
            "id_project_introducido" => $projectId,
            ]; */
            if ($dashboard["title"] == $title && $dashboard["id_project"] == $projectId) {
                $found = true;
                break;
            }
        }

        //return $test;

        if (!$found) {
            return false;
        }

        $bookmarked = Utils::getCleanedData("bookmarked");
        if ($bookmarked != 0) {
            return $sqlUtils->delete("bookmarked_dashboards", ["id_project" => $projectId, "title" => $title, "id_client" => Sessions::getInstance()->getSession("userId")]);
        } else {
            return $sqlUtils->insert("bookmarked_dashboards", ["id_project" => $projectId, "title" => $title, "id_client" => Sessions::getInstance()->getSession("userId")]);
        }
    }

    public function getCollaboratorsOfProject()
    {
        $id_project = Utils::getCleanedData("id_project");
        $limit = Utils::getCleanedData("limit");

        return Model::getInstance()->getCollaboratorsOfProject($id_project, $limit);
    }

    public function getCommentsOfDashboardItem()
    {
        $id_dashboard_item = Utils::getCleanedData("id_dashboard_item");

        return Model::getInstance()->getCommentsOfDashboardItem($id_dashboard_item);
    }

    public function doesUsernameExists()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $username = Utils::getCleanedData("username");

        return count($sqlUtils->query("users", ["username" => $username])) > 0;
    }

    public function doesEmailExists()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $email = Utils::getCleanedData("email");

        return count($sqlUtils->query("clients", ["email" => $email])) > 0;
    }

    public function getClientIdFromUsername($username)
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        //$username = Utils::getCleanedData("username");

        return $sqlUtils->query("users", ["username" => $username])[0]["id_client"];
    }

    public function getUsernameFromClientId($clientId)
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        return $sqlUtils->query("users", ["id_client" => $clientId])[0]["username"];
    }

    public function getProjectCollaborationRoles()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        return $sqlUtils->query("permissions");
    }

    public function updateOrderInDashboardList()
    {
        $id_dashboard_list = Utils::getCleanedData("id_dashboard_list");
        $order = Utils::getCleanedData("order");

        $validation = Validation::getInstance();

        $rules = [
            [
                "name" => "id_dashboard_list",
                "rules" => "no-empty,numeric",
            ],
            [
                "name" => "order",
                "rules" => "no-empty,numeric",
            ],
        ];

        $isValid = $validation->rules($rules, $_REQUEST);

        if ($isValid === true) {
            return Model::getInstance()->updateOrderInDashboardList($id_dashboard_list, $order);
        }

        return false;
    }

    public function searchUsers()
    {
        $username = Utils::getCleanedData("username");

        $validation = Validation::getInstance();

        $rules = [
            [
                "name" => "username",
                "rules" => "no-empty,username",
            ],
        ];

        $isValid = $validation->rules($rules, $_REQUEST);

        if (!$isValid === true) {
            return false;
        }

        return Model::getInstance()->searchUsers($username);
    }

    public function error404()
    {
        require __DIR__ . '/../templates/errors/error404.php';
    }

    public function condenseFilesIntoOne()
    {
        require __DIR__ . '/../classes/one_execution/condenseFilesIntoOne.php';
    }

    public function createPOPOfromDatabase()
    {
        require __DIR__ . '/one_execution/createPOPOfromDatabase.php';
    }

    public function accessLevel()
    {
        $filePath = __DIR__ . '/../Access.php';
        $viewParams = [
            "routes" => [],
            "accessLevels" => [
                "0" => "Invitado",
                "-1" => "Por confirmar",
                "1" => "Usuario",
                "3" => "Admin",
            ],
        ];

        $content = file_get_contents($filePath);

        $explodedContent = explode(PHP_EOL, $content);

        $startLines = [];
        for ($linesToRemove = 0; $linesToRemove < 2; $linesToRemove++) {
            $startLines[] = array_shift($explodedContent);
        }

        $routes = [];
        $accessMapArray = [];
        foreach ($explodedContent as $value) {
            $element = explode(" = ", $value);
            $identification = $element[0];
            $value = preg_replace("/;/", "", $element[1]);

            $regex = '/(?<=\$map\[\').*?(?=\'\]\[\'access\'\])/s';

            preg_match($regex, $identification, $matches, PREG_OFFSET_CAPTURE, 0);

            $route = $matches[0][0];
            $routes[] = $route;
            $accessMapArray[$route] = $value;
        }

        $viewParams["routes"] = $routes;

        $changeFile = false;
        if (Utils::exists("change")) {
            $selectOption = Utils::getCleanedData("route");
            $accessMapArray[$selectOption] = Utils::getCleanedData("access");
            $changeFile = true;
        } else if (Utils::exists("add")) {
            $newRoute = Utils::getCleanedData("newRoute");
            $accessMapArray[$newRoute] = Utils::getCleanedData("access");
            $changeFile = true;
        }

        if ($changeFile) {
            $newFileContent = "<?php\n";

            foreach ($accessMapArray as $key => $value) {
                $newFileContent .= "\n\$map['$key']['access'] = $value;";
            }

            $newFileContent = str_replace("\n", PHP_EOL, $newFileContent);

            file_put_contents($filePath, $newFileContent);
        }

        require __DIR__ . '/../templates/admin/accessLevel.php';
    }

    public function signout()
    {
        $sessions = Sessions::getInstance();
        /* $sessions->setSession("access", 0);
        $sessions->deleteSession("username"); */
        $sessions->deleteSession();
        header("Location: " . Config::$EXECUTION_HOME_PATH . "signin/");
    }

    public function signin()
    {
        $result = "ewgwegwe";
        $viewParams = [
            "error" => "",
            "signinUsername" => "",
            "signinPassword" => "",
            "signupFirstName" => "Pepe",
            "signupSecondName" => "Fabra",
            "signupUsername" => "jofaval",
            "signupPassword" => "test",
            "signupEmail" => "test1@test.test",
        ];
        if (Utils::exists("signin")) {
            $result = ExceptionUtils::tryCatch("Controller", "signinFunctionality");

            $viewParams["signinUsername"] = Utils::getCleanedData("username");
            $viewParams["signinPassword"] = Utils::getCleanedData("password");

            if ($result !== false) {
                header("Location: " . Config::$EXECUTION_HOME_PATH . "projects/");
            } else {
                $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
                <p class='m-0'>Error: We couldn't sign you in.</p>\n
                </div>";
            }
        }

        require __DIR__ . '/../templates/signin.php';
    }

    public function signinFunctionality()
    {
        $model = Model::getInstance();
        $validation = Validation::getInstance();
        $sessions = Sessions::getInstance();

        $username = Utils::getCleanedData("username");
        $password = Utils::getCleanedData("password");
        $validation = $validation->rules($regla, ["username" => $username, "password" => $password]);
        $validation = true;

        if ($validation === true) {
            $signin = $model->signin($username, $password);
            if ($signin) {
                $sessions->setSession("username", $username);
                $sessions->setSession("access", $signin[0]["role"]);
                $sessions->setSession("userId", $signin[0]["id_client"]);
                $sessions->setSession("time", time() + Config::$inactivityTime);
                return true;
            }
        }

        return false;
    }

    public function signup()
    {
        $viewParams = [
            "error" => "",
            "signinUsername" => "jofaval",
            "signinPassword" => "test",
            "signupFirstName" => "Pepe",
            "signupSecondName" => "Fabra",
            "signupUsername" => "jofaval",
            "signupPassword" => "test",
            "signupEmail" => "test1@test.test",
        ];

        if (Utils::exists("signup")) {
            $model = Model::getInstance();
            $validation = Validation::getInstance();
            $sessions = Sessions::getInstance();

            $regla = array(
                array(
                    'name' => 'firstName',
                    'rules' => 'no-empty,text',
                ),
                array(
                    'name' => 'secondName',
                    'rules' => 'no-empty,text',
                ),
                array(
                    'name' => 'email',
                    'rules' => 'no-empty,email',
                ),
                array(
                    'name' => 'username',
                    'rules' => 'no-empty,username',
                ),
                array(
                    'name' => 'password',
                    'rules' => 'no-empty,password',
                ),
            );
            $validations = $validation->rules($regla, $_REQUEST);

            $firstName = Utils::getCleanedData("firstName");
            $secondName = Utils::getCleanedData("secondName");
            $email = Utils::getCleanedData("email");
            $username = Utils::getCleanedData("username");
            $password = Utils::getCleanedData("password");

            $viewParams["signupFirstName"] = $firstName;
            $viewParams["signupSecondName"] = $secondName;
            $viewParams["signupUsername"] = $username;
            $viewParams["signupPassword"] = $password;
            $viewParams["signupEmail"] = $email;

            if (in_array($username, Config::$banned_usernames)) {
                $viewParams = array_merge($viewParams, $validation->mensaje);
                $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
                <p class='m-0'>Nombre de usuario no válido.</p>\n
                </div>";
            } else {
                if ($validations === true) {
                    $success = $model->signup(
                        $firstName,
                        $secondName,
                        $email,
                        $username,
                        $password
                    );

                    if ($success) {
                        if (!file_exists($this->img_path . "/users/$username/")) {
                            mkdir($this->img_path . "/users/$username/");
                        }

                        $userImagePath = $this->img_path . "/users/$username/$username.png";
                        $this->generateImage($firstName, $userImagePath);

                        $randomImage = $this->img_path . "/projects/templates/bg-" . rand(1, 6) . ".png";
                        $finalPath = $this->img_path . "/users/$username/bg-$username.png";

                        FileUtils::copy($randomImage, $finalPath);
                        header("Location: " . Config::$EXECUTION_HOME_PATH . "signin/");
                    }
                    $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
                <p class='m-0'>Error: We couldn't sign you up.</p>\n
                </div>";
                } else {
                    $viewParams = array_merge($viewParams, $validation->mensaje);
                    $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
                <p class='m-0'>Error: There's validation errors.</p>\n
                </div>";
                }
            }
        }
        require __DIR__ . '/../templates/signin.php';
    }

    public function generateImage($text, $savePath)
    {
        $text = mb_strtoupper($text[0]);
        header("Content-type: image/png");

        $width = 400;
        $height = 400;

        $im = imagecreate($width, $height);

        $minRGB = 75;
        $maxRGB = 150;

        $arrayOfColors = [
            [192, 44, 3],
            [195, 98, 0],
            [192, 146, 3],
            [143, 150, 2],
            [2, 247, 113],
            [0, 121, 125],
            [0, 115, 195],
            [144, 0, 195],
            [194, 0, 195],
            [195, 0, 153],
        ];

        $selectedColor = $arrayOfColors[rand(0, count($arrayOfColors) - 1)];

        $bgColor = imagecolorallocate($im,
            $selectedColor[0],
            $selectedColor[1],
            $selectedColor[2]
            /* rand($minRGB, $maxRGB) - rand(0, $minRGB / 2),
        rand($minRGB, $maxRGB) - rand(0, $minRGB / 2),
        rand($minRGB, $maxRGB) - rand(0, $minRGB / 2) */
        );

        $textColor = imagecolorallocate($im,
            235,
            235,
            235
        );

        $font = 'C:\\Windows\\Fonts\\Montserrat-Bold_0.otf';
        $fontSize = $width / 2;

        $textBox = imagettfbbox($fontSize, 0, $font, $text);

        $textWidth = $textBox[2] - $textBox[0];
        $textHeight = $textBox[7] - $textBox[1];

        $x = ($width / 2) - ($textWidth / 2);
        $y = ($height / 2) - ($textHeight / 2);

        imagettftext($im, $fontSize, 0, $x, $y + 1, $textColor, $font, $text);

        imagepng($im);
        imagepng($im, $savePath, 9, null);
        imagedestroy($im);
    }

    public function generateSitemap()
    {
        header("Content-type: application/xml");
        $sitemapXMLContent = "<?xml version='1.0' encoding='UTF-8'?" . ">";
        $sitemapXMLContent .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $sqlUtils = new SQLUtils(Model::getInstance());

        $projects = $sqlUtils->query("projects");
        $projectPages = [
            "overview",
            "dashboards",
            "diary",
            "collaborators",
            "details",
        ];

        foreach ($projects as $project) {
            $projectId = $project["id"];
            $sitemapXMLContent .= "<url>";
            $url = "http://localhost.com" . Config::$EXECUTION_HOME_PATH . "projects/id/$projectId/";
            $sitemapXMLContent .= "<loc>" . $this->encodeURI($url) . "</loc>";
            $sitemapXMLContent .= "<lastmod>" . $project["creation_date"] . "</lastmod>";
            $sitemapXMLContent .= "<changefreq>never</changefreq>";
            $sitemapXMLContent .= "<priority>0.5</priority>";
            $sitemapXMLContent .= "</url>";
            foreach ($projectPages as $projectPage) {
                $sitemapXMLContent .= "<url>";
                $url = "http://localhost.com" . Config::$EXECUTION_HOME_PATH . "projects/id/$projectId/$projectPage/";
                $sitemapXMLContent .= "<loc>" . $this->encodeURI($url) . "</loc>";
                $sitemapXMLContent .= "<lastmod>" . $project["creation_date"] . "</lastmod>";
                $sitemapXMLContent .= "<changefreq>never</changefreq>";
                $sitemapXMLContent .= "<priority>0.5</priority>";
                $sitemapXMLContent .= "</url>";
            }

            $dashboards = $sqlUtils->query("dashboards", ["id_project" => $projectId]);
            foreach ($dashboards as $dashboard) {
                $dashboardTitle = $dashboard["title"];
                $sitemapXMLContent .= "<url>";
                $url = "http://localhost.com" . Config::$EXECUTION_HOME_PATH . "projects/id/$projectId/dashboards/$dashboardTitle/";
                $sitemapXMLContent .= "<loc>" . $this->encodeURI($url) . "</loc>";
                $sitemapXMLContent .= "<lastmod>" . $dashboard["creation_date"] . "</lastmod>";
                $sitemapXMLContent .= "<changefreq>never</changefreq>";
                $sitemapXMLContent .= "<priority>0.5</priority>";
                $sitemapXMLContent .= "</url>";
            }
        }

        $sitemapXMLContent .= '</urlset>';

        echo $sitemapXMLContent;

        file_put_contents(__DIR__ . "/../../client/sitemap.xml", $sitemapXMLContent);
    }

    public function encodeURI($url)
    {
        // http://php.net/manual/en/function.rawurlencode.php
        // https://developer.mozilla.org/en/JavaScript/Reference/Global_Objects/encodeURI
        $unescaped = array(
            '%2D' => '-', '%5F' => '_', '%2E' => '.', '%21' => '!', '%7E' => '~',
            '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')',
        );
        $reserved = array(
            '%3B' => ';', '%2C' => ',', '%2F' => '/', '%3F' => '?', '%3A' => ':',
            '%40' => '@', '%26' => '&', '%3D' => '=', '%2B' => '+', '%24' => '$',
        );
        $score = array(
            '%23' => '#',
        );
        return strtr(rawurlencode($url), array_merge($reserved, $unescaped, $score));

    }

    public function addNewRoute()
    {
        if (Utils::exists("addRoute")) {
            $routeName = Utils::getCleanedData("routeName");
            $isView = Utils::exists("isView");
            $friendlyURL = Utils::exists("friendlyURL");
            $addToModel = Utils::exists("addToModel");
            $addToAjax = Utils::exists("addToAjax");

            $route = "\n//$routeName";
            $route .= "\n\$map['$routeName'] = array('controller' => 'Controller', 'action' => '$routeName', 'access' => Config::\$ACCESS_LEVEL_GUEST);";

            $controllerFunction = "\n\tpublic function $routeName() \n\t{";

            if ($isView) {
                $templateContent = file_get_contents(__DIR__ . "/../templates/example.php");
                file_put_contents(
                    __DIR__ . "/../templates/$routeName.php",
                    $templateContent
                );

                $controllerFunction .= "\n\t\t" . 'require_once __DIR__ . "/../templates/' . $routeName . '.php";';
            }

            if ($friendlyURL) {
                $htaccessRoute = "\n#" . $routeName . "\nRewriteRule ^" . $routeName . "[/]?$ ./index.php?ctl=" . $routeName . " [L]";

                $fileWritter = fopen(__DIR__ . "/../../client/.htaccess", "a+");
                fwrite($fileWritter, $htaccessRoute);
                fclose($fileWritter);
            }

            if ($addToAjax) {
                $ajaxFunction = "\n\n\t//Function to $routeName\n" . $controllerFunction;

                $ajaxFunction .= "\n\t\t\$this->genericAjaxReturn(__FUNCTION__, [\"field\"], \"Controller\");";

                $ajaxFunction .= "\n\t}
                ";

                $fileWritter = fopen(__DIR__ . "/AjaxController.php", "a+");
                fwrite($fileWritter, $ajaxFunction);
                fclose($fileWritter);
            }

            if ($addToModel) {
                $modelFunction = $controllerFunction;

                $modelFunction .= "\n\t\t\$sqlUtils = new SQLUtils(\$this);\n\n\t\t\$queryString = \"SELECT * FROM tabla\";\n\t\treturn \$sqlUtils->complexQuery(\$queryString,[]);";

                $modelFunction .= "\n\t}
                ";

                $controllerFunction .= "\n\t\treturn Model::getInstance()->$routeName();";

                $fileWritter = fopen(__DIR__ . "/Model.php", "a+");
                fwrite($fileWritter, $modelFunction);
                fclose($fileWritter);
            }

            $controllerFunction .= "\n\t}
            ";

            $fileWritter = fopen(__DIR__ . "/Controller.php", "a+");
            fwrite($fileWritter, $controllerFunction);
            fclose($fileWritter);

            $fileWritter = fopen(__DIR__ . "/../RoutingMap.php", "a+");
            fwrite($fileWritter, $route);
            fclose($fileWritter);
        }

        require_once __DIR__ . "/../templates/admin/newRoute.php";
    }

    public function resizeImage($imageSrc, $targetWidth, $targetHeight)
    {
        header('Content-Type: image/png');

        $mime = mime_content_type($imageSrc);
        list($ancho, $alto) = getimagesize($imageSrc);

        $thumb = imagecreatetruecolor($targetWidth, $targetHeight);

        $origen = null;
        switch ($mime) {
            case 'image/png':
                $origen = imagecreatefrompng($imageSrc);
                break;
            case 'image/jpeg':
                $origen = imagecreatefromjpeg($imageSrc);
                break;
            case 'image/jpg':
                $origen = imagecreatefromjpg($imageSrc);
                break;
            case 'image/gif':
                $origen = imagecreatefromgif($imageSrc);
                break;
        }

        if (is_null($origen)) {
            return;
        }

        imagecopyresampled(
            $thumb, $origen,
            0, 0,
            0, 0,
            $targetWidth, $targetHeight,
            $ancho, $alto,
        );

        imagepng($thumb);
        imagepng($thumb, $imageSrc, 9, null);
        imagedestroy($im);

        header("Location: ./");
    }

    public function test()
    {
        require_once __DIR__ . "/one_execution/test.php";
    }

    public function getDashboardItemDetails()
    {
        $id = Utils::getCleanedData("id");

        $validation = Validation::getInstance();

        $rules = array(
            array(
                "name" => "id",
                "rules" => "no-empty,numeric",
            ),
        );

        $isValid = $validation->rules($rules, $_REQUEST);

        if ($isValid !== true) {
            return false;
        };

        $result = Model::getInstance()->getDashboardItemDetails($id);

        if (is_null($result)) {
            return false;
        }

        return $result;
    }

    public function maintenance()
    {
        require_once __DIR__ . "/../templates/errors/maintenance.php";
    }

    public function admin()
    {
        require_once __DIR__ . "/../templates/admin/admin.php";
    }

    public function getDataFromTable()
    {
        $tableName = Utils::getCleanedData("tableName");
        $viewParams = [];

        $sqlUtils = new SQLUtils(Model::getInstance());

        $viewParams["tableName"] = $tableName;
        $viewParams["results"] = $sqlUtils->query($tableName);
        $viewParams["columns"] = array_keys($viewParams["results"][0]); /*

        echo "<pre>";
        var_dump($viewParams);
        echo "</pre>";
        exit; */

        require_once __DIR__ . "/../templates/admin/getDataFromTable.php";
    }

    public function profileNotFound()
    {
        require_once __DIR__ . "/../templates/profile/profileNotFound.php";
    }
}