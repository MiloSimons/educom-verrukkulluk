<?php
//require_once("lib/database.php");
require_once("lib/User.php");

class GerechtInfo {

    private $connection;
    private $db;
    private $usr;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->db = new Database();
        $this->usr = new User($this->db->getConnection());
    }     

    public function getGerechtInfo($gerecht_id) {
        
        $sql = "select * from gerecht_info where gerecht_id = $gerecht_id";
        
        $result = mysqli_query($this->connection, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo"<pre>";
            // Add user info for favorites and comments
            if($row["record_type"]== "F" || $row["record_type"]== "O") {
                $user = $this->selectUser($row["user_id"]);
                $gerecht_info[]=["RecipeInfo"=>$row, "User"=>$user];
            } else {
            $gerecht_info[]=$row;
            }
        }

        return $gerecht_info;
    }

    private function selectUser($user_id) {
        $user = $this->usr->getUser($user_id);
        return $user;
    }

    //private?
    public function addFavorite($gerecht_id, $user_id) { //of moet je hier een user meegeven ipv een user_id? and what about date?
        // Only add favorite if it does not exists already for that recipe + user combo        
        $sql = "select * from gerecht_info where gerecht_id = $gerecht_id and user_id = $user_id and record_type = 'F'";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //var_dump($row);
        if($row == NULL) {
        
            $sql2 = "INSERT INTO gerecht_info (id, record_type, gerecht_id, user_id, datum, nummeriekveld, tekstveld) values (NULL, 'F', $gerecht_id, $user_id, '', NULL, NULL)";

            $result2 = mysqli_query($this->connection, $sql2);  
        }      
    }

    public function deleteFavorite($gerecht_id, $user_id) {
        $sql = "DELETE FROM gerecht_info WHERE gerecht_id = $gerecht_id and user_id = $user_id and record_type = 'F'";
        
        $result = mysqli_query($this->connection, $sql);
    }

}