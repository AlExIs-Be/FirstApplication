<?php

require "model/ProductManager.php";
require "controller/AbstractController.php";

class AdminController extends AbstractController{

    public function index(){
        if(!$this->isGranted("ROLE_ADMIN")) return false;
        $manager = new ProductManager();
        $products = $manager->findAll();
        return $this->render("admin/home.php",[
            "products" => $products
        ]);
    }

    public function newProduct(){
        if(!$this->isGranted("ROLE_ADMIN")) return false;

        if(Form::isSubmitted()){
    
            $name = Form::getData("name", "text");
            $desc = Form::getData("desc", "text");
            $img = Form::getData("img", "text");
            $price = Form::getData("price", "float", FILTER_VALIDATE_FLOAT);

            if($name && $desc && $price && $img){
                $manager = new ProductManager();
                if($id = $manager->insertProduct($name, $desc, $price, $img)){
                    $this->addFlash("success", "$name ajouté avec succès à la boutique");
                    return $this->redirect("?ctrl=store&action=product&id=$id");
                }
                else $this->addFlash("error", "Erreur de BDD !!");
            }
            else $this->addFlash("error", "Veuillez vérifier les données du formulaire");

            return $this->redirect("?ctrl=admin");
        }
        else return false;
    }
    public function updateProd($id){
        
    }
}