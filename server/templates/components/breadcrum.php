<section class="w-100 breadcrumbContainer" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0 rounded-0">
        <?php foreach ($breadcrumb as $elem): ?>
        <li class="breadcrumb-item">
            <a class="<?php echo $elem["active"] ? "" : "text-muted"; ?>" href="<?php echo $elem["link"]; ?>">
                <span><i class="fa fa-<?php echo $elem["icon"]; ?>"></i></span>
                <span class="text-overflow-ellipsis d-none d-sm-block max-text-10"><?php echo $elem["name"]; ?></span>
            </a>
        </li>
        <?php endforeach;?>
    </ol>
</section>