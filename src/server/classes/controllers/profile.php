<?php

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

require_once SystemPaths::SERVER_PROFILE_PATH . "/profile.php";