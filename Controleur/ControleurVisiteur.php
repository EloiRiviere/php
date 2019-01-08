<?php

class ControleurVisiteur {

function __construct() {
	global $rep,$vues; // nécessaire pour utiliser variables globales
// on démarre ou reprend la session si necessaire (préférez utiliser un modèle pour gérer vos session ou cookies)
//session_start();


//debut

//on initialise un tableau d'erreur
$dVueEreur = array ();


try{
	if(isset($_REQUEST['action']))
	{
		$action=$_REQUEST['action'];
	}
    else
	{
		$action= NULL;
	}

    switch($action)
    {
    //pas d'action, on r�initialise 1er appel
        case NULL:
	        $this->afficherNews();
	        break;

        case "connection":
            $this->Connection();
            break;

        case "connectionSuperAdmin":
            $this->ConnectionSuperAdmin();
            break;

        case "setCookie":
            $this->setCookie();
            break;

        //mauvaise action
        default:
            $dVueEreur[] =	"Erreur d'appel php";
            require ($rep.$vues['pageprincipale']);
            break;
    }

}
catch (PDOException $e)
{
	//si erreur BD, pas le cas ici
	$dVueEreur[] =	"Erreur inattendue!!! ";
	echo("Erreur PDO");
	echo $e->getMessage();
	require ($rep.$vues['erreur']);

}
catch (Exception $e2)
{
    echo("Erreur 2eme catch");
    $dVueEreur[] =	"Erreur inattendue!!! ";
	require ($rep.$vues['erreur']);
}

catch (Error $e3)
{
	echo $e3->getMessage();
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

function findSpecificPage()
{
    global $rep,$vues;

    if(isset($_GET['page']))
    {
        $page =$_GET['page'];
    }
    else
    {
        $page = 1;
    }
    //$page = $_GET['page'];
    $m=new ModeleVisiteur();
    $tabNews=$m->getNews($page);
    require($rep.$vues['pageprincipale']);
}

public function Connection()
{
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        $admin = new ModeleAdmin();
        $result = $admin->connexion($_REQUEST['login'], $_REQUEST['password']);

        if ($result == false) {
            $dVueEreur[] =	"Erreur inattendue!!! ";
        }
        else {
            $_REQUEST = array();
            $_REQUEST['action'] = null;
            new ControleurAdmin();
        }
    }
    else {
        $dVueEreur[] =	"Erreur inattendue!!! ";
    }
}

public function ConnectionSuperAdmin()
{
    if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
        $admin = new ModeleSuperAdmin();
        $result = $admin->connexion($_REQUEST['login'], $_REQUEST['password']);

        if ($result == false) {
            $dVueEreur[] =	"Erreur inattendue!!! ";
        }
        else {
            $_REQUEST = array();
            $_REQUEST['action'] = null;
            new ControleurSuperAdmin();

        }

    }
    else {
        $dVueEreur[] =	"Erreur inattendue!!! ";
    }
}

public function setCookie()
{
    if(isset($_REQUEST['nbNews']))
    {
        setCookie("nbNews",Validation::validInt($_REQUEST['nbNews']),time()+24*3600);

        $_REQUEST=array();
        $_REQUEST['action']=null;
        new ControleurVisiteur();
    }
    else{
        $dVueEreur[] =	"Erreur inattendue!!! ";
    }
}


}//fin class

?>