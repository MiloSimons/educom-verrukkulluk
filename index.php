<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukenType.php");
require_once("lib/ingredient.php");

/// INIT
$db = new Database();
$art = new Artikel($db->getConnection());
$usr = new User($db->getConnection());
$kt = new KeukenType($db->getConnection());
$ig = new Ingredient($db->getConnection());


/// VERWERK 
$artikelEight = $art->getArtikel(8);
$pieter = $usr->getUser(1);
$keukenType1 = $kt->getKeukenType(1);

$ingr = $ig->getIngredients(3); //3 is gerecht_id

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
var_dump($ingr);