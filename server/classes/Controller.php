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

    public function gantt()
    {
        require __DIR__ . '/../templates/gantt.php';
    }

    public function project()
    {
        $id = 0;
        $viewParams = [
            "title" => "",
            "creation_date" => "",
        ];
        if (Utils::exists("id")) {
            $project = new Projects();
            $projectData = $project->query()[0];
            $viewParams["title"] = $projectData["title"];
            $viewParams["creation_date"] = $projectData["creation_date"];

            $direction = "project";

            if (Utils::exists("element")) {
                $element = Utils::getCleanedData("element");
                if (in_array($element, ["gantt", "tasks", "agenda"])) {
                    $direction = $element;
                }
            }

            require __DIR__ . "/../templates/$direction.php";
        } else {
            header("Location: /daw/projects/");
        }
    }

    public function error404()
    {
        require __DIR__ . '/../templates/error404.php';
    }

    public function accessLevel()
    {
        $content = file_get_contents(__DIR__ . '/../Access.php');

        $explodedContent = explode(PHP_EOL, $content);

        for ($linesToRemove = 0; $linesToRemove < 3; $linesToRemove++) {
            array_shift($explodedContent);
        }

        echo "<form action=''><select name='route'>";
        foreach ($explodedContent as $value) {
            $element = explode(" = ", $value);
            $identification = $element[0];
            //$value = $element[1];

            $regex = '/(?<=\$map\[\').*?(?=\'\]\[\'access\'\])/s';
            $str = '$map[\'error\'][\'access\'] = Config::$ACCESS_LEVEL_GUEST;';

            preg_match($regex, $identification, $matches, PREG_OFFSET_CAPTURE, 0);

            $route = $matches[0][0];
            echo "<option value='$route'>$route</option>";
        }

        echo "</select>
        <select name='access'>
            <option value='0'>Guest</option>
            <option value='1'>Non confirmed</option>
            <option value='2'>Confirmed</option>
            <option value='3'>Admin</option>
        </select>
        <br />
        <input type='submit' name='change' value='Change'>
        </form>";

        //require __DIR__ . '/../templates/accessLevels.php';
    }

    public function signout()
    {
        $sessions = Sessions::getInstance();
        $sessions->setSession("access", 0);
        $sessions->deleteSession("username");
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
            $viewParams["signupUsername"] = Utils::getCleanedData("email");
            $viewParams["signupPassword"] = Utils::getCleanedData("username");
            $viewParams["signupEmail"] = Utils::getCleanedData("password");

            if ($validations === true) {
                $success = $model->signup(
                    Utils::getCleanedData("firstName"),
                    Utils::getCleanedData("secondName"),
                    Utils::getCleanedData("email"),
                    Utils::getCleanedData("username"),
                    Utils::getCleanedData("password"),
                );

                if ($success) {
                    header("Location: /daw/sign-in/");
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