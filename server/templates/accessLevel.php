<!--Page configuration-->
<?php $optionalCSS = ["message.css"];?>
<?php $optionalScripts = [];?>
<?php $title = "Access Level control";?>
<?php $mainClasses = "";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php $breadcrumb = [
    [
        "name" => "Go back to admin panel",
        "link" => "/daw/admin/",
        "active" => false,
    ],
];?>

<?php ob_start()?>

<form action="/daw/index.php" method="POST" class="bg-white rounded shadow p-5">
    <h2>New route</h2>
    <input type="hidden" name="ctl" value="accessLevel">
    <div class="md-form">
        <input type="text" class="form-control" placeholder="" name="newRoute" id="newRoute" />
        <label for="newRoute">New route</label>
        <button type="submit" name="add" class="btn btn-primary w-100 mx-auto" value="Add">Add</button>
    </div>
    <br />
    <h2>Change access</h2>
    <div class="form-row">
        <label for="route" class="col">Routes</label>
        <label for="access" class="col">Access Levels</label>
    </div>
    <div class="form-row">
        <div class="md-form col">
            <select name="route" class="browser-default custom-select">
                <?php foreach ($viewParams["routes"] as $route): ?>
                <option value="<?php echo $route; ?>"><?php echo $route; ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <p>&nbsp;</p>
        <div class="md-form col">
            <select name="access" class="browser-default custom-select">
                <?php foreach ($viewParams["accessLevels"] as $key => $value): ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <button type="submit" name="change" class="btn btn-primary w-100 mx-auto" value="Change">Change</button>
    </div>
</form>
<?php $contenido = ob_get_clean()?>
<?php include_once 'layout.php'?>