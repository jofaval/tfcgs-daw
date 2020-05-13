<a href="<?php echo $action["link"]; ?>" title="<?php /* echo $action["name"]; */?>"
    class="action d-none d-sm-block view overlay zoom cursor-pointer z-depth-1-half hoverable <?php echo $action["color"]; ?> m-2"
    id="action<?php echo $action["id"]; ?>">
    <div class="actionIcon img-fluid waves-light h-100 center-elements text-white p-3">
        <i class="fa fa-<?php echo $action["icon"]; ?>"></i>
    </div>
    <div
        class="actionTitle mask flex-center p-2 .z-depth-1 text-center d-flex justify-content-center text-white bg-dark">
        <p class="align-self-center white-text fixed-line-spacing mb-0">
            <?php echo $action["name"]; ?></p>
    </div>
</a>
<a href="<?php echo $action["link"]; ?>" title="<?php /* echo $action["name"]; */?>"
    class="action d-sm-none w-100 cursor-pointer px-0 shadow-none hoverable <?php echo $action["color"]; ?> m-2"
    id="action<?php echo $action["id"]; ?>">
    <div class="actionIcon img-fluid h-75 waves-light center-elements text-white p-3">
        <i class="fa fa-<?php echo $action["icon"]; ?>"></i>
    </div>
    <div class="actionTitle h-25 w-100 .z-depth-1 text-center d-flex justify-content-center py-2 text-white bg-dark">
        <p class="align-self-center white-text fixed-line-spacing mb-0">
            <?php echo $action["name"]; ?></p>
    </div>
</a>