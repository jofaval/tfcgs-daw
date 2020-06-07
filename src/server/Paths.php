<?php

class SystemPaths
{
    const CLIENT_PATH = __DIR__ . "/../client";
    const CLIENT_IMG_PATH = SystemPaths::CLIENT_PATH . "/img";
    const CLIENT_SCRIPTS_PATH = SystemPaths::CLIENT_PATH . "/scripts";
    const CLIENT_JS_PATH = SystemPaths::CLIENT_SCRIPTS_PATH . "/js";
    const CLIENT_LIBS_PATH = SystemPaths::CLIENT_SCRIPTS_PATH . "/libs";
    const CLIENT_WEBCOMPONENTS_PATH = SystemPaths::CLIENT_SCRIPTS_PATH . "/webcomponents";
    const CLIENT_STYLES_PATH = SystemPaths::CLIENT_PATH . "/styles";

    const SERVER_PATH = __DIR__ . "/../server";
    const SERVER_CLASSES_PATH = SystemPaths::SERVER_PATH . "/classes";
    const SERVER_CONFIG_PATH = SystemPaths::SERVER_CLASSES_PATH . "/config";
    const SERVER_CONTROLLERS_PATH = SystemPaths::SERVER_CLASSES_PATH . "/controllers";
    const SERVER_ONE_EXECUTION_PATH = SystemPaths::SERVER_CLASSES_PATH . "/one_execution";
    const SERVER_POPOS_PATH = SystemPaths::SERVER_CLASSES_PATH . "/POPOs";
    const SERVER_LIBS_PATH = SystemPaths::SERVER_PATH . "/libs";
    const SERVER_LOGS_PATH = SystemPaths::SERVER_PATH . "/logs";
    const SERVER_TEMPLATES_PATH = SystemPaths::SERVER_PATH . "/templates";
    const SERVER_ADMIN_PATH = SystemPaths::SERVER_TEMPLATES_PATH . "/admin";
    const SERVER_COMPONENTS_PATH = SystemPaths::SERVER_TEMPLATES_PATH . "/components";
    const SERVER_CARDS_PATH = SystemPaths::SERVER_COMPONENTS_PATH . "/cards";
    const SERVER_ERRORS_PATH = SystemPaths::SERVER_TEMPLATES_PATH . "/errors";
    const SERVER_FORMS_PATH = SystemPaths::SERVER_TEMPLATES_PATH . "/forms";
    const SERVER_PROFILE_PATH = SystemPaths::SERVER_TEMPLATES_PATH . "/profile";
    const SERVER_PROJECT_PATH = SystemPaths::SERVER_TEMPLATES_PATH . "/project";
    const SERVER_TASKS_PATH = SystemPaths::SERVER_PROJECT_PATH . "/tasks";
}