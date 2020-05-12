<?php
$header = [
    /* "Origen" => [
    "link" => "/daw/",
    "active" => $title == "Home",
    "icon" => "home",
    "access" => 0,
    ], */
    "Perfil" => [
        "link" => "/daw/profile/",
        "active" => $currentPage == "Perfil",
        "icon" => "user",
        "access" => 0,
    ],
    "Proyectos" => [
        "link" => "/daw/projects/",
        "active" => $currentPage == "Proyectos",
        "icon" => "folder",
        "access" => 0,
    ],
    "Acerca de" => [
        "link" => "/daw/about/",
        "active" => $currentPage == "About",
        "icon" => "info",
        "access" => 0,
    ],
    "Admin" => [
        "link" => "/daw/admin/",
        "active" => $currentPage == "Admin",
        "icon" => "cogs",
        "access" => Config::$ACCESS_LEVEL_ADMIN,
    ],
]
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light flex-wrap" style="transition: all 0.2s ease-in-out 0s;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08"
        aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation"
        style="transition: all 0.2s ease-in-out 0s;">
        <span class="navbar-toggler-icon" style="transition: all 0.2s ease-in-out 0s;"></span>
    </button>

    <a href="/daw/profile/">
        <img class="navbar-brand rounded-circle mr-2" width="45"
            src="/daw/img/users/<?php echo $username; ?>/<?php echo $username; ?>.png">
        <small class="text-muted"><span class="font-weight-bold"><?php echo $username ?></span>
            <br>
            <?php echo $sessions->getSession("roleName"); ?>
        </small>
    </a>
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08"
        style="transition: all 0.2s ease-in-out 0s;">
        <ul class="navbar-nav" style="transition: all 0.2s ease-in-out 0s;">
            <li class="nav-item " style="transition: all 0.2s ease-in-out 0s;">
                <a class="nav-link btn btn-sm h6 btn-primary shadow-none text-capitalize text-white" href="/daw/"
                    style="transition: all 0.2s ease-in-out 0s;">
                    <span><i class="fa fa-home"></i></span>
                    Origen</a>
            </li>
            <?php $access = Sessions::getInstance()->getSession("access");?>
            <?php foreach ($header as $headerTitle => $headerParams): ?>
            <?php if ($access >= $headerParams["access"]): ?>
            <li class="nav-item d-flex <?php echo $headerParams["active"] ? "active" : "" ?>"
                style="transition: all 0.2s ease-in-out 0s;">
                <a class="nav-link col-sm align-self-center selected" href="<?php echo $headerParams["link"]; ?>"
                    style="transition: all 0.2s ease-in-out 0s;">
                    <span><i class="fa fa-<?php echo $headerParams["icon"]; ?>"></i></span>
                    <?php echo $headerTitle; ?>
                    <?php if ($headerParams["active"]): ?>
                    <span class="sr-only" style="transition: all 0.2s ease-in-out 0s;">(current)</span>
                    <?php endif;?>
                </a>
            </li>
            <?php endif;?>
            <?php endforeach;?>
            <li class="nav-item " style="transition: all 0.2s ease-in-out 0s;">
                <a class="nav-link btn btn-sm h6 btn-danger shadow-none text-capitalize text-white" href="/daw/signout/"
                    style="transition: all 0.2s ease-in-out 0s;">
                    <span><i class="fa fa-sign-out"></i></span>
                    Cerrar
                    sesión</a>
            </li>
        </ul>
    </div>
</nav>