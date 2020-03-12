<?php

require_once __DIR__ . "/../server/classes/Controller.php";

$mysqlUserName = "test";
$mysqlPassword = "";
$mysqlHostName = "localhost";
$DbName = "database_proyecto_daw_2020";

function createPOPOfromDatabase($host, $user, $pass, $name, $showTableInfo = true)
{
    $mysqli = new mysqli($host, $user, $pass, $name);
    $mysqli->select_db($name);
    $mysqli->query("SET NAMES 'utf8'");

    $queryTables = $mysqli->query('SHOW TABLES');
    while ($row = $queryTables->fetch_row()) {
        $target_tables[] = $row[0];
    }

    $functionNames = ["create", "update", "query", "delete"];

    $filesContent = [];
    $methods = [];
    $controller = "<?php\n\nclass POPOcontroller\n{";
    foreach ($target_tables as $table) {
        $content = "";

        $tableAsClass = camelCase($table, true);
        foreach ($functionNames as $functionName) {
            $methods[] = $functionName . "" . $tableAsClass;
            $controller .= "\n\n\tpublic function $functionName$tableAsClass()\n\t{";
            $controller .= "\n\t\t\$popoInstance = new " . $tableAsClass . "();";
            $controller .= "\n\n\t\t\$popoInstance->$functionName();\n\t}";
        }

        $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
        $TableMLine = $res->fetch_row()[1];
        $splittedLine = explode("\n", $TableMLine);
        unset($splittedLine[0]);
        unset($splittedLine[count($splittedLine)]);

        $primaryKeys = [];
        $tableKeys = [];
        $foreignKeys = [];

        loadKeys($splittedLine, $tableKeys, $foreignKeys, $primaryKeys);

        $everyKey = array_merge($primaryKeys, $tableKeys, $foreignKeys);

        //Table value
        if ($showTableInfo) {
            echo "<h1>$table</h1>";
            echo "<pre>";
            var_dump($splittedLine);
            echo "</pre>";

            echo "<pre>";
            echo "<h2>primaryKeys</h2>";
            var_dump($primaryKeys);
            echo "<h2>tableKeys</h2>";
            var_dump($tableKeys);
            echo "<h2>foreignKeys</h2>";
            var_dump($foreignKeys);
            echo "</pre>";
        }

        $content .= "<?php\n\nclass " . $tableAsClass . " implements CRUD \n{\n\tprivate \$table = \"$table\";\n\n";

        createClassProperties($content, $primaryKeys, $tableKeys, $foreignKeys);

        $content .= "\n";

        addFunctions($content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey);

        $content .= "\n} \n\n\n";

        $filesContent[$tableAsClass] = $content;
    }

    writeToFile("/../server/classes/POPOs/AjaxController.php", $controller);

    $controller .= "\n}";

    if (true) {
        echo "<h1>Clases</h1>";
        echo "<pre>";
        var_dump($filesContent);
        echo "</pre>";

        mapRoutes($methods);

        writeToFile("/../server/classes/POPOs/POPOcontroller.php", $controller);

        if (true) {
            foreach ($filesContent as $key => $value) {
                writeToFile("/../server/classes/POPOs/$key.php", $value);
            }
        }
    }
}

function createPHPajaxController()
{

}

function createClassProperties(&$content, $primaryKeys, $tableKeys, $foreignKeys)
{
    $content .= "\t//Primary Keys";
    foreach ($primaryKeys as $value) {
        $content .= "\n\tprivate \$$value;";
    }

    $content .= "\n\n\t//Table Keys";
    foreach ($tableKeys as $value) {
        $content .= "\n\tprivate \$$value;";
    }

    $content .= "\n\n\t//Foreign Keys";
    foreach ($foreignKeys as $value) {
        $content .= "\n\tprivate \$$value;";
    }
}

function loadKeys($splittedLine, &$tableKeys, &$foreignKeys, &$primaryKeys)
{
    foreach ($splittedLine as $value) {
        $value = trim($value);
        if (!$value) {
            continue;
        }
        $match = [];
        if (preg_match("/^\`/i", $value)) {
            preg_match("/`.+`/i", $value, $match);
            $tableKeys[] = str_replace("`", "", $match[0]);
        } else if (preg_match("/^PRIMARY KEY/i", $value)) {
            preg_match("/`.+`/i", $value, $match);
            $primaryKeys = array_merge($primaryKeys, explode(",", str_replace("`", "", $match[0])));
        } else if (preg_match("/^CONSTRAINT/i", $value)) {
            preg_match("/(?=FOREIGN KEY \(`).+(?<=`\) REFERENCES)/", $value, $match);
            $foreignKey = preg_replace("/(FOREIGN KEY \(`|`\) REFERENCES)/", "", $match[0]);
            $foreignKeys = array_merge($primaryKeys, explode(",", $foreignKey));
        }
    }

    $tableKeys = array_diff($tableKeys, $foreignKeys);
    $tableKeys = array_diff($tableKeys, $primaryKeys);
    $foreignKeys = array_diff($foreignKeys, $primaryKeys);
}

function writeToFile($file, $fileContent)
{
    $fileWriter = fopen(__DIR__ . $file, "w+");
    fwrite($fileWriter, str_replace("\n", PHP_EOL, $fileContent));
    fclose($fileWriter);
}

function mapRoutes($methods)
{
    $mapFile = "<?php\n\n\$map = [";
    $controllerMethods = get_class_methods('Controller');
    foreach ($controllerMethods as $method) {
        $mapFile .= "\n\t'$method' => array('controller' => 'Controller', 'action' => '$method', 'access' => Config::\$ACCESS_LEVEL_GUEST),";
    }
    foreach ($methods as $method) {
        $mapFile .= "\n\t'$method' => array('controller' => 'POPOcontroller', 'action' => '$method', 'access' => Config::\$ACCESS_LEVEL_GUEST),";
    }
    $mapFile .= "\n];";

    writeToFile("/../server/RoutingMap.php", $mapFile);

    $everyRoute = array_merge($controllerMethods, $methods);
    $accessFile = "<?php\n";
    foreach ($everyRoute as $value) {
        $accessFile .= "\n\$map['error']['access'] = Config::\$ACCESS_LEVEL_GUEST);";
    }
    writeToFile("/../server/Access.php", $accessFile);

}

//Create
function createFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\tpublic function create()\n\t{\n\t\t\$sqlUtils = new SQLUtils(Model::getInstance());\n\n\t\t\$params = [";
    foreach ($everyKey as $value) {
        $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
    }
    $content .= "\n\t\t];\n\n\t\treturn \$sqlUtils->insert(\$params);\n\t}";
}

//Update
function updateFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n\tpublic function update()\n\t{\n\t\t\$sqlUtils = new SQLUtils(Model::getInstance());\n\n\t\t\$toModify = [";
    foreach ($tableKeys as $value) {
        $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
    }
    foreach ($foreignKeys as $value) {
        $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
    }
    $content .= "\n\t\t];";

    $content .= "\n\n\t\t\$identificationParams = [";
    foreach ($primaryKeys as $value) {
        $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
    }
    $content .= "\n\t\t];\n\n\t\treturn \$sqlUtils->update(\$this->\$table, \$toModify, \$identificationParams);\n\t}";
}

//Delete
function deleteFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n\tpublic function delete()\n\t{\n\t\t\$sqlUtils = new SQLUtils(Model::getInstance());\n\n\t\t\$params = [";
    foreach ($primaryKeys as $value) {
        $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
    }
    $content .= "\n\t\t];\n\n\t\treturn \$sqlUtils->delete(\$this->\$table, \$params);\n\t}";
}

//Query
function queryFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n\tpublic function query()\n\t{\n\t\t\$sqlUtils = new SQLUtils(Model::getInstance());\n\n\t\t\$params = [";
    foreach ($primaryKeys as $value) {
        $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
    }
    $content .= "\n\t\t];\n\n\t\treturn \$sqlUtils->query(\$this->\$table, \$params);\n\t}";
}

//Enable
function enableFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n\tpublic function enable()\n\t{\n\t\t\$sqlUtils = new SQLUtils(Model::getInstance());\n\n\t\t\$identificationParams = [";
    foreach ($primaryKeys as $value) {
        $content .= "\n\t\t\t\"$value\" => \$this->\$$value,";
    }
    $content .= "\n\t\t];\n\n\t\treturn \$sqlUtils->enable(\$this->\$table, Utils::getCleanedData(\"enable\"), \$identificationParams);\n\t}";
}

//Fill
function fillFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n\n\tpublic function fill()\n\t{";
    foreach ($everyKey as $value) {
        $content .= "\n\t\t\$this->\$$value = Utils::getCleanedData(\"" . camelCase($value) . "\");";
    }
    $content .= "\n\t}";
}

//Parse
function parseFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n\n\tpublic function parse()\n\t{\n\t\treturn json_encode([";
    foreach ($everyKey as $value) {
        $content .= "\n\t\t\t\"" . camelCase($value) . "\" => \$this->\$$value,";
    }
    $content .= "\n\t\t]);\n\t}";
}

function addFunctions(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    createFunction($content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey);
    updateFunction($content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey);
    deleteFunction($content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey);
    queryFunction($content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey);
    enableFunction($content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey);
    fillFunction($content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey);
    parseFunction($content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey);
}

function camelCase($string = "", $firstLetterCapital = false)
{
    if (!$string) {
        return $string;
    }
    $explodedString = preg_split("/[\ \_\-]/", $string);

    foreach ($explodedString as $key => $value) {
        $value = strtolower($value);
        $value[0] = strtoupper($value[0]);
        $explodedString[$key] = $value;
    }

    $parsedString = join("", $explodedString);

    if ($firstLetterCapital) {
        $parsedString[0] = strtoupper($parsedString[0]);
    } else {
        $parsedString[0] = strtolower($parsedString[0]);
    }

    return $parsedString;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/jquery-ui.min.css">
    <link rel="stylesheet" href="./styles/mdb.min.css">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/loader.css">
    <link rel="stylesheet" href="./styles/floating-label.css">
    <link rel="stylesheet" href="./styles/inputs.css">
    <link rel="stylesheet" href="./styles/jquery.sweet-modal.min.css">
</head>

<body>
    <main class="w-100 h-100 align-items-start justify-content-start flex-column">
        <div class="container mx-auto">
            <form action="" class="w-100 bg-white p-5 rounded" method="POST">
                <h2>Crear <span class="font-weight-bold">P</span>lain <span class="font-weight-bold">O</span>ld <span
                        class="font-weight-bold">P</span>HP <span class="font-weight-bold">O</span>bject a partir de una
                    base de datos</h2>
                <select class="custom-select " name="dbName" id="">
                    <?php
$mysqli = new mysqli($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName);
$queryDatabases = $mysqli->query("SHOW DATABASES");

while ($row = $queryDatabases->fetch_row()) {
    $row = $row[0];
    ?> <option value="<?php echo $row; ?>"><?php echo camelCase($row, true); ?></option> <?php
}
?>
                </select>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="showTableInfo" name="showTableInfo">
                    <label class="custom-control-label" for="showTableInfo">Mostrar información de cada tabla</label>
                </div>
                <input type="submit" class="btn btn-primary mx-auto" name="createPopo" value="Create POPOs">
            </form>
        </div>

        <div class="container">
            <?php
if (isset($_REQUEST["createPopo"])) {
    $DbName = $_REQUEST["dbName"];
    createPOPOfromDatabase($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName, isset($_REQUEST["showTableInfo"]));
}
?>
        </div>
    </main>
</body>

</html>