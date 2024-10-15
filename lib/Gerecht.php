<?php
require_once("lib/User.php");
require_once("lib/Ingredient.php");
require_once("lib/KeukenType.php");
require_once("lib/GerechtInfo.php");

class Gerecht {

    private $connection;
    private $usr;
    private $ing;
    private $gerInfo;
    private $keukType;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->db       = new Database();
        $this->usr      = new User($this->db->getConnection());
        $this->ing      = new Ingredient($this->db->getConnection());
        $this->gerInfo  = new GerechtInfo($this->db->getConnection());
        $this->keukType = new KeukenType($this->db->getConnection());

    }
  
    public function getGerecht($gerecht_id) {

        // in myAdmin, beschrijving langer maken!!!!!!!!!!!!

        $sql = "select * from gerecht where id = $gerecht_id";
        
        $result = mysqli_query($this->connection, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { //Dont need the loop right?
            echo"<pre>";
            $user        = $this->selectUser($row["user_id"]);
            $ingredient  = $this->selectIngredient($row["id"]);
            $gerechtInfo = $this->selectGerechtInfo($row["id"]);
            $keuken      = $this->selectKitchenOrType($row["keuken_id"]); //or make two seperate functions selectkitchen and selecttype
            $type        = $this->selectKitchenOrType($row["type_id"]);

            $gerecht[]=[$row, $user, $ingredient];
            //$price = $this->calcPrice($ingredient);
            //$calories = $this->calcCalories
            //$rating = $this->selectRating
            //$bereidingswijze/stappen = $this->selectSteps($gerechtInfo)
            //$favorieten = $this->determineFavorite
            //$avgRating = $this->calcRating($ratings);
        }

        return $gerecht;

    }

    //make everything private after testing!
    private function selectUser($user_id) {
        $user = $this->usr->getUser($user_id);
        return $user;
    }

    public function selectIngredient($gerecht_id) {
        $ingredient = $this->ing->getIngredients($gerecht_id);
        return $ingredient;
    }
    
    public function selectGerechtInfo($gerecht_id) {
        $gerechtInfo = $this->gerInfo->getGerechtInfo($gerecht_id);
        return $gerechtInfo;
    }

    private function selectKitchenOrType($keukenOrType_id) {
        $kitchenType = $this->keukType->getKeukenType($keukenOrType_id);
        $kitchenOrType = $kitchenType["omschrijving"];
        return $kitchenOrType;
    }

    // OR MAKE TWO SEPARTE FUNCTIONS, 1 LIKE BELOW AND 1 WHERE TYPE = KITCHEN?
    /*private function selectType($type_id) {
        $kitchenType = $this->keukType->getKeukenType($type_id);
        $type = $kitchenType["omschrijving"];
        return $type;
    }*/
    
    
    
    public function selectRating($gerechtInfo) {
        $ratings = [];
        foreach ($gerechtInfo as $g) {
            if(count($g) == 7 and $g["record_type"]=="W") {
                $ratings[] = $g;//[$g["datum"], $g["nummeriekveld"]]; //Is datum hier nodig?
            }
        }
        //calculate rating!
        return $ratings;
    }
    
    
    private function selectSteps($gerechtInfo) {
        $steps = [];
        foreach ($gerechtInfo as $g) {
            if(count($g) == 7 and $g["record_type"]=="B") {
                $steps[] = $g;//[$g["datum"], $g["nummeriekveld"], $g["tekstveld"]]; // is datum nodig hier?
            }
        }
        return $steps;
    }

    
    private function selectRemarks($gerechtInfo) {
        $remarks = [];
        foreach ($gerechtInfo as $g) {
            if(count($g) == 2){
                foreach($g as $o) {
                    if(count($o)==7 and $o["record_type"]=="O"){
                        $remarks[] = $g; //voegt ook user toe, is dit nodig of alleen user id? anders $g[0]!
                    }                
                }                    
            }
        }
        return $remarks;
    }

    
    /*
    private function determineFavorite() {
        return $favorites;
    }
    
    */

    private function calcCalories($ingredients) {
        $calories = 0;

        foreach ($ingredients as $ingrAndArti) {
            foreach ($ingrAndArti as $i) {
                // Get aantal from ingredient:
                if (count($i) == 4) {
                    $needed = floatval($i["aantal"]);
                }
                // Get verpakking and calorieen from artikel:
                if (count($i) == 7) {
                    $package = floatval($i["verpakking"]);
                    $packageCalories = floatval($i["calorieen"]);
                }            
            }

            //calculate price per ingredient, always round up
            $ingrCalories = ($packageCalories/$package)*$needed;
            $calories += $ingrCalories;
        }        
        return round($calories, 2);
    }  

    private function calcPrice($ingredients) {
        $price = 0;

        foreach ($ingredients as $ingrAndArti) {
            foreach ($ingrAndArti as $i) {
                // Get aantal from ingredient:
                if (count($i) == 4) {
                    $needed = floatval($i["aantal"]);
                }
                // Get verpakking and prijs from artikel:
                if (count($i) == 7) {
                    $package = floatval($i["verpakking"]);
                    $packagePrice = floatval($i["prijs"]);
                }            
            }

            //calculate price per ingredient, always round up
            $ingrPrice = ceil($needed/$package)*$packagePrice;
            $price += $ingrPrice;
        }        
        return round($price, 2); //round not needed?
    }

    public function calcAVGRating($ratings) {
        $ratingTotal = 0;
        $count = 0;
        foreach ($ratings as $rating) {
            $ratingTotal += floatval($rating["nummeriekveld"]);
            $count++;
        }
        $ratingAVG = $ratingTotal/$count;
        return round($ratingAVG, 0); //round not needed?
    }

}
