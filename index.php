<?php

require_once("lib/Database.php");
require_once("lib/Artikel.php");
require_once("lib/User.php");
require_once("lib/KeukenType.php");
require_once("lib/Ingredient.php");
require_once("lib/GerechtInfo.php");
require_once("lib/Gerecht.php");

/// INIT
$db = new Database();
$art = new Artikel($db->getConnection());
$usr = new User($db->getConnection());
$kt = new KeukenType($db->getConnection());
$ig = new Ingredient($db->getConnection());
$gerInf = new GerechtInfo($db->getConnection());
$ger = new Gerecht($db->getConnection());



/// VERWERK 
$artikelEight = $art->getArtikel(8);
$pieter = $usr->getUser(1);
//$keukenType1 = $kt->getKeukenType(1);

//$ingr = $ig->getIngredients(3); //3 is gerecht_id

$ger3info = $gerInf->getGerechtInfo(3);

$ger1info = $gerInf->getGerechtInfo(1);
//var_dump($ger1info);
$gerInf->addFavorite(1, 1);
//$gerInf->deleteFavorite(1, 1);
$ger1info = $gerInf->getGerechtInfo(1);
//var_dump($ger1info);
$gerecht2 = $ger->getGerecht(2);
$ingGer2 = $ger->selectIngredient(2);
$gerInf2 = $ger->selectGerechtInfo(2);
var_dump($gerInf2);

//make methods public in gerecht class for testing
//$testPriceMethod = $ger->calcCalories($ingGer2);
//$testSteps = $ger->selectSteps($gerInf2);
$testRemarks = $ger->selectRemarks($gerInf2);


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
var_dump($testRemarks);