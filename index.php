<?php
//// Allereerst zorgen dat de "Autoloader" uit vendor opgenomen wordt:
require_once("./vendor/autoload.php");

/// Twig koppelen:
$loader = new \Twig\Loader\FilesystemLoader("./templates");
/// VOOR PRODUCTIE:
/// $twig = new \Twig\Environment($loader), ["cache" => "./cache/cc"]);

/// VOOR DEVELOPMENT:
$twig = new \Twig\Environment($loader, ["debug" => true ]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

/******************************/

/// DATA RETRIEVAL

require_once("lib/Database.php");
require_once("lib/Article.php");
require_once("lib/User.php");
require_once("lib/KitchenType.php");
require_once("lib/Ingredient.php");
require_once("lib/RecipeInfo.php");
require_once("lib/Recipe.php");
require_once("lib/GroceryList.php");

/// INIT
$db  = new Database();
$articles = new Article($db->getConnection());
$users = new User($db->getConnection());
$kitchenTypes  = new KitchenType($db->getConnection());
$ingredients  = new Ingredient($db->getConnection());
$recipeInfos = new RecipeInfo($db->getConnection());
$recipes = new Recipe($db->getConnection());
$groceryLists = new GroceryList($db->getConnection());

$allRecipeData = $recipes->getRecipe();

/*
URL:
HOMEPAGE: http://localhost/index.php?&action=homepage
DETAILPAGE: http://localhost/index.php?gerecht_id= + GERECHT_ID + &action=detail
*/

$recipe_id = isset($_GET["recipe_id"]) ? $_GET["recipe_id"] : "";
$rating = isset($_GET["rating"]) ? $_GET["rating"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";


switch($action) {

    case "homepage": {
        $data = $recipes->getRecipe();
        $template = 'homepage.html.twig';
        $title = "homepage";
        break;
    }

    case "detail": {
        $data = $recipes->getRecipe($recipe_id);
        $template = 'detail.html.twig';
        $title = "detail page";
        break;
    }

    case "rating": {
        header('Content-type: application/json');
        $recipe_info = $recipeInfos->getRecipeInfo($recipe_id);
        $recipe = $recipes->getRecipe($recipe_id);

        // get current average
        foreach($recipe as $recipeInfo) {
            $AVGrating = $recipeInfo["stars"];                
        }
        
        // add new rating to database
        $recipeInfos->addRating($recipe_id, $rating);
        
        // calculate new average
        $ratings = $recipes->selectRating($recipe_info);       
        $ratingTotal = $rating;
        $count = 1;
        foreach ($ratings as $rat) {
            $ratingTotal += floatval($rat["nummeriekveld"]);
            $count++;
        }
        $ratingAVG = $ratingTotal/$count;

        $output = array("succes"=>true, "newAverage"=> $ratingAVG, "rating"=>(int)$rating);
        echo json_encode($output);
                
        die();
        break;
    }
}


/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data]);