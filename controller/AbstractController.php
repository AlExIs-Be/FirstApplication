<?php

abstract class AbstractController{
    /**
     * Rend une vue et les données correspondantes
     * @param string $view - le chemin de la vue (HTML) à rendre
     * @param array|null $data - le tableau des données que la vue affichera
     * @return array un tableau structuré en 2 clés $view et $data
     */
    protected function render($view, $data = null){
        return [
            "view" => VIEW_PATH.$view,
            "data" => $data
        ];
    }
    /**
     * Redirige vers une page d'url $url
     * @param string $url - url de la page vers laquelle rediriger
     */
    protected function redirect($url):void{
        header("Location:".$url);
        die;
    }

    protected function addFlash(string $type, string $msg): void{
        Session::add("message", ["type" => $type, 'msg' => $msg]);
    }

    protected function getUser(){
        return Session::get("user");
    }

    protected function isGranted($role){
        $role = $role == "ROLE_USER" ? null : $role;
        return (Session::get("user") && Session::get("user")["role"] === $role);
    }
}