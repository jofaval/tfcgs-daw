<div class="card m-2">
    <div class="card-body p-2">
        <p class="card-title max-width-20 p mb-0 text-dark">
            <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $recentlyCreated["dashboard_title"]; ?>/"
                class="btn btn-primary btn-sm max-width-20">Ir al
                tablero</a>
            <a><?php echo $recentlyCreated["title"]; ?></a>
            Creado el <span
                class="creationDate font-weight-bold"><?php echo $recentlyCreated["creation_date"]; ?></span>
            Creado por&nbsp;<a href="/daw/profile/<?php echo $recentlyCreated["username"] ?>"
                class=""><?php echo $recentlyCreated["username"]; ?>
        </p>


    </div>
</div>