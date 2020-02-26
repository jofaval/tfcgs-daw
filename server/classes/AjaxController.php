<?php

class AjaxController
{
    public function genericAjaxReturn($functionName, $requiredParams = [])
    {
        try {
            if (!empty($requiredParams)) {
                $this->throwIfExceptionIfDoesntExist($requiredParams);
            }
            $mainController = "Controller";
            if (method_exists($mainController, $functionName)) {
                $result = call_user_func([new $mainController, $functionName]);

                echo json_encode($result);
            } else {
                $this->returnError();
            }
        } catch (Throwable $th) {
            if (Config::$developmentMode) {
                $this->returnError($th->getMessage());
            } else {
                $this->returnError();
            }
        }
    }

    public function throwIfExceptionIfDoesntExist($elems)
    {
        foreach ($elems as $elem) {
            if (!isset($_REQUEST[$elem])) {
                throw new Error("$elem doesn't exist");
            }
        }
    }

    public function returnError($message = "")
    {
        $object = [
            "error" => true,
        ];
        if ($message != "") {
            $object["message"] = $message;
        }
        $json = json_encode($object);
        echo $json;
        exit;
    }

    public function getEventsFromMonth()
    {
        $this->genericAjaxReturn(__FUNCTION__, ["month", "year"]);
    }
}