<!--Page configuration-->
<?php $optionalCSS = ["summernote-bs4.min.css"];?>
<?php $optionalScripts = ["libs/summernote-bs4.min.js", "js/admin/layoutEditor.js"];?>
<?php $title = "Editor de templates";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>

<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Admin",
        "link" => Config::$EXECUTION_HOME_PATH . "admin/",
        "active" => true,
        "icon" => "cogs",
    ],
    [
        "name" => "Editor de templates",
        "link" => Config::$EXECUTION_HOME_PATH . "admin/layoutEditor/",
        "active" => true,
        "icon" => "edit",
    ],
];
?>

<?php ob_start()?>

<div class="m-auto bg-dark p-5 rounded">
    <form action="" method="POST" class="text-center">
        <select class="browser-default custom-select" name="templateName" id="templateName">
            <?php foreach ($viewParams["files"] as $fileGroupName => $fileGroup): ?>
            <optgroup label="<?php echo $fileGroupName ?>">
                <?php foreach ($fileGroup as $fileName): ?>
                <?php $startPos = strrpos($fileName, "\\")?>
                <?php $parsedFileName = substr($fileName, $startPos !== false ? $startPos + 1 : 0)?>
                <option value="<?php echo $fileName; ?>"><?php echo $parsedFileName; ?></option>
                <?php endforeach;?>
            </optgroup>
            <?php endforeach;?>
        </select>
        <input type="submit" class="btn btn-primary m-3" value="Cargar contenido del fichero" name="loadFileContent"
            id="loadFileContent">
    </form>
    <div id="summernote"><?php echo $viewParams["fileContent"] ?></div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once SystemPaths::SERVER_TEMPLATES_PATH . '/layout.php'?>