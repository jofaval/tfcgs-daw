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
            if (isset($arrayWithData[$fieldName]) && isset(ValidatePopoFields::$validationRules[$fieldName])) {
                if ($validationInstance->rules([
                    [
                        "name" => $fieldName,
                        "rules" => "no-empty," . ValidatePopoFields::$validationRules[$fieldName],
                    ],
                ], $arrayWithData) !== true) {
                    throw new Error("$fieldName no es válido");
                }
            }
        }

        return true;
    }
}
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["email"], 'email'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["role",
    "id_collaborator",
    "invited_by",
    "level",
    "id_client",
    "order_criteria",
    "id_dashboard_list",
    "order",
    "id",
    "limit",
    "id_dashboard_item",
    "assigned_by",
    "assigned_to",
    "id_project",
    "id_creator"], 'numeric'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["name",
    "surname",
    "website",
    "dashboard_title",
    "title",
    "description",
    "comment",
    "biography"], 'text'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["username"], 'username'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["password"], 'password'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["finished",
    "enabled"], 'boolean'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["starting_date",
    "start_date",
    "end_date",
    "creation_date",
    "modification_date"], 'datetime'));
ValidatePopoFields::$validationRules = array_merge(ValidatePopoFields::$validationRules, array_fill_keys(["day"], 'date'));