<?php

class Config
{
    public static $mvc_bd_hostname = "localhost";
    public static $mvc_bd_nombre = "origen";
    public static $mvc_bd_usuario = "test";
    public static $mvc_bd_clave = "";
    public static $mvc_img_exts = ["image/png", "image/jpg", "image/jpeg", "image/gif"];
    public static $mvc_vis_css = [];
    public static $mvc_vis_scripts = [];
    public static $banned_usernames = [];
    public static $emailSender = "contact@sender.org";
    public static $emailMsgLineLength = 70;
    public static $ACCESS_LEVEL_GUEST = 0;
    public static $ACCESS_LEVEL_NOT_ACTIVATED = -1;
    public static $ACCESS_LEVEL_USER = 2;
    public static $ACCESS_LEVEL_ADMIN = 3;
    public static $notsigned_ctls = [
        "signin",
        "signup",
        "notsigned",
        "404",
        "error",
        "access",
    ];
    public static $notuseragent_ctls = [
        "notuseragent",
        "signin",
        "signup",
        "notsigned",
        "404",
        "error",
        "access",
    ];
    public static $dont_need_db_ctls = [
        "404",
        "about",
        "maintenance",
        "error",
    ];
    public static $projectElements = [
        "tasks",
        "diary",
    ];
    public static $developmentMode = 1;
    public static $allowConsoleOutput = 1;
    public static $allowExternalResources = 1;
    public static $inactivityTime = 15 * 60;
}