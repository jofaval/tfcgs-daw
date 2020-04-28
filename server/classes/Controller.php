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
            "diaryDate" => "general",
            "diaryDatePrev" => "general",
            "diaryDateNext" => "general",
        ];

        if (Utils::exists("id")) {
            $id = Utils::getCleanedData("id");
            $tabName = Utils::getCleanedData("tabName");
            if (!Utils::exists("element") && $tabName == "") {
                header("Location: ./overview/");
            }
            $viewParams["tabName"] = $tabName;

            $sqlUtils = new SQLUtils(Model::getInstance());
            $project = new Projects();
            $projectData = $project->query()[0];
            if (is_null($projectData)) {
                header("Location: /daw/projects/");
            }
            $viewParams["projectData"] = $this->getProjectDetails();

            /* $sessions = Sessions::getInstance();
            $projectDataFromSession = $sessions->getSession("projectData");

            if ($projectDataFromSession != null) {
            if ($projectDataFromSession->$id != $id) {
            $projectDataFromSession = new ProjectData($this, $projectData);
            }
            } else {
            $projectDataFromSession = new ProjectData($this, $projectData);
            } */

            $viewParams["title"] = $projectData["title"];
            $viewParams["id"] = $projectData["id"];
            $viewParams["creation_date"] = $projectData["creation_date"];

            $direction = "project";

            if (Utils::exists("element")) {
                $element = Utils::getCleanedData("element");
                $viewParams["secondaryId"] = Utils::getCleanedData("secondaryId");
                if (in_array($element, Config::$projectElements)) {
                    //$direction = $element;
                }
            }

            switch ($tabName) {
                case 'diary':

                    $date = new DateTime();
                    $dateInString = $date->format("Y-m-d");
                    $viewParams["diaryDate"] = $dateInString;
                    $viewParams["diaryDatePrev"] = DateUtils::substractDays($dateInString, 1, "Y-m-d");
                    $viewParams["diaryDateNext"] = DateUtils::addDays($dateInString, 1, "Y-m-d");

                    if (Utils::exists("date")) {
                        $validation = Validation::getInstance();

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
                            $viewParams["diaryDatePrev"] = DateUtils::substractDays($date, 1, "Y-m-d");
                            $viewParams["diaryDateNext"] = DateUtils::addDays($date, 1, "Y-m-d");
                        }
                    }
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
                         WHERE `enabled` = 1 and collaborators.id_project = projects.id))", ["id_creator" => "16"]);
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
            WHERE `dashboards`.`enabled` = 1 and `projects`.`enabled` = 1 and (projects.id_creator = :id_client or :id_client in
                (SELECT collaborators.id_collaborator
                     FROM collaborators
                         WHERE `collaborators`.`enabled` = 1 and collaborators.id_project = :id_project)) ORDER BY dashboards.creation_date", ["id_client" => "16", "id_project" => $id_project]);
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
            (collaborators.id_project = :id_project and collaborators.id_collaborator = :id_creator))", ["id_creator" => "16", "id_project" => $id_project])[0];
    }

    public function getElementsOfDashboard()
    {

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
            return $sqlUtils->delete("bookmarked", ["id_project" => $projectId, "id_client" => "16"]);
        } else {
            return $sqlUtils->insert("bookmarked", ["id_project" => $projectId, "id_client" => "16"]);
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
            return $sqlUtils->delete("bookmarked_dashboards", ["id_project" => $projectId, "title" => $title, "id_client" => "16"]);
        } else {
            return $sqlUtils->insert("bookmarked_dashboards", ["id_project" => $projectId, "title" => $title, "id_client" => "16"]);
        }
    }

    public function getCollaboratorsOfProject()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $id_project = Utils::getCleanedData("id_project");

        return $sqlUtils->complexQuery("SELECT CONCAT(clients.name, ' ', clients.surname) as 'collaboratorName', users.username as 'collaboratorUsername',
        collaborators.starting_date as 'collaborationStartingDate', permissions.title as 'collaborationRole', permissions.description as 'collaborationRoleDescription'
        FROM `collaborators` LEFT JOIN `permissions` on (collaborators.level = permissions.level)
            LEFT JOIN `clients` on (collaborators.id_collaborator = clients.id)
            LEFT JOIN `users` on (clients.id = users.id_client)
            WHERE collaborators.id_project = :id_project", ["id_project" => $id_project]);
    }

    public function doesUsernameExists()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $username = Utils::getCleanedData("username");

        return count($sqlUtils->query("users", ["username" => $username])) > 0;
    }

    public function getClientIdFromUsername()
    {
        $sqlUtils = new SQLUtils(Model::getInstance());
        $username = Utils::getCleanedData("username");

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
                $sessions->setSession("access", $signin[0]["level"]);
                $sessions->setSession("userId", $signin[0]["id"]);
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

            $viewParams["signupFirstName"] = Utils::getCleanedData("firstName");
            $viewParams["signupSecondName"] = Utils::getCleanedData("secondName");
            $viewParams["signupUsername"] = Utils::getCleanedData("username");
            $viewParams["signupPassword"] = Utils::getCleanedData("password");
            $viewParams["signupEmail"] = Utils::getCleanedData("email");

            if ($validations === true) {
                $success = $model->signup(
                    Utils::getCleanedData("firstName"),
                    Utils::getCleanedData("secondName"),
                    Utils::getCleanedData("email"),
                    Utils::getCleanedData("username"),
                    Utils::getCleanedData("password"),
                );

                if ($success) {
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
        require __DIR__ . '/../templates/signin.php';
    }

    public function getEventsFromMonth()
    {
        $model = Model::getInstance();
        $validation = Validation::getInstance();

        $regla = array(
            array(
                'name' => 'month',
                'regla' => 'no-empty,numeric',
            ),
            array(
                'name' => 'year',
                'regla' => 'no-empty,numeric',
            ),
        );
        $validation = $validation->rules($regla, $_REQUEST);

        if ($validation === true) {
            return $model->getEventsFromMonth(Utils::getCleanedData("month"), Utils::getCleanedData("year"));
        }

        return false;
    }

    public function test()
    {
        /* $model = Model::getInstance();
        $sessions = Sessions::getInstance(); */

        echo "test";

        //return Cryptography::blowfishCrypt("test", "test");
        //return count($model->query("SELECT * FROM `schedules`", $params));
        //return $model->cudOperation("INSERT INTO `schedules` (`orderId`, `startHour`, `endHour`, `year`) VALUES ('7', '9:45', '10:40', '2019')", $params);
        //return $_REQUEST["year"];
        //return $model->getTeachers();
    }
}