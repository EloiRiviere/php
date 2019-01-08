<?php

//si controller pas objet
//  header('Location: controller/controller.php');

//si controller objet

//chargement config
require_once(__DIR__.'/Config/config.php');
require_once(__DIR__.'/Config/Autoload.php');


//chargement autoloader pour autochargement des classes
Autoload::charger();
session_start();

$controleur = new FrontControleur();

?>
