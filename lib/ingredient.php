<?php
//require_once("lib/database.php");
require_once("lib/Article.php");

class Ingredient {

    private $connection;
    private $art;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->art = new Article($this->connection);
    }     

    public function getIngredients($recipe_id) {
        // make one array out of it, appending every ingredient with all artikel info exc/ id.
        $sql = "select * from ingredient where gerecht_id = $recipe_id";
        
        $result = mysqli_query($this->connection, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo"<pre>";
            $article = $this->selectArticle($row["artikel_id"]);
            $ingredients[]=["Ingredient"=>$row, "Article"=>$article];
        }

        return $ingredients;

    }

    private function selectArticle($article_id) {
        $article = $this->art->getArticle($article_id);
        return $article;
    }

}