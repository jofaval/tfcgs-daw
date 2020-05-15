<section class="w-100 breadcrumbContainer" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0 rounded-0">
        <?php foreach ($breadcrumb as $elem): ?>
        <li class="breadcrumb-item">
            <a class="<?php echo $elem["active"] ? "" : "text-muted"; ?>" href="<?php echo $elem["link"]; ?>">
                <span class="d-sm-none"><i class="fa fa-lg fa-<?php echo $elem["icon"]; ?>"></i></span>
                <span class="d-none d-sm-inline"><i class="fa fa-<?php echo $elem["icon"]; ?>"></i></span>
                <span class="text-overflow-ellipsis d-none d-sm-inline max-text-10"><?php echo $elem["name"]; ?></span>
            </a>
        </li>
        <?php endforeach;?>
    </ol>
</section>