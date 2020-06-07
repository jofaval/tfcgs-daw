<?php

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
require SystemPaths::SERVER_TEMPLATES_PATH . '/signin.php';