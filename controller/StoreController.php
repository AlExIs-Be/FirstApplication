<?php

require "controller/AbstractController.php";
require "model/ProductManager.php";
require "model/UserManager.php";

class StoreController extends AbstractController{

    public function index(){
        $pmanager = new ProductManager();
        $products = $pmanager->findAll();
        $umanager = new UserManager();
        $users = $umanager->findAll();
        return $this->render("store/home.php", [
            "products" => $products,
            "users" => $users
        ]);
    }

    public function product($id){
        $manager = new ProductManager();
        $product = $manager->findOneById($id);
        if(!$product) return false;
        return $this->render("store/product.php", [
            "product" => $product
        ]);

    }
}