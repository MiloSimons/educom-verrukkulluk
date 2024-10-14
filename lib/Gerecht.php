<?php
require_once("lib/User.php");
require_once("lib/Ingredient.php");

class Gerecht {

    private $connection;
    private $usr;
    private $ing;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->db = new Database();
        $this->usr = new User($this->db->getConnection());
        $this->ing = new Ingredient($this->db->getConnection());
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

    private function selectUser($user_id) {
        $user = $this->usr->getUser($user_id);
        return $user;
    }

    private function selectIngredient($gerecht_id) {
        $ingredient = $this->ing->getIngredients($gerecht_id);
        return $ingredient;
    }


}
