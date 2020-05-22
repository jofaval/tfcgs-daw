<div class="card">
    <!-- <img class="card-img-top"
<<<<<<< HEAD
        src="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/projects/<?php /* echo $viewParams["id"]; */?>/dashboards/<?php /* echo $assignedTask["dashboard_title"]; */?>/bg.png"
=======
        src=<?php echo Config::$EXECUTION_HOME_PATH; ?>"img/projects/<?php /* echo $viewParams["id"]; */?>/dashboards/<?php /* echo $assignedTask["dashboard_title"]; */?>/bg.png"
>>>>>>> 3581ba16a411ff959f27583d19bf9007ad75c058
        alt="Card image cap" height="50"> -->
    <div class="card-body">
        <div class="assignedByContainer text-dark float-right">
            Asignado por&nbsp;<a
<<<<<<< HEAD
                href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/<?php echo $assginedByUsername ?>"
                class=""><?php echo $assginedByUsername; ?></a>&nbsp;a&nbsp;<a
                href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/<?php echo $assginedtoUsername ?>"
=======
                href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"profile/<?php echo $assginedByUsername ?>"
                class=""><?php echo $assginedByUsername; ?></a>&nbsp;a&nbsp;<a
                href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"profile/<?php echo $assginedtoUsername ?>"
>>>>>>> 3581ba16a411ff959f27583d19bf9007ad75c058
                class=""><?php echo $assginedtoUsername; ?></a>
        </div>

        <h4 class="card-title max-width-20 text-dark">
<<<<<<< HEAD
            <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>projects/id/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $assignedTask["dashboard_title"]; ?>/"
=======
            <a href=<?php echo Config::$EXECUTION_HOME_PATH; ?>"projects/id/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $assignedTask["dashboard_title"]; ?>/"
>>>>>>> 3581ba16a411ff959f27583d19bf9007ad75c058
                class="btn btn-primary btn-sm max-width-20">Ir al
                tablero</a>
            <a><?php echo $assignedTask["title"]; ?></a></h4>
        <p class="card-text">Del <span
                class="startDate font-weight-bold"><?php echo $assignedTask["start_date"]; ?></span>
            al <span class="endDate font-weight-bold"><?php echo $assignedTask["end_date"]; ?></span>
        </p>

    </div>
</div>