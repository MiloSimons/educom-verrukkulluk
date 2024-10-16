<?php

require_once("lib/Database.php");
require_once("lib/Article.php");
require_once("lib/User.php");
require_once("lib/KitchenType.php");
require_once("lib/Ingredient.php");
require_once("lib/RecipeInfo.php");
require_once("lib/Recipe.php");

/// INIT
$db  = new Database();
$art = new Article($db->getConnection());
$usr = new User($db->getConnection());
$kt  = new KitchenType($db->getConnection());
$ig  = new Ingredient($db->getConnection());
$recInf = new RecipeInfo($db->getConnection());
$rec = new Recipe($db->getConnection());



/// VERWERK 
$articleEight = $art->getArticle(8);
$pieter = $usr->getUser(1);
//$keukenType1 = $kt->getKeukenType(1);

//$ingr = $ig->getIngredients(3); //3 is gerecht_id

$rec3info = $recInf->getRecipeInfo(3);

$rec1info = $recInf->getRecipeInfo(1);
//var_dump($ger1info);
$recInf->addFavorite(1, 1);
//$gerInf->deleteFavorite(1, 1);
$rec1info = $recInf->getRecipeInfo(1);
//var_dump($ger1info);
$recipe2 = $rec->getRecipe(2);
$allRecipes = $rec->getRecipe();
//$recipes1and2 = $rec->getRecipe([1,2]);
//$ingGer2 = $ger->selectIngredient(2);
//$gerInf2 = $ger->selectGerechtInfo(2);
//var_dump($gerInf2);

//make methods public in gerecht class for testing
//$testPriceMethod = $ger->calcCalories($ingGer2);
//$testSteps = $ger->selectSteps($gerInf2);
//$testRemarks = $ger->selectRemarks($gerInf2);
//$testRating = $ger->selectRating($gerInf2);
//$ratingAVG = $ger->calcAVGRating($testRating);
//$testFavo = $ger->determineFavorite($gerInf2);


//$art_id = $ig->getArtikel_id($ingr["id"]);
//$artikel2 = $art->getArtikel($art_id);

//$art3 = $ig->getArtikel($ingr["id"]);

/// RETURN
//var_dump($artikelEight);
//var_dump($pieter);
//var_dump($keukenType1);
//var_dump($ingr);
//var_dump($art_id);
//var_dump($art3);

//var_dump($ingr);
//var_dump($ger3info);
//var_dump($gerecht2);
//var_dump($ingGer2);
//var_dump($testPriceMethod);
//var_dump($testSteps);
//var_dump($testRemarks);
//var_dump($testRating);
//var_dump($ratingAVG);
//var_dump($testFavo);

var_dump($recipe2);
var_dump($allRecipes);