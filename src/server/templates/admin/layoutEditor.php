<!--Page configuration-->
<?php $optionalCSS = ["summernote-bs4.min.css"];?>
<?php $optionalScripts = ["libs/summernote-bs4.min.js", "js/admin/layoutEditor.js"];?>
<?php $title = "Editor de layouts";?>
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
        "name" => "Editor de layouts",
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
            <?php foreach ($viewParams["files"] as $file): ?>
            <option value=""><?php echo substr($file, strpos($file, "templates") + strlen("templates") + 1); ?></option>
            <?php endforeach;?>
        </select>
        <input type="submit" class="btn btn-primary m-3" value="Cargar contenido del fichero" name="loadFileContent"
            id="loadFileContent">
    </form>
    <div id="summernote"></div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>