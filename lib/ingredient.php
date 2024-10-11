<?php
//require_once("lib/database.php");
require_once("lib/artikel.php");

class ingredient {

    private $connection;
    private $db;
    private $art;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->db = new database();
        $this->art = new artikel($this->db->getConnection());
    }     

    public function getIngredients($gerecht_id) {
        
        $sql = "select * from ingredient where gerecht_id = $gerecht_id";
        
        $result = mysqli_query($this->connection, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo"<pre>";
            $artikel = $this->selectArtikel($row["artikel_id"]);
            $ingredients[]=[$row, $artikel];
        }

        return $ingredients;

    }

    private function selectArtikel($artikel_id) {
        $artikel = $this->art->getArtikel($artikel_id);
        return $artikel;
    }

}