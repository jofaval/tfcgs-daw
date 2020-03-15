<?php
include_once '/../libs/utils.php';
include_once '/../libs/bEmail.php';
include_once '/../libs/bFile.php';
include_once '/../libs/bCrypt.php';
include_once 'Validation.php';
include_once 'Sessions.php';

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

    public function signin()
    {
        $result = false;
        if (isset($_REQUEST["signin"])) {
            $result = ExceptionUtils::tryCatch("Controller", "signinFunctionality");

            if ($result) {
                header("Location: ../projects/");
            } else {
                echo "<div class='p-3 m-5 mb-0 btn btn-danger rounded position-absolute fixed-bottom float-right' onclick='this.remove();'>";
                echo "<p class='m-0'>Error: We couldn't sign you in.</p>\n";
                echo "</div>";
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

        $regla = array(
            array(
                'name' => 'username',
                'regla' => 'no-empty,username',
            ),
            array(
                'name' => 'password',
                'regla' => 'no-empty,password',
            ),
        );
        $validation = $validation->rules($regla, ["username" => $username, "password" => $password]);
        $validation = true;

        if ($validation === true) {
            $signin = $model->signin($username);
            if (Cryptography::blowfishCrypt($password, $username) == $signin[0]["password"]) {
                $sessions->setSession("username", $username);
                $sessions->setSession("access", $signin[0]["type"]);
                $sessions->setSession("userImg", $signin[0]["image"]);
                header("Location: ../projects/");
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