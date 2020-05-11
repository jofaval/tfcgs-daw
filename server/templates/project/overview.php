<?php
$modelInstance = Model::getInstance();
?>

<div class="w-100 h-100 tabContent container-fluid p-0 p-sm-3 d-block" id="tabContent1">
    <div class="w-100 display-none display-sm-block p-2 text-white d-flex justify-content-start">
        <div class="collaborators mx-2">
            <span
                id="numberOfCollaborators"><?php echo $viewParams["projectNumbers"]["numberOfCollaborators"]; ?></span>
            <span class="font-weight-bold">
                <a class=""><i class="fa fa-lg fa-users"></i></a>
                <span class="d-none d-sm-inline-block">colaborador(es)</span>
            </span>
        </div>
        <div class="dashboards mx-2">
            <span id="numberOfDashboards"><?php echo $viewParams["projectNumbers"]["numberOfDashboards"]; ?></span>
            <span class="font-weight-bold">
                <a class=""><i class="fa fa-lg fa-columns"></i></a>
                <span class="d-none d-sm-inline-block">tablero(s)</span>
            </span>
        </div>
        <div class="activeTime mx-2">
            <?php echo $projectData["projectCreationDate"]; ?>
        </div>
    </div>
    <div class="row m-0 p-0">
        <div class="col-sm p-0">
            <?php $actionGroups = $viewParams["actionGroups"];?>

            <?php $userAccessLevel = Sessions::getInstance()->getSession("access");?>

            <?php foreach ($actionGroups as $actionGroupTitle => $actionGroupDetails): if ($userAccessLevel < $actionGroupDetails["access"]): continue;endif;?>
            <div class="actionsGroup my-3">
                <h4 class="actionsTitle text-white"><?php echo $actionGroupTitle; ?></h4>
                <div class="actionsButton d-flex justify-content-space-between flex-wrap">
                    <?php $actionGroup = $actionGroupDetails["actions"];foreach ($actionGroup as $action): if ($userAccessLevel >= $action["access"]): ?>
                    <a href="<?php echo $action["link"]; ?>" title="<?php echo $action["name"]; ?>"
                        class="action d-none d-sm-block view overlay zoom cursor-pointer .z-depth-1-half hoverable <?php echo $action["color"]; ?> m-2"
                        id="action<?php echo $action["id"]; ?>">
                        <div class="actionIcon img-fluid waves-light h-100 center-elements text-white p-3">
                            <i class="fa fa-<?php echo $action["icon"]; ?>"></i>
                        </div>
                        <div
                            class="actionTitle mask flex-center .z-depth-1 text-center d-flex justify-content-center text-white bg-dark">
                            <p class="align-self-center white-text fixed-line-spacing mb-0">
                                <?php echo $action["name"]; ?></p>
                        </div>
                    </a>
                    <a href="<?php echo $action["link"]; ?>" title="<?php echo $action["name"]; ?>"
                        class="action d-sm-none cursor-pointer .z-depth-1-half hoverable <?php echo $action["color"]; ?> m-2"
                        id="action<?php echo $action["id"]; ?>">
                        <div class="actionIcon img-fluid h-75 waves-light center-elements text-white p-3">
                            <i class="fa fa-<?php echo $action["icon"]; ?>"></i>
                        </div>
                        <div
                            class="actionTitle h-25 .z-depth-1 text-center d-flex justify-content-center text-white bg-dark">
                            <p class="align-self-center white-text fixed-line-spacing mb-0">
                                <?php echo $action["name"]; ?></p>
                        </div>
                    </a>
                    <?php endif;endforeach;?>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div class="col-sm p-0 mx-3 mx-sm-0">
            <div class="row text-white p-0 m-0">
                <h4 class="h4 text-white">Creado recientemente</h4>
                <div class="recentlyCreated text-dark">
                    <?php foreach ($viewParams["recentlyCreated"] as $recentlyCreated): ?>
                    <?php require __DIR__ . "/../components/cards/recentlyCreated.php"?>
                    <?php endforeach;?>
                </div>
            </div>
            <br>
            <div class="row text-white p-0 m-0">
                <h4 class="h4 text-white">Invitados recientemente</h4>
                <div class="recentlyInvited text-dark collaboratorsContainer"></div>
            </div>
        </div>
    </div>
</div>