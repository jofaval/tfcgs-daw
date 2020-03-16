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

    public function signout()
    {
        $sessions = Sessions::getInstance();
        $sessions->setSession("access", 0);
        $sessions->deleteSession("username");
        header("Location: /daw/sign-in/");
    }

    public function signin()
    {
        $result = false;
        $viewParams = [
            "error" => "",
            "signinUsername" => "",
            "signinPassword" => "",
            "signupFirstName" => "",
            "signupSecondName" => "",
            "signupUsername" => "",
            "signupPassword" => "",
            "signupEmail" => "",
        ];
        if (Utils::exists("signin")) {
            $result = ExceptionUtils::tryCatch("Controller", "signinFunctionality");

            $viewParams["signinUsername"] = Utils::getCleanedData("username");
            $viewParams["signinPassword"] = Utils::getCleanedData("password");

            if ($result) {
                header("Location: ../projects/");
            } else {
                $viewParams["error"] = "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>
                <p class='m-0'>Error: We couldn't sign you in.</p>\n
                </div>";
            }
        }
        require __DIR__ . '/../templates/signin.php';
    }

    public function signup()
    {
        $viewParams = [
            "error" => "",
            "signinUsername" => "",
            "signinPassword" => "",
            "signupFirstName" => "",
            "signupSecondName" => "",
            "signupUsername" => "",
            "signupPassword" => "",
            "signupEmail" => "",
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

            if ($validations === true) {
                $success = $model->signup(
                    Utils::getCleanedData("firstName"),
                    Utils::getCleanedData("secondName"),
                    Utils::getCleanedData("email"),
                    Utils::getCleanedData("username"),
                    Utils::getCleanedData("password"),
                );

                $viewParams["signupFirstName"] = Utils::getCleanedData("firstName");
                $viewParams["signupSecondName"] = Utils::getCleanedData("secondName");
                $viewParams["signupUsername"] = Utils::getCleanedData("email");
                $viewParams["signupPassword"] = Utils::getCleanedData("username");
                $viewParams["signupEmail"] = Utils::getCleanedData("password");

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

    public function signinFunctionality()
    {
        $model = Model::getInstance();
        $validation = Validation::getInstance();
        $sessions = Sessions::getInstance();

        $username = Utils::getCleanedData("inputUsername");
        $password = Utils::getCleanedData("inputPassword");
        $validation = $validation->rules($regla, ["username" => $username, "password" => $password]);
        $validation = true;

        if ($validation === true) {
            $signin = $model->signin($username, $password);
            if ($signin) {
                $sessions->setSession("username", $username);
                $sessions->setSession("access", $signin[0]["level"]);
                header("Location: /daw/projects/");
            }
        }

        return false;
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