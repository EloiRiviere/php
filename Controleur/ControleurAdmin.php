<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 29/11/18
 * Time: 09:06
 */

class ControleurAdmin{
    private $MVisiteur;

function __construct() {
	global $rep,$vues; // nécessaire pour utiliser variables globales
// on démarre ou reprend la session si necessaire (préférez utiliser un modèle pour gérer vos session ou cookies)
//session_start();


//debut

//on initialise un tableau d'erreur
$dVueEreur = array ();

try{
    $action=$_REQUEST['action'];
    $this->MVisiteur= new ModeleVisiteur();

    switch($action) {

        //pas d'action, on r�initialise 1er appel
        case NULL:
            $this->afficherNews();
            break;
        case "ajouter":
            $this->ajouter();
            break;
        case "supprimer":
            $this->supprimer();
            break;
        case "listerSites":
            $this->listerSites();
            break;
        case "deconnexion":
            $this->deconnexion();
            break;

        //mauvaise action
        default:
        $dVueEreur[] =	"Erreur d'appel php";
        require ($rep.$vues['erreur']);
        break;
    }

}
catch (PDOException $e)
    {
        //si erreur BD, pas le cas ici
        $dVueEreur[] =	"Erreur inattendue!!! ";
        require ($rep.$vues['erreur']);
    }
    catch (Exception $e2)
	{
	    $dVueEreur[] =	"Erreur inattendue!!! ";
	    require ($rep.$vues['erreur']);
	}


//fin
exit(0);
}//fin constructeur

    function afficherNews()
    {
        global $rep,$vues;

        if(isset($_COOKIE['nbNews'])) {
            $nb = Validation::validInt($_COOKIE['nbNews']);
            if ($nb == false) {
                $dVueEreur[] = "Erreur cookie invalide ";
            }
        }
        else{
            $nb=5;
        }

        if(isset($_GET['page']))
        {
            $page =$_GET['page'];
        }
        else
        {
            $page = 1;
        }

        $m=new ModeleVisiteur();
        $tabNews=$m->getNews($page,$nb);
        Validation::validInt($tabNews); ///////////////////
        require($rep.$vues['pageprincipale']);
    }

private function ajouter()
{
    if(isset($_REQUEST['titre']) && isset($_REQUEST['categ']) && isset($_REQUEST['date']) && isset($_REQUEST['desc']) && isset($_REQUEST['lien']))
    {
        $result=$this->MVisiteur->Ajouter($_REQUEST['titre'],$_REQUEST['categ'],$_REQUEST['date'],$_REQUEST['desc'],$_REQUEST['lien']);
        if($result==null)
        {
            $dVueEreur[] =	"Erreur inattendue!!! ";
        }
        else{
            $_REQUEST = array();
            $_REQUEST['action'] = null;
            new ControleurVisiteur();
        }
    }
    else
        $dVueEreur[] =	"Erreur inattendue!!! ";
}

private function supprimer()
{
    if(isset($_REQUEST['titre']))
    {
        $result=$this->MVisiteur->Supprimer($_REQUEST['titre']);
        echo($result[0][1]);
        if($result==null)
        {
            $dVueEreur[] =	"Erreur inattendue!!! ";
        }
        else{
            $_REQUEST = array();
            $_REQUEST['action'] = null;
            new ControleurVisiteur();
        }
    }
    else{
        $dVueEreur[] =	"Erreur inattendue!!! ";
    }
}

private function deconnexion()
{
    if(isset($_SESSION['login']) && isset($_SESSION['role']))
    {
        ModeleAdmin::deconnexion();
        $_REQUEST=array();
        $_REQUEST['action']=null;
        new ControleurVisiteur();
    }
    else{
        $dVueEreur[] =	"Visiteur pas connecté";
    }
}

/*
function Reinit() {
global $rep,$vues; // nécessaire pour utiliser variables globales

$dVue = array (
	'nom' => "",
	'age' => 0,
	);
	require ($rep.$vues['vuephp1']);
}

function ValidationFormulaire(array $dVueEreur) {
global $rep,$vues;


//si exception, ca remonte !!!
$nom=$_POST['txtNom']; // txtNom = nom du champ texte dans le formulaire
$age=$_POST['txtAge'];
Validation::val_form($nom,$age,$dVueEreur);

$model = new Simplemodel();
$data=$model->get_data();

$dVue = array (
	'nom' => $nom,
	'age' => $age,
        'data' => $data,
	);
	require ($rep.$vues['vuephp1']);
}
*/
}//fin class

?>
