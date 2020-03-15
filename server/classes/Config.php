<?php

class Config
{
    public static $mvc_bd_hostname = "localhost";
    public static $mvc_bd_nombre = "database";
    public static $mvc_bd_usuario = "test";
    public static $mvc_bd_clave = "";
    public static $mvc_img_exts = ["image/png", "image/jpg", "image/jpeg", "image/gif"];
    public static $mvc_vis_css = [
        "bootstrap.min.css",
        "jquery-ui.min.css",
        "mdb.min.css",
        "main.css",
        "loader.css",
        "floating-label.css",
        "inputs.css",
        "jquery.sweet-modal.min.css",
        "gantt.css",
    ];
    public static $mvc_vis_scripts = [
        "libs/jquery.min.js",
        "libs/jquery-ui.min.js",
        "libs/bootstrap.min.js",
        "libs/bootstrap.bundle.min.js",
        "libs/mdb.min.js",
        "libs/jquery.sweet-modal.min.js",
        "js/Modal.js",
        "js/utils.js",
        "js/inputs.js",
        "js/AjaxController.js",
        "js/Validator.js",
        "js/FormValidator.js",
        "js/preloader.js",
    ];
    public static $emailSender = "contact@sender.org";
    public static $emailMsgLineLength = 70;
    public static $ACCESS_LEVEL_GUEST = 0;
    public static $ACCESS_LEVEL_NOT_ACTIVATED = 1;
    public static $ACCESS_LEVEL_TEACHER = 2;
    public static $ACCESS_LEVEL_ADMIN = 3;
    public static $notsigned_ctls = [
        "signin",
        "signup",
        "notsigned",
        "error",
        "access",
    ];
    public static $notuseragent_ctls = [
        "notuseragent",
    ];
    public static $developmentMode = 1;
}