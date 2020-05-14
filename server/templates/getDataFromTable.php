<!--Page configuration-->
<?php $optionalCSS = ["datatables.min.css"];?>
<?php $optionalScripts = ["libs/datatables.min.js", "js/getDataTable.js"];?>
<?php $title = "Example";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "/daw/",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Example",
        "link" => "/daw/example/",
        "active" => true,
        "icon" => "home",
    ],
];
?>

<?php ob_start()?>

<div class="m-auto bg-white p-5 rounded">
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
                <?php foreach ($viewParams["columns"] as $column): ?>
                <th class="th-sm"><?php echo $column; ?></th>
                <?php endforeach;?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($viewParams["results"] as $row): ?>
            <tr>
                <?php foreach ($viewParams["columns"] as $column): ?>
                <td class="td-sm"><?php echo $row[$column]; ?></td>
                <?php endforeach;?>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>