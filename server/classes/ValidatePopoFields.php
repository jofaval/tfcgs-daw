<?php

class ValidatePopoFields
{
    public function __construct()
    {

    }

    public static $validationRules = [];

    public static function validatePopoFields($fields, $arrayWithData)
    {
        $validationInstance = Validation::getInstance();
        foreach ($fields as $fieldName) {
            if (isset($arrayWithData[$fieldName])) {
                if ($validationInstance->rules([
                    [
                        "name" => $fieldName,
                        "rules" => "no-empty," . ValidatePopoFields::$validationRules[$fieldName],
                    ],
                ], $arrayWithData) !== true) {
                    throw new Error("$elem doesn't exist");
                }
            }
        }
    }
}

ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["role",
    "id_collaborator",
    "invited_by",
    "level",
    "id_client",
    "order_criteria",
    "id_dashboard_list",
    "order",
    "id",
    "id_dashboard_item",
    "assigned_by",
    "assigned_to",
    "id_project",
    "id_creator"], 'numeric'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["name",
    "surname",
    "email",
    "website",
    "dashboard_title",
    "title",
    "description",
    "comment",
    "biography",
    "content"], 'text'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["username"], 'username'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["password"], 'password'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["finished",
    "enabled"], 'password'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["starting_date",
    "start_date",
    "end_date",
    "creation_date",
    "modification_date"], 'datetime'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["day"], 'date'));