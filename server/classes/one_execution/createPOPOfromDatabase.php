<?php

require_once __DIR__ . "/../Controller.php";

$mysqlUserName = "test";
$mysqlPassword = "";
$mysqlHostName = "localhost";
$DbName = "origen";

$settings = [
    "showTableLog" => false,
    "overrideRouteMap" => false,
    "overrideAccess" => false,
    "overrideAjaxControllerPHP" => false,
    "overrideAjaxControllerJS" => false,
];

function createPOPOfromDatabase($host, $user, $pass, $name)
{
    //Me conecto a la base de datos
    $mysqli = new mysqli($host, $user, $pass, $name);
    //Selecciono la base de datos
    $mysqli->select_db($name);
    //Fijo los carácteres a utf8
    $mysqli->query("SET NAMES 'utf8'");

    //Almaceno todas las tablas de la base de datos en la variable $target_tables
    $queryTables = $mysqli->query('SHOW TABLES');
    while ($row = $queryTables->fetch_row()) {
        $target_tables[] = $row[0];
    }

    //Nombres de las funciones que se van a implementar
    $functionNames = ["create", "update", "query", "delete"];

    //Creo las variables de contenido
    $filesContent = [];
    $methods = [];
    $methodParams = [];
    //Inicializo la clase de controller
    $controller = "<?php\n\nclass POPOcontroller\n{";

    //Recorro todas las tablas que se han recogido
    foreach ($target_tables as $table) {
        $content = "";

        //cambio el nombre de la tabla a NomeclaturaCamello
        $tableAsClass = camelCase($table, true);

        //Recogo la creacion de la tabla
        $res = $mysqli->query('SHOW CREATE TABLE ' . $table);
        $TableMLine = $res->fetch_row()[1];
        $splittedLine = explode("\n", $TableMLine);
        //Elimino la primera y última línea del Create table (las líneas de "CREATE TABLE tabla (" y ");")
        unset($splittedLine[0]);
        unset($splittedLine[count($splittedLine)]);

        //Recogo todos los campos y las claves primarias y ajenas de la tabla
        $primaryKeys = [];
        $tableKeys = [];
        $foreignKeys = [];
        loadKeys($splittedLine, $tableKeys, $foreignKeys, $primaryKeys);
        $everyKey = array_merge($primaryKeys, $tableKeys, $foreignKeys);

        //Implemento las funciones CRUD de la tabla para el POPO
        createFunctionsOfTable($functionNames, $methods, $tableAsClass, $methodParams, $controller, $everyKey, $primaryKeys);

        //Se muestra la información de la tabla
        if ($settings["showTableLog"]) {
            showTableLog($table, $splittedLine, $primaryKeys, $tableKeys, $foreignKeys);
        }

        //Se crea la clase POPO
        $content .= "<?php\n\nclass " . $tableAsClass . " implements CRUD \n{\n    private \$table = \"$table\";\n\n";
        //Se recogen las propiedades de la tabla para introducirlas en las clases
        createClassProperties($content, $primaryKeys, $tableKeys, $foreignKeys);
        $content .= "\n";
        //Relleno los campos al inicializar la clase POPO
        $content .= "\npublic function __construct()
                    {
                    \$this->fill();
                    }";
        //Creo las respectivas funciones
        addFunctions($content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey);
        $content .= "\n} \n\n\n";

        //Añado como archivo a crear el contenido para guardarlo en un archivo con el nombre de la clase
        $filesContent[$tableAsClass] = $content;
    }

    //Se crea/sobreescribe el controlador de AJAX para PHP
    if ($settings["overrideAjaxControllerPHP"]) {
        createPHPajaxController($methods, $methodParams);
    }

    //Se crea/sobreescribe el controlador de AJAX para JS
    if ($settings["overrideAjaxControllerJS"]) {
        createJSajaxController($methods, $methodParams);
    }

    $controller .= "\n}";

    //Se ejecuta la creación de los archivos y el respectivo controlador de POPOs, dentro de un if para depurar más fácilmente
    if (true) {
        echo "<h1>Clases</h1>";
        echo "<pre>";
        var_dump($filesContent);
        echo "</pre>";

        mapRoutes($methods);

        writeToFile("/../POPOs/POPOcontroller.php", $controller);

        if (true) {
            foreach ($filesContent as $key => $value) {
                writeToFile("/../POPOs/$key.php", $value);
            }
        }
    }
}

//Crea las funciones para el controlador de POPO
function createFunctionsOfTable($functionNames, &$methods, $tableAsClass, &$methodParams, &$controller, &$everyKey, &$primaryKeys)
{
    foreach ($functionNames as $functionName) {
        $methods[] = $functionName . "" . $tableAsClass;
        switch ($functionName) {
            case 'create':
            case 'update':
                $methodParams[] = $everyKey;
                break;
            case 'query':
            case 'delete':
                $methodParams[] = $primaryKeys;
                break;
        }
        $controller .= "\n\n    public function $functionName$tableAsClass()\n    {";
        $controller .= "\n        \$popoInstance = new " . $tableAsClass . "();";
        $controller .= "\n\n        return \$popoInstance->$functionName();\n    }";
    }
}

//Muestra la información que se ha recogido de cada tabla de la base de datos
function showTableLog($table, $splittedLine, $primaryKeys, $tableKeys, $foreignKeys)
{
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

//Crea el controlador de AJAX para JS
function createJSajaxController($methods, $methodParams)
{
    $jsAjaxController = "class AjaxController {";
    $jsAjaxController .= "\n    static request(requestLocation, requestType = \"POST\", params = {}, success = AjaxController.defaultAjaxSuccessAction, error = AjaxController.defaultAjaxErrorAction, async = true) {\n        $.ajax({\n            url: 'index.php?ctl=' + requestLocation,\n            data: params,\n            type: requestType,\n            async: async,\n            success: success,\n            error: error,\n        });\n    }";
    $jsAjaxController .= "\n\n    //When AJAX is succesful\n    static defaultAjaxSuccessAction(data) {\n    }\n\n    //When AJAX has some errors\n    static defaultAjaxErrorAction(data) {\n        sendNotification(\"Ha surgido un error al realizar la operación\", true);\n    }";
    $jsAjaxController .= "\n\n    //Generic request for AJAX\n    static genericAjaxRequest(requestName, params, success, error = null) {\n        if (error == null) {\n            error = function (data) {\n                sendNotification(\"Couldn't execute operation succesfully\", true);\n            };\n        }\n\n        AjaxController.request(requestName, \"POST\", params, success, error);\n    }";

    foreach ($methods as $key => $value) {
        $requiredParams = $methodParams[$key];
        $jsAjaxController .= "\n\n    //Function to $value";
        $jsAjaxController .= "\n    static " . $value . "(" . join(", ", $requiredParams) . ")\n    {\n        AjaxController.genericAjaxRequest(\"$value\", {";
        if (count($methodParams[$key]) > 0) {
            foreach ($requiredParams as $requiredParam) {
                $jsAjaxController .= "\n            \"$requiredParam\": $requiredParam,";
            }
        }
        $jsAjaxController .= "\n        }, success);\n    }";
    }

    $jsAjaxController .= "\n}";
    writeToFile("/../../../client/scripts/js/AjaxController.js", $jsAjaxController);
}

//Crea el controlador de AJAX para PHP
function createPHPajaxController($methods, $methodParams)
{
    $phpAjaxController = "<?php\nclass AjaxController\n{";
    $phpAjaxController .= "\n    public function genericAjaxReturn(\$functionName, \$requiredParams = [])\n    {\n        try {\n            if (!empty(\$requiredParams)) {\n                \$this->throwIfExceptionIfDoesntExist(\$requiredParams);\n            }\n            \$mainController = \"POPOController\";\n            if (method_exists(\$mainController, \$functionName)) {\n                \$result = call_user_func([new \$mainController, \$functionName]);\n                echo json_encode(\$result);\n            } else {\n                \$this->returnError();\n            }\n        } catch (Throwable \$th) {\n            if (Config::\$developmentMode) {\n                \$this->returnError(\$th->getMessage());\n            } else {\n                \$this->returnError();\n            }\n        }\n    }";
    $phpAjaxController .= "\n\n    public function throwIfExceptionIfDoesntExist(\$elems)\n    {\n        foreach (\$elems as \$elem) {\n            if (!isset(\$_REQUEST[\$elem])) {\n                throw new Error(\"\$elem doesn't exist\");\n            }\n        }\n    }";
    $phpAjaxController .= "public function returnError(\$message = \"\")\n    {\n        \$object = [\n                \"error\" => true,\n        ];\n        if (\$message != \"\") {\n            \$object[\"message\"] = \$message;\n        }\n        \$json = json_encode(\$object);\n        echo \$json;\n        exit;\n    }";

    foreach ($methods as $key => $value) {
        $phpAjaxController .= "\n\n    //Function to $value";
        $phpAjaxController .= "\n    public function " . $value . "()\n    {\n        \$this->genericAjaxReturn(__FUNCTION__";
        $requiredParams = $methodParams[$key];
        if (count($methodParams[$key]) > 0) {
            foreach ($requiredParams as $key => $value) {
                $requiredParams[$key] = "\"$value\"";
            }
            $phpAjaxController .= ", [" . join(", ", $requiredParams) . "]";
        }
        $phpAjaxController .= ");\n    }";
    }

    $phpAjaxController .= "\n}";
    writeToFile("/../AjaxController.php", $phpAjaxController);
}

//Añade las propiedades de la clase POPO en un orden específico
function createClassProperties(&$content, $primaryKeys, $tableKeys, $foreignKeys)
{
    $content .= "    //Primary Keys";
    foreach ($primaryKeys as $value) {
        $content .= "\n    private \$$value;";
    }

    $content .= "\n\n    //Table Keys";
    foreach ($tableKeys as $value) {
        $content .= "\n    private \$$value;";
    }

    $content .= "\n\n    //Foreign Keys";
    foreach ($foreignKeys as $value) {
        $content .= "\n    private \$$value;";
    }
}

//Extrae del script CREATE TABLE anterior todas las claves
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

//Función para sobreescribir un fichero
function writeToFile($file, $fileContent)
{
    $fileWriter = fopen(__DIR__ . $file, "w+");
    fwrite($fileWriter, str_replace("\n", PHP_EOL, $fileContent));
    fclose($fileWriter);
}

//Crea las rutas del mapeo y niveles de acceso
function mapRoutes($methods)
{
    if ($settings["overrideRouteMap"]) {
        $mapFile = "<?php\n\n\$map = [";
        $controllerMethods = get_class_methods('Controller');
        foreach ($controllerMethods as $method) {
            $mapFile .= "\n    '$method' => array('controller' => 'Controller', 'action' => '$method', 'access' => Config::\$ACCESS_LEVEL_GUEST),";
        }
        foreach ($methods as $method) {
            $mapFile .= "\n    '$method' => array('controller' => 'AjaxController', 'action' => '$method', 'access' => Config::\$ACCESS_LEVEL_GUEST),";
        }
        $mapFile .= "\n];";
        writeToFile("/../../RoutingMap.php", $mapFile);
    }

    if ($settings["overrideAccess"]) {
        $everyRoute = array_merge($controllerMethods, $methods);
        $accessFile = "<?php\n";
        foreach ($everyRoute as $value) {
            $accessFile .= "\n\$map['error']['access'] = Config::\$ACCESS_LEVEL_GUEST;";
        }
        writeToFile("/../../Access.php", $accessFile);
    }

}

//Create POPO
function createFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n    public function create()\n    {\n        \$sqlUtils = new SQLUtils(Model::getInstance());\n\n        \$params = [";
    foreach ($everyKey as $value) {
        $content .= "\n            \"$value\" => \$this->$value,";
    }
    $content .= "\n        ];\n\n        return \$sqlUtils->insert(\$params);\n    }";
}

//Update POPO
function updateFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n    public function update()\n    {\n        \$sqlUtils = new SQLUtils(Model::getInstance());\n\n        \$toModify = [";
    foreach ($tableKeys as $value) {
        $content .= "\n            \"$value\" => \$this->$value,";
    }
    foreach ($foreignKeys as $value) {
        $content .= "\n            \"$value\" => \$this->$value,";
    }
    $content .= "\n        ];";

    $content .= "\n\n        \$identificationParams = [";
    foreach ($primaryKeys as $value) {
        $content .= "\n            \"$value\" => \$this->$value,";
    }
    $content .= "\n        ];\n\n        return \$sqlUtils->update(\$this->\$table, \$toModify, \$identificationParams);\n    }";
}

//Delete POPO
function deleteFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n    public function delete()\n    {\n        \$sqlUtils = new SQLUtils(Model::getInstance());\n\n        \$params = [";
    foreach ($primaryKeys as $value) {
        $content .= "\n            \"$value\" => \$this->$value,";
    }
    $content .= "\n        ];\n\n        return \$sqlUtils->delete(\$this->\$table, \$params);\n    }";
}

//Query POPO
function queryFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n    public function query()\n    {\n        \$sqlUtils = new SQLUtils(Model::getInstance());\n\n        \$params = [";
    foreach ($primaryKeys as $value) {
        $content .= "\n            \"$value\" => \$this->$value,";
    }
    $content .= "\n        ];\n\n        return \$sqlUtils->query(\$this->\$table, \$params);\n    }";
}

//Enable POPO
function enableFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n    public function enable()\n    {\n        \$sqlUtils = new SQLUtils(Model::getInstance());\n\n        \$identificationParams = [";
    foreach ($primaryKeys as $value) {
        $content .= "\n            \"$value\" => \$this->$value,";
    }
    $content .= "\n        ];\n\n        return \$sqlUtils->enable(\$this->\$table, Utils::getCleanedData(\"enable\"), \$identificationParams);\n    }";
}

//Fill POPO
function fillFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n\n    public function fill()\n    {";
    foreach ($everyKey as $value) {
        $content .= "\n        \$this->$value = Utils::getCleanedData(\"" . camelCase($value) . "\");";
    }
    $content .= "\n    }";
}

//Parse POPO
function parseFunction(&$content, $primaryKeys, $tableKeys, $foreignKeys, $everyKey)
{
    $content .= "\n\n\n    public function parse()\n    {\n        return json_encode([";
    foreach ($everyKey as $value) {
        $content .= "\n            \"" . camelCase($value) . "\" => \$this->$value,";
    }
    $content .= "\n        ]);\n    }";
}

//Añadir las funciones anteriores de POPO
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

//Pasar a camel case
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
<!--El formulario para realizar las peticiones-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Database Mapping</title>
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
                <select class="custom-select " name="dbName" id="dbName">
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
                    <input type="checkbox" class="custom-control-input" id="showTableLog" name="showTableLog" checked>
                    <label class="custom-control-label" for="showTableLog">Mostrar información de cada tabla</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="overrideRouteMap" name="overrideRouteMap"
                        checked>
                    <label class="custom-control-label" for="overrideRouteMap">Sobreescribir el archivo de mapeo de
                        rutas</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="overrideAccess" name="overrideAccess"
                        checked>
                    <label class="custom-control-label" for="overrideAccess">Sobreescribir el archivo de nivel de
                        acceso</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="overrideAjaxControllerPHP" checked
                        name="overrideAjaxControllerPHP">
                    <label class="custom-control-label" for="overrideAjaxControllerPHP">Sobreescribir controlador de
                        AJAX de PHP</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="overrideAjaxControllerJS" checked
                        name="overrideAjaxControllerJS">
                    <label class="custom-control-label" for="overrideAjaxControllerJS">Sobreescribir controlador de AJAX
                        de JS</label>
                </div>
                <input type="submit" class="btn btn-primary mx-auto" name="createPopo" value="Create POPOs">
            </form>
        </div>

        <div class="container">
            <?php
if (isset($_REQUEST["createPopo"])) {
    $DbName = $_REQUEST["dbName"];
    $settings["showTableLog"] = isset($_REQUEST["showTableInfo"]);
    $settings["overrideRouteMap"] = isset($_REQUEST["overrideRouteMap"]);
    $settings["overrideAccess"] = isset($_REQUEST["overrideAccess"]);
    $settings["overrideAjaxControllerPHP"] = isset($_REQUEST["overrideAjaxControllerPHP"]);
    $settings["overrideAjaxControllerJS"] = isset($_REQUEST["overrideAjaxControllerJS"]);
    createPOPOfromDatabase($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName);
}
?>
        </div>
    </main>
    <script>
    document.querySelector("#dbName").value = "origen";
    </script>
</body>

</html>