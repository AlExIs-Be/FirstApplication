<?php
require "service/Session.php";
require "service/Form.php";

abstract class Router{
    const NOT_FOUND = VIEW_PATH."404.php";
    const FORBIDDEN = VIEW_PATH."403.php";

    public static function handleRequest(){

        $ctrl = filter_input(INPUT_GET, "ctrl", FILTER_SANITIZE_STRING) ?? DEFAULT_CTRL;
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING) ?? DEFAULT_METHOD;
        $id =  filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT) ?? NULL;

        $ctrlName = ucfirst($ctrl)."Controller";
        $ctrlFile = "controller/".$ctrlName.".php";

        if(file_exists($ctrlFile)){
            include($ctrlFile);
            $controller = new $ctrlName();

            if(method_exists($controller, $action)){
                return $controller->$action($id);
            }
        }
        return FALSE;
    }
}