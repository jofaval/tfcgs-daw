<?php

class Model extends PDO
{
    public $conexion;
    public static $instance = null;

    public function __construct()
    {
        $this->$conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        // Realiza el enlace con la BD en utf-8
        $this->$conexion->exec("set names utf8");
        $this->$conexion->exec("SET auto_commit = 0");
        $this->$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Model();
            self::$instance->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
            // Realiza el enlace con la BD en utf-8
            self::$instance->conexion->exec("set names utf8");
            self::$instance->conexion->exec("SET auto_commit = 0");
            self::$instance->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }

    public function query($queryString, $params = [])
    {
        $result = $this->$conexion->prepare($queryString);

        $result->execute($params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cudOperation($insertString, $params = [])
    {
        $result = $this->$conexion->prepare($insertString);

        return $result->execute($params);
    }

    public function disable($entityType, $params, $enabled)
    {
        $queryString = "UPDATE FROM $entityType SET enabled=:enabled WHERE ";

        $keys = [];
        foreach ($params as $key => $value) {
            $keys = "$key=:$key";
        }
        $queryString .= $keys . join(" and ");

        $params["enabled"] = $enabled;
        return $this->cudOperation($queryString, $params);
    }

    public function signin($username, $password)
    {
        $params = ["username" => $username];
        $signin = $this->query("SELECT * FROM users WHERE username=:username", $params);
        if ($signin[0]["password"] == Cryptography::blowfishCrypt($password, $username)) {
            return $signin;
        }
        return false;
    }

    public function signup($firstName, $secondName, $email, $username, $password)
    {

        $params = [
            "email" => $email,
        ];

        //echo "Empieza la transaccion";
        $this->$conexion->beginTransaction();
        try {
            $queryString = 'SELECT *
                        FROM `clients`
                            WHERE `email`=:email';
            $emails = $this->query($queryString, $params);

            //echo "<pre>";
            //var_dump($emails);
            //echo "</pre>";
            if (count($emails) == 0) {
                $params["name"] = $firstName;
                $params["surname"] = $secondName;

                $clientQueryString = 'INSERT Into `clients` (`name`, `surname`, `email`)
                Values (:name, :surname, :email)';
                $client = $this->cudOperation($clientQueryString, $params);

                $queryString = 'SELECT `id`
                FROM `clients`
                    WHERE `email`=:email';
                $clientId = $this->query($queryString, ["email" => $email])[0]["id"];

                //$userImagePath = Config::$EXECUTION_HOME_PATH . "img/users/$username/$username.png";
                $params = [
                    "username" => $username,
                    "password" => Cryptography::blowfishCrypt($password, $username),
                    "id_client" => $clientId,
                    //"imgPath" => $userImagePath,
                ];

                $userQueryString = 'INSERT Into `users` (`id_client`, `username`, `password`, `role`)
                Values (:id_client, :username, :password, 1)';
                $user = $this->cudOperation($userQueryString, $params);

                echo "test";
                echo "<pre>";
                var_dump($user);
                echo "</pre>";

                //echo "Tiene exito";
                $this->$conexion->commit();
                return $client && $user;
            }

            //echo "Ya existe ese cliente";
            $this->$conexion->rollBack();
        } catch (\Throwable $th) {
            echo "<pre>";
            var_dump($th);
            echo "</pre>";
            echo "Ha surgido un error";
            $this->$conexion->rollBack();
        }

        return false;
    }

    public function getEventsFromMonth()
    {
        $params = [
            "month" => Utils::getCleanedData("month"),
            "year" => Utils::getCleanedData("year"),
        ];

        return $this->query("SELECT * FROM events WHERE MONTH(selectedDay)=:month and YEAR(selectedDay)=:year", $params);
    }

    public function test()
    {
        $params = [
            "orderId" => 1,
        ];

        return $this->query("SELECT * FROM `schedules` WHERE orderId=:orderId", $params);
    }

    public function getCommentsOfDashboardItem($id_dashboard_item)
    {
        $sqlUtils = new SQLUtils($this);

        return $sqlUtils->complexQuery("SELECT CONCAT(clients.name, ' ', clients.surname) as 'commentCreatorName', users.username as 'commentCreatorUsername',
        dashboard_item_comments.creation_date as 'commentDate', dashboard_item_comments.comment, dashboard_item_comments.id
        FROM `dashboard_item_comments` LEFT JOIN `clients` on (dashboard_item_comments.id_creator = clients.id)
            LEFT JOIN `users` on (clients.id = users.id_client)
            WHERE dashboard_item_comments.id_dashboard_item = :id_dashboard_item", ["id_dashboard_item" => $id_dashboard_item]);
    }

    public function getProjectsOfUser($userId)
    {
        $sqlUtils = new SQLUtils($this);

        return $sqlUtils->complexQuery("SELECT projects.id, projects.title, projects.description,
        projects.id_creator = :id_creator as created,
        projects.id in (select bookmarked.id_project from bookmarked where bookmarked.id_client = :id_creator) as bookmarked
        FROM `projects`
            WHERE `enabled` = 1 and (projects.id_creator = :id_creator or :id_creator in
                (SELECT collaborators.id_collaborator
                     FROM collaborators
                         WHERE `enabled` = 1 and collaborators.id_project = projects.id))", ["id_creator" => $userId]);
    }

    public function getProjectDetails($id_project, $userId)
    {
        $sqlUtils = new SQLUtils($this);

        $finalArray = [];

        $projectDetails = $sqlUtils->complexQuery("SELECT projects.title as 'projectTitle', projects.description as 'projectDescription',
        CONCAT(clients.name, ' ', clients.surname) as 'projectCreator', users.username as 'projectCreatorUsername', projects.creation_date as 'projectCreationDate'
        FROM `projects` LEFT JOIN `collaborators` on (projects.id = collaborators.id_project)
            LEFT JOIN `permissions` on (collaborators.level = permissions.level)
            LEFT JOIN `clients` on (collaborators.id_collaborator = clients.id) or (projects.id_creator = clients.id)
            LEFT JOIN `users` on (clients.id = users.id_client)
            WHERE projects.id = :id_project", [/* "id_creator" => $userId,  */"id_project" => $id_project])[0];

        $finalArray = array_merge($finalArray, $projectDetails);

        $collaboratorDetails = $sqlUtils->complexQuery("SELECT CONCAT(clients.name, ' ', clients.surname) as 'collaboratorName', users.username as 'collaboratorUsername',
        collaborators.starting_date as 'collaborationStartingDate', collaborators.id_collaborator as 'collaborator', collaborators.invited_by as 'collaboratorInvitedBy',
        permissions.title as 'collaborationRole', permissions.description as 'collaborationRoleDescription'
        FROM `clients` LEFT JOIN `users` on (clients.id = users.id_client)
        LEFT JOIN `collaborators` on (collaborators.id_collaborator = clients.id)
        LEFT JOIN `projects` on (collaborators.id_project = projects.id)
        LEFT JOIN `permissions` on (collaborators.level = permissions.level)
        WHERE collaborators.id_collaborator = :id_creator and projects.id = :id_project", ["id_creator" => $userId, "id_project" => $id_project])[0];
        if (is_null($collaboratorDetails)) {
            return $finalArray;
        }
        $finalArray = array_merge($finalArray, $collaboratorDetails);

        $userDetails = $sqlUtils->complexQuery("SELECT CONCAT(clients.name, ' ', clients.surname) as 'collaboratorInviteName', users.username as 'collaboratorInviteUsername'
        FROM `clients` LEFT JOIN `users` on (clients.id = users.id_client)
        WHERE clients.id = :id_creator", ["id_creator" => $collaboratorDetails["collaboratorInvitedBy"]])[0];
        $finalArray = array_merge($finalArray, $userDetails);

        return $finalArray;
    }

    public function getDashboardsOfProject($id_project)
    {
        $sqlUtils = new SQLUtils($this);

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

    public function getCollaboratorsOfProject($id_project, $limit)
    {
        $sqlUtils = new SQLUtils($this);

        $params = [
            "id_project" => $id_project,
        ];

        $queryString = "SELECT CONCAT(clients.name, ' ', clients.surname) as 'collaboratorName', users.username as 'collaboratorUsername',
        collaborators.starting_date as 'collaborationStartingDate', permissions.title as 'collaborationRole', permissions.description as 'collaborationRoleDescription'
        FROM `collaborators` LEFT JOIN `permissions` on (collaborators.level = permissions.level)
            LEFT JOIN `clients` on (collaborators.id_collaborator = clients.id)
            LEFT JOIN `users` on (clients.id = users.id_client)
            WHERE collaborators.id_project = :id_project
            ORDER BY collaborators.starting_date DESC";

        if ($limit != "") {
            $limit = (int) $limit;
            $params["limit"] = $limit;
            $queryString .= "    LIMIT :limit";
        }

        return $sqlUtils->complexQuery($queryString, $params);
    }

    public function getDashboardItemsOfList($id_dashboard_list)
    {
        $sqlUtils = new SQLUtils($this);

        $queryString = "SELECT id, title, description, `order`, creation_date as creationDate, id_dashboard_list, enabled
        FROM `dashboard_item`
        WHERE  enabled = 1 and id_dashboard_list=:id_dashboard_list
        ORDER BY `order` ASC";

        return $sqlUtils->complexQuery($queryString, ["id_dashboard_list" => $id_dashboard_list]);
    }

    public function getListsOfDashboard($id_project, $dashboard_title)
    {
        $sqlUtils = new SQLUtils($this);

        $queryString = "SELECT id, id_project, title, order_criteria as orderCriteria, creation_date as creationDate
        FROM `dashboard_list`
        WHERE enabled = 1 and id_project = :id_project and dashboard_title = :dashboard_title";

        return $sqlUtils->complexQuery($queryString, ["id_project" => $id_project, "dashboard_title" => $dashboard_title]);
    }

    public function getProfileInformation($clientId)
    {
        $sqlUtils = new SQLUtils($this);

        $queryString = "SELECT users.username,
        clients.name, clients.surname, clients.email, clients.website, clients.biography
        FROM clients JOIN users ON (clients.id = users.id_client)
        LEFT JOIN roles on (users.role = roles.level)
            WHERE clients.id = :id_client";

        return $sqlUtils->complexQuery($queryString, [
            "id_client" => $clientId,
        ])[0];
    }

    public function updateProfile($clientId, $name, $surname, $email, $biography)
    {
        $sqlUtils = new SQLUtils($this);

        return $sqlUtils->update("clients", [
            "name" => $name,
            "surname" => $surname,
            "email" => $email,
            "biography" => $biography,
        ], [
            "id" => $clientId,
        ]);
    }

    public function updatePassword($clientId, $password, $oldPassword)
    {
        $sqlUtils = new SQLUtils($this);

        $currentUserRow = $sqlUtils->query("users", [
            "id_client" => $clientId,
        ])[0];

        $username = $currentUserRow["username"];

        if ($currentUserRow["password"] != Cryptography::blowfishCrypt($oldPassword, $username)) {
            return false;
        }

        return $sqlUtils->update("users", [
            "password" => Cryptography::blowfishCrypt($password, $username),
        ], [
            "id_client" => $clientId,
        ]);
    }

    public function updateProjectDetails($id, $title, $description)
    {
        $sqlUtils = new SQLUtils($this);

        return $sqlUtils->update("projects", [
            "title" => $title,
            "description" => $description,
        ], [
            "id" => $id,
        ]);
    }

    public function getProjectNumbers($id_project)
    {
        $sqlUtils = new SQLUtils($this);

        $finalArray = [];

        $numberOfDashboards = $sqlUtils->complexQuery("SELECT COUNT(title) as 'numberOfDashboards' FROM dashboards
        WHERE id_project = :id_project", ["id_project" => $id_project])[0];

        $finalArray = array_merge($finalArray, $numberOfDashboards);

        $numberOfCollaborators = $sqlUtils->complexQuery("SELECT COUNT(id_project) as 'numberOfCollaborators' FROM collaborators
        WHERE id_project = :id_project
        ", ["id_project" => $id_project])[0];

        $finalArray = array_merge($finalArray, $numberOfCollaborators);

        return $finalArray;
    }

    public function getAssignationDataFromItem($id_dashboard_item, $userId)
    {
        $sqlUtils = new SQLUtils($this);

        return $sqlUtils->complexQuery("SELECT id, id_dashboard_item, finished, assigned_by, assigned_to, start_date, end_date
        FROM dashboards_item_assignation
        WHERE id_dashboard_item = :id_dashboard_item and assigned_to = :assigned_to
        ", ["id_dashboard_item" => $id_dashboard_item, "assigned_to" => $userId])[0];
    }

    public function getAssignedDashboardItems($id_project, $userId)
    {
        $sqlUtils = new SQLUtils($this);

        $queryString = "SELECT dashboard_item.title, id_dashboard_item, finished, assigned_by, assigned_to, start_date, end_date, dashboard_list.dashboard_title
        FROM dashboards_item_assignation LEFT JOIN dashboard_item on (dashboards_item_assignation.id_dashboard_item = dashboard_item.id)
        LEFT JOIN dashboard_list on (dashboard_item.id_dashboard_list = dashboard_list.id)
        WHERE assigned_to = :assigned_to or assigned_by = :assigned_to
        and id_dashboard_item in (
            SELECT dashboard_item.id FROM dashboard_item
            	WHERE dashboard_item.id_dashboard_list IN
            (SELECT dashboard_list.id FROM dashboard_list
            	WHERE dashboard_list.id_project = :id_project)
        )
        ORDER BY end_date ASC";
        $params = [
            "id_project" => $id_project,
            "assigned_to" => $userId,
        ];

        if ($limit != "") {
            $queryString .= " LIMIT :limit";
            $params["limit"] = 3;
        }

        return $sqlUtils->complexQuery($queryString, $params);
    }

    public function getOrderNumberOfList($id_dashboard_list)
    {
        $sqlUtils = new SQLUtils($this);

        return $sqlUtils->complexQuery("SELECT COUNT(*) as 'currentOrder' FROM dashboard_item
            	WHERE dashboard_item.id_dashboard_list = :id_dashboard_list
        ORDER BY `order` ASC", ["id_dashboard_list" => $id_dashboard_list])[0]["currentOrder"];
    }

    public function updateOrderInDashboardList($id_dashboard_list, $order)
    {
        $sqlUtils = new SQLUtils($this);

        $queryString = "UPDATE dashboard_item
        SET `order` = (`order`+1)
        WHERE id_dashboard_list = :id_dashboard_list
        and `order`>= :order";

        return $sqlUtils->complexQuery($queryString, ["id_dashboard_list" => $id_dashboard_list, "order" => $order]);
    }

    public function reorganizeOrderInDashboardList($id_dashboard_list)
    {
        $sqlUtils = new SQLUtils($this);

        $queryString = "SET @row_number = 0;
        UPDATE dashboard_item SET `order` = (@row_number:=@row_number + 1)
        WHERE id_dashboard_list = :id_dashboard_list
        ORDER BY `order` ASC";

        return $sqlUtils->complexQuery($queryString, ["id_dashboard_list" => $id_dashboard_list]);
    }

    public function searchUsers($username)
    {
        $sqlUtils = new SQLUtils($this);

        $queryString = "SELECT username FROM users
        WHERE username like :username LIMIT 5";
        return $sqlUtils->complexQuery($queryString, ["username" => "%$username%"]);
    }

    public function getDashboardItemDetails($id)
    {
        $sqlUtils = new SQLUtils($this);

        $queryString = "SELECT creation_date, username, CONCAT(clients.name, ' ', clients.surname) as 'fullname'
        FROM dashboard_item LEFT JOIN users on (dashboard_item.id_creator=users.id_client)
        LEFT JOIN clients on (users.id_client = clients.id)
        WHERE dashboard_item.id = :id";
        return $sqlUtils->complexQuery($queryString, ["id" => $id])[0];
    }

    public function getRecentlyCreated($id_project)
    {
        $sqlUtils = new SQLUtils($this);

        $queryString = "SELECT dashboard_item.creation_date, dashboard_item.id, dashboard_item.id_creator, dashboard_item.title, dashboard_list.dashboard_title,
        username
        FROM dashboard_item LEFT JOIN users on (dashboard_item.id_creator = users.id_client)
        LEFT JOIN dashboard_list on (dashboard_item.id_dashboard_list = dashboard_list.id)
        WHERE dashboard_item.enabled = 1 and dashboard_item.id in (
            SELECT dashboard_item.id FROM dashboard_item
            	WHERE dashboard_item.id_dashboard_list IN
            (SELECT dashboard_list.id FROM dashboard_list
            	WHERE dashboard_list.id_project = :id_project)
        )
        ORDER BY dashboard_item.creation_date DESC LIMIT 3";
        $params = [
            "id_project" => $id_project,
        ];

        return $sqlUtils->complexQuery($queryString, $params);
    }

    public function getProjectAccessLevel($id_project, $userId)
    {
        $sqlUtils = new SQLUtils($this);

        $queryString = "SELECT * FROM projects WHERE id=:id_project";

        $params = [
            "id" => $id_project,
        ];

        $queryCreatorResult = $sqlUtils->query("projects", $params, "id_creator");

        if ($queryCreatorResult[0]["id_creator"] == $userId) {
            return Config::$PROJECT_ACCESS_CREATOR;
        }

        $queryString = "SELECT `level` FROM collaborators
        WHERE id_project=:id_project and id_collaborator=:id_collaborator";

        $params = [
            "id_project" => $id_project,
            "id_collaborator" => $userId,
        ];

        return (int) $sqlUtils->complexQuery($queryString, $params)[0]["level"];
    }
}
