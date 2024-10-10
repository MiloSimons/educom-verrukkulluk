<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once("lib/keukenType.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$usr = new user($db->getConnection());
$kt = new keukenType($db->getConnection());


/// VERWERK 
$artikelEight = $art->getArtikel(8);
$pieter = $usr->getUser(1);
$keukenType1 = $kt->getKeukenType(1);

/// RETURN
var_dump($artikelEight);
var_dump($pieter);
var_dump($keukenType1);