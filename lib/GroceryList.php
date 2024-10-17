<?php
require_once("lib/User.php");
require_once("lib/Ingredient.php");

class GroceryList {
    
    private $connection;
    private $usr;
    private $ing;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->usr = new User($this->connection);
        $this->ing = new Ingredient($this->connection);
    }

    public function getGroceryList($user_id) {
        $groceryList=NULL; // in case a user has no grocery list
        $sql = "select * from boodschappenlijst where user_id = $user_id";

        $result = mysqli_query($this->connection, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $groceryList[] = $row;
        }

        return $groceryList;
    }

    public function addToGroceryList($recipe_id, $user_id) {
        $ingredients = $this->ing->getIngredients($recipe_id);

        foreach($ingredients as $ingrAndArt) {
            foreach($ingrAndArt as $article){
                $article_id = $article["artikel_id"];
                if ($this->articleOnList($user_id, $article_id) == false) {
                    // ADD NEW ARTICLE
                    $amount = $this->calcAmountNeeded($article);
                    $price = $this->calcPrice($article, $amount);                    

                    $sql = "INSERT INTO boodschappenlijst (id, user_id, artikel_id, aantal, prijs)
                            values (NULL, $user_id, $article_id, $amount, $price)";
                    $result = mysqli_query($this->connection, $sql);
                } else { 
                    // UPDATE ARTICLE
                    $oldArticleOnList = $this->articleOnList($user_id, $article_id);
                    $old_amount = $oldArticleOnList["aantal"];
                    $new_amount = $old_amount + $this->calcAmountNeeded($article);
                    $new_price = $this->calcPrice($article, $new_amount);
                    
                    $sql = "UPDATE boodschappenlijst
                            SET aantal = $new_amount, prijs = $new_price
                            WHERE user_id = $user_id and artikel_id = $article_id";
                    $result = mysqli_query($this->connection, $sql);
                }                
            }    
        }        
    }
    
    public function calcTotalPriceGroceryList($user_id) {
        $totalPrice = 0;
        $groceryList = $this->getGroceryList($user_id);
        if ($groceryList != NULL){    
            foreach($groceryList as $article) {
                $totalPrice += $article["prijs"];
            }
        }    
        return $totalPrice;
    }
    
    //calculate amount of articles needed (unrounded)
    private function calcAmountNeeded($ingredient) {
        $amount = floatval($ingredient["aantal"]);
        $package = floatval($ingredient["verpakking"]);
        $needed = $amount/$package;
        return $needed;
    }

    //calculate price for rounded amount of articles needed
    private function calcPrice($ingredient, $amountNeeded) {
        $needed = ceil(floatval($amountNeeded));      
        $articlePrice = floatval($ingredient["prijs"]);
        $price = $needed*$articlePrice;        
        return $price;
    }
   
    private function articleOnList($user_id, $article_id) {
        $articleOnList = false;
        $groceryList = $this->getGroceryList($user_id);        
        if ($groceryList != NULL){
            foreach ($groceryList as $artOnList) {
                if ($artOnList["artikel_id"] == $article_id) {
                    $articleOnList = $artOnList;
                }
            }
        }
        //returns false or article details       
        return $articleOnList;
    }
}