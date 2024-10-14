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
        $this->db = new Database();
        $this->usr = new User($this->db->getConnection());
        $this->ing = new Ingredient($this->db->getConnection());
        $this->gerInfo = new GerechtInfo($this->db->getConnection());
        $this->keukType = new KeukenType($this->db->getConnection());

    }
  
    public function getGerecht($gerecht_id) {

        $sql = "select * from gerecht where id = $gerecht_id";
        
        $result = mysqli_query($this->connection, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo"<pre>";
            $user = $this->selectUser($row["user_id"]);
            $ingredient = $this->selectIngredient($row["id"]);
            $gerecht[]=[$row, $user, $ingredient];
        }

        return $gerecht;

    }

    //RENAME ALL SELECTS TO GET? (IN ALL CLASSES)
    private function selectUser($user_id) {
        $user = $this->usr->getUser($user_id);
        return $user;
    }

    private function selectIngredient($gerecht_id) {
        $ingredient = $this->ing->getIngredients($gerecht_id);
        return $ingredient;
    }

    //Make these public or add this info to the constructor?
    private function calcCalories($gerecht_id) {
        // ? we dont have calorie info, base it on what?
        return $calories;
    }

    //Make private again?
    public function calcPrice($gerecht_id) {
        $ingredients = $this->selectIngredient($gerecht_id);
        $price = 0;

        foreach ($ingredients as $ingrAndArti) {
            foreach ($ingrAndArti as $i) {
                // Get aantal from ingredient:
                if (count($i) == 4) {
                    $needed = floatval($i["aantal"]);
                }
                // Get verpakking and prijs from artikel:
                if (count($i) == 6) {
                    $package = floatval($i["verpakking"]);
                    $packagePrice = floatval($i["prijs"]);
                }            
            }

            //calculate price per ingredient, always round up
            $ingrPrice = ceil($needed/$package)*$packagePrice;
            $price = $price + $ingrPrice;
        }        
        return round($price, 2);
    }

    /*
    private function selectRating() {
        return $rating;
    }

    private function selectSteps() {
        return $steps;
    }

    private function selectRemarks() {
        return $remarks;
    }

    private function selectKitchen() {
        return $kitchen
    }

    private function selectType() {
        return $type;
    }

    private function determineFavorite() {
        return $favorites;
    }
    
    */

}
