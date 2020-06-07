<?php
$filePath = SystemPaths::SERVER_PATH . '/Access.php';
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

require SystemPaths::SERVER_ADMIN_PATH . '/accessLevel.php';