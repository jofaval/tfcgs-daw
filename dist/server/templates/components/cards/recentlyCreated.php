<div class="recentlyCard text-dark row col-12 rounded px-0 col-sm m-2 bg-white">
    <div
        class="row recentlyCardDetails pl-3 flex-wrap border-bottom center-elements w-100 m-0 pt-2">

        <h5 class="recentlyCardTitle max-text-10 text-dark text-overflow-ellipsis overflow-hidden m-0 font-weight-bold">
            <?php echo $recentlyCreated["title"]; ?></h5>
        <div class="recentlyCardFlags ml-auto btn-group">
            <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $recentlyCreated["dashboard_title"]; ?>/task/id/<?php echo $recentlyCreated["id"]; ?>/"
                class="btn btn-sm btn-primary mt-auto mr-2 mb-2 recentlyCardBtnView">Ir al tablero</a>
        </div>
    </div>
    <p class="recentlyCardDescription text-dark text-overflow-ellipsis pl-3 overflow-hidden text-justify my-2">
        <span class="creationDate font-weight-bold"><?php echo $recentlyCreated["creation_date"]; ?></span>
        <!-- <br class="d-block d-sm-none"> -->
        <span class="creatorDetail">por&nbsp;<a href="/daw/profile/<?php echo $recentlyCreated["username"] ?>"
                class=""><?php echo $recentlyCreated["username"]; ?>
        </span>
    </p>
</div>