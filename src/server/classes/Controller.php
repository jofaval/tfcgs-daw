<?php

class Controller
{
    public function __construct()
    {
        $this->img_path = SystemPaths::CLIENT_IMG_PATH;
    }

    public function error()
    {
        require SystemPaths::SERVER_ERRORS_PATH . '/error.php';
    }

    public function access()
    {
        require SystemPaths::SERVER_ERRORS_PATH . '/access.php';
    }

    public function notsigned()
    {
        require SystemPaths::SERVER_ERRORS_PATH . '/notsigned.php';
    }

    public function notuseragent()
    {
        require SystemPaths::SERVER_ERRORS_PATH . '/notuseragent.php';
    }

    public function gantt()
    {
        require SystemPaths::SERVER_TEMPLATES_PATH . '/gantt.php';
    }

    public function projects()
    {
        $clientId = Sessions::getInstance()->getSession("userId");

        $viewParams["profile"] = Model::getInstance()->getProfileInformation(
            $clientId
        );

        require SystemPaths::SERVER_PROJECT_PATH . '/projects.php';
    }

    public function getDatabase()
    {
        require SystemPaths::SERVER_ONE_EXECUTION_PATH . '/ExportDatabase-backup.php';
    }

    public function about()
    {
        require_once SystemPaths::SERVER_TEMPLATES_PATH . "/about.php";
    }

    public function profile()
    {
        require_once SystemPaths::SERVER_CONTROLLERS_PATH . "/profile.php";
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
        require_once SystemPaths::SERVER_CONTROLLERS_PATH . "/project.php";
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
        $_REQUEST["idProjectForAccessLevel"] = $id;
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
        require SystemPaths::SERVER_ERRORS_PATH . '/error404.php';
    }

    public function condenseFilesIntoOne()
    {
        require SystemPaths::SERVER_ONE_EXECUTION_PATH . '/condenseFilesIntoOne.php';
    }

    public function createPOPOfromDatabase()
    {
        require SystemPaths::SERVER_ONE_EXECUTION_PATH . '/createPOPOfromDatabase.php';
    }

    public function accessLevel()
    {
        require_once SystemPaths::SERVER_CONTROLLERS_PATH . '/access.php';
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

        require SystemPaths::SERVER_TEMPLATES_PATH . '/signin.php';
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
        require_once SystemPaths::SERVER_CONTROLLERS_PATH . '/signup.php';
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

        file_put_contents(SystemPaths::CLIENT_PATH . "/sitemap.xml", $sitemapXMLContent);
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
                $templateContent = file_get_contents(SystemPaths::SERVER_TEMPLATES_PATH . "/example.php");
                file_put_contents(
                    SystemPaths::SERVER_TEMPLATES_PATH . "/$routeName.php",
                    $templateContent
                );

                $controllerFunction .= "\n\t\t" . 'require_once \' . SystemPaths::SERVER_TEMPLATES_PATH . \'/' . $routeName . '.php";';
            }

            if ($friendlyURL) {
                $htaccessRoute = "\n#" . $routeName . "\nRewriteRule ^" . $routeName . "[/]?$ ./index.php?ctl=" . $routeName . " [L]";

                $fileWritter = fopen(SystemPaths::CLIENT_PATH . "/.htaccess", "a+");
                fwrite($fileWritter, $htaccessRoute);
                fclose($fileWritter);
            }

            if ($addToAjax) {
                $ajaxFunction = "\n\n\t//Function to $routeName\n" . $controllerFunction;

                $ajaxFunction .= "\n\t\t\$this->genericAjaxReturn(__FUNCTION__, [\"field\"], \"Controller\");";

                $ajaxFunction .= "\n\t}
                ";

                $fileWritter = fopen(SystemPaths::SERVER_CLASSES_PATH . "/AjaxController.php", "a+");
                fwrite($fileWritter, $ajaxFunction);
                fclose($fileWritter);
            }

            if ($addToModel) {
                $modelFunction = $controllerFunction;

                $modelFunction .= "\n\t\t\$sqlUtils = new SQLUtils(\$this);\n\n\t\t\$queryString = \"SELECT * FROM tabla\";\n\t\treturn \$sqlUtils->complexQuery(\$queryString,[]);";

                $modelFunction .= "\n\t}
                ";

                $controllerFunction .= "\n\t\treturn Model::getInstance()->$routeName();";

                $fileWritter = fopen(SystemPaths::SERVER_CLASSES_PATH . "/Model.php", "a+");
                fwrite($fileWritter, $modelFunction);
                fclose($fileWritter);
            }

            $controllerFunction .= "\n\t}
            ";

            $fileWritter = fopen(SystemPaths::SERVER_CLASSES_PATH . "/Controller.php", "a+");
            fwrite($fileWritter, $controllerFunction);
            fclose($fileWritter);

            $fileWritter = fopen(SystemPaths::SERVER_PATH . "/../RoutingMap.php", "a+");
            fwrite($fileWritter, $route);
            fclose($fileWritter);
        }

        require_once SystemPaths::SERVER_ADMIN_PATH . "/newRoute.php";
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
        require_once SystemPaths::SERVER_ONE_EXECUTION_PATH . "/test.php";
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
        require_once SystemPaths::SERVER_ERRORS_PATH . "/maintenance.php";
    }

    public function admin()
    {
        require_once SystemPaths::SERVER_ADMIN_PATH . "/admin.php";
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

        require_once SystemPaths::SERVER_ADMIN_PATH . "/getDataFromTable.php";
    }

    public function profileNotFound()
    {
        require_once SystemPaths::SERVER_PROFILE_PATH . "/profileNotFound.php";
    }

    public function layoutEditor()
    {
        $viewParams = [];

        $templateFiles = FileUtils::getDirContents(SystemPaths::SERVER_TEMPLATES_PATH);

        $groups = [];

        $folderString = "templates\\";
        $folderLen = strlen($folderString);
        foreach ($templateFiles as $templateFile) {
            if (!preg_match("/(\.php)$/m", $templateFile)) {
                continue;
            }

            $templateFile = substr($templateFile, strrpos($templateFile, $folderString) + $folderLen, strlen($templateFile));

            $lastPosOfSeparator = strrpos($templateFile, "\\");
            $groupName = "root";

            if ($lastPosOfSeparator !== false) {
                $groupName = substr($templateFile, 0, $lastPosOfSeparator);
            }

            if (!is_array($groups[$groupName])) {
                $groups[$groupName] = [];
            }

            $groups[$groupName][] = $templateFile;
        }

        $viewParams["files"] = $groups;

        if (Utils::exists("loadFileContent")) {
            $templateName = Utils::getCleanedData("templateName");
            $path = SystemPaths::SERVER_TEMPLATES_PATH . "/$templateName";

            $content = file_get_contents($path);
            $content = htmlentities($content);
            $viewParams["fileContent"] = $content;

            $splittedContent = mb_split("ob_start()", $content);
            eval(substr(5, strlen($splittedContent[0]) - 3));
            //$splittedContent = mb_split("\n", $content);

            //$viewParams["fileContent"] = $splittedContent[0];

            /* echo "<pre id='test'>";
        var_dump($splittedContent[0]);
        echo "</pre>"; */
        }

        require_once SystemPaths::SERVER_ADMIN_PATH . "/layoutEditor.php";
    }
}