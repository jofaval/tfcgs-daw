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

            <?php $userAccessLevel = $viewParams["projectAccessLevel"];?>

            <?php foreach ($actionGroups as $actionGroupTitle => $actionGroupDetails): if ($userAccessLevel < $actionGroupDetails["access"]): continue;endif;?>
            <div class="actionsGroup my-3">
                <h4 class="actionsTitle text-white"><?php echo $actionGroupTitle; ?></h4>
                <div class="actionsButton px-auto px-sm-0 d-flex justify-content-space-between flex-wrap">
                    <?php $actionGroup = $actionGroupDetails["actions"];?>
                    <?php foreach ($actionGroup as $action): ?>
                    <?php if ($userAccessLevel >= $action["access"]): ?>
                    <?php include __DIR__ . "/../components/cards/actionCard.php";?>
                    <?php endif;?>
                    <?php endforeach;?>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <div class="col-sm p-0 mx-0 mb-3 mx-sm-3">
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