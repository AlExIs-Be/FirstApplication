<?php
    function countProducts():int{
        $nb=0;
        if(isset($_SESSION["products"])){
            foreach($_SESSION["products"] as $index => $product){
                $nb += $product["qtt"];
            }
        }
        return $nb;
    }

    function message(){
        if(isset($_SESSION["message"])){
            foreach($_SESSION["message"] as $value => $notif){
                echo "<p class='$value'>".ucfirst($notif)."</p>";
            }
        }
        unset($_SESSION["message"]);
    }
?>