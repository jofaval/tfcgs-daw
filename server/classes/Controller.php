<?php

class Controller
{
    public function error()
    {
        require __DIR__ . '/../templates/error.php';
    }

    public function access()
    {
        require __DIR__ . '/../templates/access.php';
    }

    public function notsigned()
    {
        require __DIR__ . '/../templates/notsigned.php';
    }

    public function notuseragent()
    {
        require __DIR__ . '/../templates/notuseragent.php';
    }

    public function projects()
    {
        require __DIR__ . '/../templates/projects.php';
    }

    public function getDatabase()
    {
        require __DIR__ . '/../classes/one_execution/ExportDatabase-backup.php';
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
            "dashboardTitle" => "Title",
        ];

        if (Utils::exists("id")) {
            //Coger la ID y comprobar las redirecciones
            $id = Utils::getCleanedData("id");

            $validation = Validation::getInstance();
            $regla = array(
                array(
                    'name' => 'id',
                    'regla' => 'no-empty,numeric',
                ),
            );

            $isValid = $validation->rules($regla, ["id" => $id]);
            if ($isValid !== true) {
                header("Location: /daw/projects/");
            }

            //Comprobar que el tabname, no es nada raro y es uno de los admitidos
            $tabName = Utils::getCleanedData("tabName");
            if (Utils::exists("tabName")) {
                $regla = array(
                    array(
                        'name' => 'id',
                        'regla' => 'no-empty,numeric',
                    ),
                );

                $isValid = $validation->rules($regla, ["id" => $id]);
                if ($isValid !== true || !in_array($tabName, ["overview", "dashboards", "diary", "collaborators", "details"])) {
                    header("Location: /daw/projects/id/$id/");
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
                header("Location: /daw/projects/");
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

            //Si tiene elemento
            if (Utils::exists("element")) {
                $element = Utils::getCleanedData("element");
                $viewParams["secondaryId"] = Utils::getCleanedData("secondaryId");

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
                                header("Location: /daw/projects/id/$id/dashboards/");
                            }

                            $direction = $element;
                            break;
                    }
                }
            }

            //Acciones especiales para los tabs
            switch ($tabName) {
                case 'diary':
                    //Preparar la fecha actual
                    $dateInString = DateUtils::getCurrentDateTime();
                    $viewParams["diaryDate"] = $dateInString;

                    //Si se pasa una, trabajar con esa
                    if (Utils::exists("date")) {
                        $date = Utils::getCleanedData("date");

                        $regla = array(
                            array(
                                'name' => 'date',
                                'regla' => 'no-empty,date',
                            ),
                        );

                        $isDate = $validation->rules($regla, ["date" => $date]);
                        if ($isDate === true) {
                            $viewParams["diaryDate"] = $date;
                        }
                    }

                    $viewParams["diaryDatePrev"] = DateUtils::substractDays($viewParams["diaryDate"], 1, "Y-m-d");
                    $viewParams["diaryDateNext"] = DateUtils::addDays($viewParams["diaryDate"], 1, "Y-m-d");
                    break;
            }

            require __DIR__ . "/../templates/$direction.php";
        } else {
            header("Location: /daw/projects/");
        }
    }

    public function getProjectsOfUser()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        return $sqlUtils->complexQuery("SELECT projects.id, projects.title, projects.description,
        projects.id_creator = :id_creator as created,
        projects.id in (select bookmarked.id_project from bookmarked where bookmarked.id_client = :id_creator) as bookmarked
        FROM `projects`
            WHERE `enabled` = 1 and (projects.id_creator = :id_creator or :id_creator in
                (SELECT collaborators.id_collaborator
                     FROM collaborators
                         WHERE `enabled` = 1 and collaborators.id_project = projects.id))", ["id_creator" => Sessions::getInstance()->getSession("userId")]);
    }

    public function getDashboardsOfProject()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $id_project = Utils::getCleanedData("id_project");

        return $sqlUtils->complexQuery("SELECT dashboards.title, dashboards.id_project, dashboards.description, dashboards.creation_date,
        dashboards.id_creator = :id_client as created,
        (dashboards.id_project, dashboards.title) in (select bookmarked_dashboards.id_project, bookmarked_dashboards.title
        from bookmarked_dashboards
        where bookmarked_dashboards.id_client = :id_client
        and bookmarked_dashboards.id_project = :id_project
        and bookmarked_dashboards.title = dashboards.title) as bookmarked
        FROM `dashboards` LEFT JOIN `projects` on (`dashboards`.`id_project` = `projects`.`id`)
            WHERE `dashboards`.`enabled` = 1 and `projects`.`enabled` = 1 and projects.id = :id_project and (projects.id_creator = :id_client or :id_client in
                (SELECT collaborators.id_collaborator
                     FROM collaborators
                         WHERE `collaborators`.`enabled` = 1 and collaborators.id_project = :id_project)) ORDER BY dashboards.creation_date",
            ["id_client" => Sessions::getInstance()->getSession("userId"), "id_project" => (string) $id_project]);
    }

    public function getProjectDetails()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $id_project = Utils::getCleanedData("id");

        return $sqlUtils->complexQuery("SELECT projects.title as 'projectTitle', projects.description as 'projectDescription', CONCAT(clients.name, ' ', clients.surname) as 'projectCreator', users.username as 'projectCreatorUsername', projects.creation_date as 'projectCreationDate',
        collaborators.starting_date as 'collaborationStartingDate', collaborators.id_collaborator as 'collaborator', permissions.title as 'collaborationRole', permissions.description as 'collaborationRoleDescription'
        FROM `projects` LEFT JOIN `collaborators` on (collaborators.id_project = projects.id)
            LEFT JOIN `permissions` on (collaborators.level = permissions.level)
            LEFT JOIN `clients` on (collaborators.id_collaborator = clients.id) or (projects.id_creator = clients.id)
            LEFT JOIN `users` on (clients.id = users.id_client)
            WHERE projects.id = :id_project and (projects.id_creator = :id_creator or
            (collaborators.id_project = :id_project and collaborators.id_collaborator = :id_creator))", ["id_creator" => Sessions::getInstance()->getSession("userId"), "id_project" => $id_project])[0];
    }

    public function getListsOfDashboard()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $id_project = Utils::getCleanedData("id_project");
        $dashboard_title = Utils::getCleanedData("dashboard");

        $queryString = "SELECT id, id_project, title, order_criteria as orderCriteria, creation_date as creationDate
        FROM `dashboard_list`
        WHERE enabled = 1 and id_project = :id_project and dashboard_title = :dashboard_title";

        $lists = $sqlUtils->complexQuery($queryString, ["id_project" => $id_project, "dashboard_title" => $dashboard_title]);
        foreach ($lists as $key => $list) {
            $items = $this->getDashboardItemsOfList($list["id"]);
            $lists[$key]["items"] = $items;
        }

        return $lists;
    }

    public function getDashboardItemsOfList($id_dashboard_list)
    {
        $sqlUtils = new SQLUtils(Model::getInstance());

        $queryString = "SELECT id, title, description, `order`, creation_date as creationDate, id_dashboard_list
        FROM `dashboard_item`
        WHERE  enabled = 1 and id_dashboard_list=:id_dashboard_list";
        return $sqlUtils->complexQuery($queryString, ["id_dashboard_list" => $id_dashboard_list]);
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
        $sqlUtils = new SQLUtils(Model::getInstance());
        $id_project = Utils::getCleanedData("id_project");

        $params = [
            "id_project" => $id_project,
        ];

        $queryString = "SELECT CONCAT(clients.name, ' ', clients.surname) as 'collaboratorName', users.username as 'collaboratorUsername',
        collaborators.starting_date as 'collaborationStartingDate', permissions.title as 'collaborationRole', permissions.description as 'collaborationRoleDescription'
        FROM `collaborators` LEFT JOIN `permissions` on (collaborators.level = permissions.level)
            LEFT JOIN `clients` on (collaborators.id_collaborator = clients.id)
            LEFT JOIN `users` on (clients.id = users.id_client)
            WHERE collaborators.id_project = :id_project";

        if (Utils::exists("limit")) {
            $limit = (int) Utils::getCleanedData("limit");
            $params["limit"] = $limit;
            $queryString .= "    LIMIT :limit";
        }

        return $sqlUtils->complexQuery($queryString, $params);
    }

    public function getCommentsOfDashboardItem()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $id_dashboard_item = Utils::getCleanedData("id_dashboard_item");

        return $sqlUtils->complexQuery("SELECT CONCAT(clients.name, ' ', clients.surname) as 'commentCreatorName', users.username as 'commentCreatorUsername',
        dashboard_item_comments.creation_date as 'commentDate', dashboard_item_comments.comment, dashboard_item_comments.id
        FROM `dashboard_item_comments` LEFT JOIN `clients` on (dashboard_item_comments.id_creator = clients.id)
            LEFT JOIN `users` on (clients.id = users.id_client)
            WHERE dashboard_item_comments.id_dashboard_item = :id_dashboard_item", ["id_dashboard_item" => $id_dashboard_item]);
    }

    public function doesUsernameExists()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $username = Utils::getCleanedData("username");

        return count($sqlUtils->query("users", ["username" => $username])) > 0;
    }

    public function getClientIdFromUsername($username)
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        //$username = Utils::getCleanedData("username");

        return $sqlUtils->query("users", ["username" => $username])[0]["id_client"];
    }

    public function error404()
    {
        require __DIR__ . '/../templates/error404.php';
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
                "0" => "Guest",
                "1" => "Non confirmed",
                "2" => "Confirmed",
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

        require __DIR__ . '/../templates/accessLevel.php';
    }

    public function signout()
    {
        $sessions = Sessions::getInstance();
        /* $sessions->setSession("access", 0);
        $sessions->deleteSession("username"); */
        $sessions->deleteSession();
        header("Location: /daw/signin/");
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
                header("Location: /daw/projects/");
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
                    'regla' => 'no-empty,text',
                ),
                array(
                    'name' => 'secondName',
                    'regla' => 'no-empty,text',
                ),
                array(
                    'name' => 'email',
                    'regla' => 'no-empty,email',
                ),
                array(
                    'name' => 'username',
                    'regla' => 'no-empty,username',
                ),
                array(
                    'name' => 'password',
                    'regla' => 'no-empty,password',
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

            if ($validations === true) {
                $success = $model->signup(
                    $firstName,
                    $secondName,
                    $email,
                    $username,
                    $password
                );

                if ($success) {
                    if (!file_exists(__DIR__ . "/../../client/img/users/$username/")) {
                        mkdir(__DIR__ . "/../../client/img/users/$username/");
                    }

                    $userImagePath = __DIR__ . "/../../client/img/users/$username/$username.png";
                    $this->generateImage($firstName, $userImagePath);
                    header("Location: /daw/signin/");
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
        //require __DIR__ . '/../templates/signin.php';
    }

    public function generateImage($text, $savePath)
    {
        $text = strtoupper($text[0]);
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
        imagepng($im, $savePath, 0, null);
        imagedestroy($im);
    }

    public function test()
    {
        require_once __DIR__ . "/one_execution/test.php";
    }
}