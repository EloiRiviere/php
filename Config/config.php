<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 29/11/18
 * Time: 09:42
 */

//gen
$rep= __DIR__ .'/../';

// liste des modules à inclure

$dConfig['includes']= array('Controleur/Validation.php');
$dConfig['includes']= array('Controleur/ControleurVisiteur.php');
$dConfig['includes']= array('Controleur/ControleurAdmin.php');

//BD

$dsn="mysql:host=localhost;dbname=dbprojet";
//$login="eloi";
//$mdp="eloi";
$login="leo";
$mdp="leo";

//VUES

$vues['index']='index.php';
$vues['erreur']='Vues/erreur.php';
$vues['pageprincipale']='Vues/pageprincipale.php';
$vues['vueConnection']='Vues/vueConnection.php';

?>