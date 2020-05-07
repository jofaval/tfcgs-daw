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
                <div class="form-row d-flex justify-content-space-between text-center mt-3">
                    <div class="custom-control custom-checkbox col">
                        <input type="checkbox" class="custom-control-input" id="onlyOneTable" name="onlyOneTable"
                            checked>
                        <label class="custom-control-label" for="onlyOneTable">Seleccionar tabla específica</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="md-form m-0 col">
                        <input type="text" class="form-control" id="tableName" name="tableName">
                        <label for="tableName">Nombre de la tabla</label>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-space-between">
                    <div class="custom-control custom-checkbox col text-center">
                        <input type="checkbox" class="custom-control-input" id="overrideAccess" name="overrideAccess"
                            checked>
                        <label class="custom-control-label" for="overrideAccess">Sobreescribir el archivo de nivel de
                            acceso</label>
                    </div>
                    <div class="custom-control custom-checkbox col text-center">
                        <input type="checkbox" class="custom-control-input" id="overrideAjaxControllerPHP" checked
                            name="overrideAjaxControllerPHP">
                        <label class="custom-control-label" for="overrideAjaxControllerPHP">Sobreescribir controlador de
                            AJAX de PHP</label>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-space-between">
                    <div class="custom-control custom-checkbox col text-center">
                        <input type="checkbox" class="custom-control-input" id="overrideRouteMap"
                            name="overrideRouteMap" checked>
                        <label class="custom-control-label" for="overrideRouteMap">Sobreescribir el archivo de mapeo de
                            rutas</label>
                    </div>
                    <div class="custom-control custom-checkbox col text-center">
                        <input type="checkbox" class="custom-control-input" id="overrideAjaxControllerJS" checked
                            name="overrideAjaxControllerJS">
                        <label class="custom-control-label" for="overrideAjaxControllerJS">Sobreescribir controlador de
                            AJAX
                            de JS</label>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-space-between">
                    <div class="custom-control custom-checkbox col text-center">
                        <input type="checkbox" class="custom-control-input" id="showTableLog" name="showTableLog"
                            checked>
                        <label class="custom-control-label" for="showTableLog">Mostrar información de cada tabla</label>
                    </div>
                </div>
                <div class="form-row d-flex justify-content-center text-center">
                    <input type="submit" class="btn btn-primary mx-auto col-12" name="createPopo" value="Create POPOs">
                </div>
            </form>
        </div>

        <div class="container">
            <?php
if (isset($_REQUEST["createPopo"])) {
    $DbName = $_REQUEST["dbName"];
    $GLOBALS["settings"]["showTableLog"] = isset($_REQUEST["showTableInfo"]);
    $GLOBALS["settings"]["overrideRouteMap"] = isset($_REQUEST["overrideRouteMap"]);
    $GLOBALS["settings"]["overrideAccess"] = isset($_REQUEST["overrideAccess"]);
    $GLOBALS["settings"]["overrideAjaxControllerPHP"] = isset($_REQUEST["overrideAjaxControllerPHP"]);
    $GLOBALS["settings"]["overrideAjaxControllerJS"] = isset($_REQUEST["overrideAjaxControllerJS"]);
    $GLOBALS["settings"]["onlyOneTable"] = isset($_REQUEST["onlyOneTable"]);
    $GLOBALS["settings"]["tableName"] = $_REQUEST["tableName"];
    createPOPOfromDatabase($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName);
}
?>
        </div>
    </main>
    <script>
    document.querySelector("#dbName").value = "origen";
    </script>
</body>
<script src="/daw/scripts/libs/jquery.min.js"></script>
<script src="/daw/scripts/libs/jquery-ui.min.js"></script>
<script src="/daw/scripts/libs/popper.min.js"></script>
<script src="/daw/scripts/libs/bootstrap.min.js"></script>
<script src="/daw/scripts/libs/bootstrap.bundle.min.js"></script>
<script src="/daw/scripts/libs/mdb.min.js"></script>
<script src="/daw/scripts/libs/jquery.sweet-modal.min.js"></script>
<script src="/daw/scripts/js/Modal.js"></script>
<script src="/daw/scripts/js/utils.js"></script>
<script src="/daw/scripts/js/ViewUtils.js"></script>
<script src="/daw/scripts/js/inputs.js"></script>
<script src="/daw/scripts/js/AjaxController.js"></script>
<script src="/daw/scripts/js/Validator.js"></script>
<script src="/daw/scripts/js/FormValidator.js"></script>
<script src="/daw/scripts/js/preloader.js"></script>
<script src="/daw/scripts/libs/summernote-bs4.min.js"></script>
<script src="/daw/scripts/js/generalScript.js"></script>

</html>