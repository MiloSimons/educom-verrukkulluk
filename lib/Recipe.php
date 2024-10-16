<?php
require_once("lib/User.php");
require_once("lib/Ingredient.php");
require_once("lib/KitchenType.php");
require_once("lib/RecipeInfo.php");

class Recipe {

    private $connection;
    private $usr;
    private $ing;
    private $recInfo;
    private $kitcType;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->usr      = new User($this->connection);
        $this->ing      = new Ingredient($this->connection);
        $this->recInfo  = new RecipeInfo($this->connection);
        $this->kitcType = new KitchenType($this->connection);

    }
  
    public function getRecipe($recipe_ids) {
        foreach((array)$recipe_ids as $recipe_id) {
            $sql = "select * from gerecht where id = $recipe_id"; //while row loop
            
            $result = mysqli_query($this->connection, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $user        = $this->selectUser($row["user_id"]);
            $ingredients = $this->selectIngredient($row["id"]);
            $recipeInfo  = $this->selectRecipeInfo($row["id"]);
            $kitchen     = $this->selectKitchenOrType($row["keuken_id"]); //or make two seperate functions selectkitchen and selecttype
            $type        = $this->selectKitchenOrType($row["type_id"]);
            $favorites   = $this->determineFavorite($recipeInfo);
            $ratings     = $this->selectRating($recipeInfo);
            $remarks     = $this->selectRemarks($recipeInfo);
            $steps       = $this->selectSteps($recipeInfo);
            $price       = $this->calcPrice($ingredients);
            $calories    = $this->calcCalories($ingredients);
            $stars       = $this->calcAVGRating($ratings);

            $recipe[]= ["recipe"=>$row,
                        "user"=>$user,
                        "ingredients"=>$ingredients,
                        "kitchen"=>$kitchen,
                        "type"=>$type,
                        "favorites"=>$favorites,
                        "ratings"=>$ratings,
                        "remarks"=>$remarks,
                        "steps"=>$steps,
                        "price"=>$price,
                        "calories"=>$calories,
                        "stars"=>$stars];        
        }
        return $recipe;

    }

    //make everything private after testing!
    private function selectUser($user_id) {
        $user = $this->usr->getUser($user_id);
        return $user;
    }

    private function selectIngredient($recipe_id) {
        $ingredient = $this->ing->getIngredients($recipe_id);
        return $ingredient;
    }
    
    private function selectRecipeInfo($recipe_id) {
        $recipeInfo = $this->recInfo->getRecipeInfo($recipe_id);
        return $recipeInfo;
    }

    private function selectKitchenOrType($kitchenOrType_id) {
        $kitchenType = $this->kitcType->getKitchenType($kitchenOrType_id);
        $kitchenOrType = $kitchenType["omschrijving"];
        return $kitchenOrType;
    }

    // OR MAKE TWO SEPARTE FUNCTIONS, 1 LIKE BELOW AND 1 WHERE TYPE = KITCHEN?
    /*private function selectType($type_id) {
        $kitchenType = $this->keukType->getKeukenType($type_id);
        $type = $kitchenType["omschrijving"];
        return $type;
    }*/
    
    
    
    private function selectRating($allRecipeInfo) {
        $ratings = [];
        foreach ($allRecipeInfo as $recipeInfo) {
            foreach($recipeInfo as $r){
                if($r["record_type"]=="W") {
                    $ratings[] = $r;
                }
            }    
        }
        return $ratings;
    }
    
    //SORT BASED ON NUMMERIEKVELD? --> e.g., step 1, step 2, etc.
    private function selectSteps($allRecipeInfo) {
        $steps = [];
        foreach ($allRecipeInfo as $recipeInfo) {
            foreach($recipeInfo as $r) {
                if($r["record_type"]=="B") {
                    $steps[] = $r;
                }
            }    
        }
        return $steps;
    }

    
    private function selectRemarks($allRecipeInfo) {
        $remarks = [];
        foreach ($allRecipeInfo as $recipeInfo) {
            foreach($recipeInfo as $o) {
                if($o["record_type"]=="O"){
                    $remarks[] = $recipeInfo;
                }                
            }                    
        }
        return $remarks;
    }    
    
    //WHAT DOES THIS FUNCTION NEED TO DO EXACTLY?
    private function determineFavorite($allRecipeInfo) {
        $favorites = [];
        foreach ($allRecipeInfo as $recipeInfo) {
            foreach($recipeInfo as $f) {
                if($f["record_type"]=="F"){
                    $favorites[] = $recipeInfo;
                }                
            }                  
        }
        return $favorites;
    }

    private function calcCalories($ingredients) {
        $calories = 0;
        foreach ($ingredients as $ingrAndArti) {
            foreach ($ingrAndArti as $i) {
                $needed = floatval($i["aantal"]);
                $package = floatval($i["verpakking"]);
                $packageCalories = floatval($i["calorieen"]);                            
            }
            $ingrCalories = ($packageCalories/$package)*$needed;
            $calories += $ingrCalories;
        }        
        return $calories;
    }  

    private function calcPrice($ingredients) {
        $price = 0;
        foreach ($ingredients as $ingrAndArti) {
            foreach ($ingrAndArti as $i) {
                $needed = floatval($i["aantal"]);
                $package = floatval($i["verpakking"]);
                $packagePrice = floatval($i["prijs"]);                       
            }
            //calculate price per ingredient, always round up
            $ingrPrice = ceil($needed/$package)*$packagePrice;
            $price += $ingrPrice;
        }      
        return $price;
    }

    private function calcAVGRating($ratings) {
        $ratingTotal = 0;
        $count = 0;
        foreach ($ratings as $rating) {
            $ratingTotal += floatval($rating["nummeriekveld"]);
            $count++;
        }
        $ratingAVG = $ratingTotal/$count;
        return $ratingAVG;
    }

}
