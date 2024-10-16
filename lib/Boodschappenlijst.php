<?php
require_once("lib/User.php");
require_once("lib/Ingredient.php");

class Boodschappenlijst {
    
    private $connection;
    private $usr;
    private $ing;
    private $articlesList;

    public function __construct($connection) {
        $this->connection = $connection;
        //$this->db           = new Database();
        $this->usr          = new User($this->db->getConnection());
        $this->ing          = new Ingredient($this->db->getConnection());
        $this->articlesList = [];
    }

    //public function getBoodschappenlijst($user_id) {

    //}

    public function boodschappenToevoegen($gerecht_id, $user_id) {
        $ingredients = $this->ing->getIngredients($gerecht_id);
        foreach($ingredients as $ingredient) {
            if($this->ArtikelOpLijst($ingredient["Article"], $user_id)==false) {
                $this->articlesList[] = ["User ID"=>$user_id,
                                         "Article"=>$ingredient["Article"],
                                         "Amount"=>$this->amountNeeded($ingredient)]; //addprice!
            } else {
                //$this->articlesList[$user_id, $user_id] = ['',''];
            }
        }

        //no return
    }
    
    //save needed somewhere?
    private function calcAmountNeeded($ingredient) {
        $needed = 0;

        foreach ($ingredient as $article) {
            // Get aantal from ingredient:
            if (count($i) == 4) {
                $needed = floatval($i["aantal"]);
            }
            // Get verpakking from artikel:
            if (count($i) == 7) {
                $package = floatval($i["verpakking"]);
            }            
            
            //calculate amount of products needed, always round up
            $ingrNeeded = $needed/$package; //hier nog niet afronden, alles bij elkaar optellen bij het toevoegen, en op het moment dat je de info die dan relevant is nodig hebt pas afronden
            $needed += $ingrNeeded;
        }        
        return $needed;
    }

    private function ArtikelOpLijst($artikel_id, $user_id) {
        $onList = false;
        foreach ($this->articlesList as $listItem) {        
            if((($listItem["Article"]==$artikel_id) != NULL) && (($listItem["User ID"]==$user_id) != NULL)) {
                $onList = true;
            }
        }        
        return $onList;
    }

}