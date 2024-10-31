<?php
require_once("lib/User.php");

class RecipeInfo {

    private $connection;
    private $usr;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->usr = new User($this->connection);
    }     

    public function getRecipeInfo($recipe_id) {
        
        $sql = "select * from gerecht_info where gerecht_id = $recipe_id";
        
        $result = mysqli_query($this->connection, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // Add user info for favorites and comments
            if($row["record_type"]== "F" || $row["record_type"]== "O") {
                $user = $this->selectUser($row["user_id"]);
                $row += ["user_name"=>$user["user_name"],
                         "password"=>$user["password"],
                         "email"=>$user["email"],
                         "afbeelding"=>$user["afbeelding"],];
                $recipe_info[]=["recipeInfo"=>$row];
            } else {
            $recipe_info[] = ["recipeInfo"=>$row];
            }
        }
        return $recipe_info;
    }

    private function selectUser($user_id) {
        $user = $this->usr->getUser($user_id);
        return $user;
    }

    //private?
    public function addFavorite($recipe_id, $user_id) { //of moet je hier een user meegeven ipv een user_id? and what about date?
        // Only add favorite if it does not exists already for that recipe + user combo        
        $sql = "select * from gerecht_info where gerecht_id = $recipe_id and user_id = $user_id and record_type = 'F'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        if($row == NULL) {
        
            $sql2 = "INSERT INTO gerecht_info (id, record_type, gerecht_id, user_id, datum, nummeriekveld, tekstveld)
                     values (NULL, 'F', $recipe_id, $user_id, '', NULL, NULL)";

            $result2 = mysqli_query($this->connection, $sql2);  
        }      
    }

    public function deleteFavorite($recipe_id, $user_id) {
        $sql = "DELETE FROM gerecht_info WHERE gerecht_id = $recipe_id and user_id = $user_id and record_type = 'F'";
        
        $result = mysqli_query($this->connection, $sql);
    }

    public function addRating($recipe_id, $rating) {        
        $sql = "INSERT INTO gerecht_info (id, record_type, gerecht_id, user_id, datum, nummeriekveld, tekstveld)
                values (NULL, 'W', $recipe_id, NULL, '', $rating, NULL)";
        $result = mysqli_query($this->connection, $sql);             
    }
}