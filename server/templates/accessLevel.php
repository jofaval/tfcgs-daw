<!--Page configuration-->
<?php $optionalCSS = ["message.css"];?>
<?php $optionalScripts = [];?>
<?php $title = "Access Level control";?>
<?php $mainClasses = "";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php $currentPage = "Admin";?>
<?php $breadcrumb = [
    [
        "name" => "Home",
        "link" => "/daw/",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Admin",
        "link" => "/daw/admin/",
        "active" => false,
        "icon" => "cogs",
    ],
    [
        "name" => "Acceso",
        "link" => "/daw/admin/access-level/",
        "active" => true,
        "icon" => "key",
    ],
];?>

<?php ob_start()?>

<form action="/daw/index.php?ctl=accessLevel" method="POST" class="bg-white rounded shadow p-5">
    <h2>Nueva ruta</h2>
    <div class="md-form">
        <input type="text" class="form-control" placeholder="" name="newRoute" id="newRoute" />
        <label for="newRoute">Nueva ruta</label>
        <button type="submit" name="add" class="btn btn-primary w-100 mx-auto" value="Add">Añadir</button>
    </div>
    <br />
    <h2>Cambiar nivel de acceso</h2>
    <div class="form-row">
        <label for="route" class="col">Rutas</label>
        <label for="access" class="col">Niveles de acceso</label>
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
        <button type="submit" name="change" class="btn btn-primary w-100 mx-auto" value="Change">Cambiar</button>
    </div>
</form>
<?php $contenido = ob_get_clean()?>
<?php include_once 'layout.php'?>