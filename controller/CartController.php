<?php
require "controller/AbstractController.php";
require "model/ProductManager.php";

class CartController extends AbstractController{

    public function recap(){
        $products = Session::get("products");
        return $this->render("store/recap.php", [
            "products" => $products
        ]);

    }
    public function addProd($id){
        $products = Session::get("products");
        if(!$products[$id]){
            $manager = new ProductManager();
            $product = $manager->findOneById($id);
            $product["qtt"] = 1;
            $products[$id] = $product;
        }else{
            $products[$id]["qtt"]++;
        }
        Session::add("products", $products);
        $name = $products[$id]["name"];
        $this->addFlash("success", "$name a bien été ajouté au panier");
        return $this->redirect("index.php");
    }
    public function emptyAll(){
        Session::remove("products");
        $this->addFlash("success", "Votre panier a bien été supprimé.");
        $this->render("store/recap.php");
    }
    public function suppr($id){
        $products = Session::get("products");
        if($products[$id]){
            $name = $products[$id]["name"];
            $this->addFlash("success", "$name a bien été supprimé");
            unset($products[$id]);
        }else $this->addFlash("failure", "Le produit n'existe pas");
        Session::add("products", $products);
        return $this->render("store/recap.php", [
            "products" => $products
        ]);
    }
    public function qttminus($id){
        $products = Session::get("products");
        $qtt = $products[$id]["qtt"]--;
        if($qtt < 1 ){
            unset($products[$id]);
        }
        Session::add("products", $products);
        return $this->render("store/recap.php", [
            "products" => $products
        ]);
    }
    public function qttplus($id){
        $products = Session::get("products");
        $products[$id]["qtt"]++;
        Session::add("products", $products);
        return $this->render("store/recap.php", [
            "products" => $products
        ]);
    }
    
  
}