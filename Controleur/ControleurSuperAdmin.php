<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 03/01/19
 * Time: 23:39
 */

class ControleurSuperAdmin extends ControleurAdmin
{
    private $MVisiteur;

    public function __construct()
    {
        global $rep,$vues;
        $dVueEreur = array ();

        try {
            $action = $_REQUEST['action'];
            $this->MVisiteur= new ModeleVisiteur();

            switch ($action)
            {
                case NULL;
                    $this->afficherNews();
                    break;

                case "deconnexion1":
                    $this->deconnexionSA();
                    break;

                case "updateMDP":
                    $this->updateMDP();
                    break;

                case "addAdmin":
                    $this->addAdmin();
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
            $dVueEreur[] =	"Erreur inattendue!!! ";
            require ($rep.$vues['erreur']);
        }
        catch (Exception $e2)
        {
            $dVueEreur[] =	"Erreur inattendue!!! ";
            require ($rep.$vues['erreur']);
        }
        exit(0);
    }

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

    private function deconnexionSA()
    {
        global $rep,$vues;
        if(isset($_SESSION['login']) && isset($_SESSION['role']))
        {
            ModeleSuperAdmin::deconnexion1();
            $_REQUEST=array();
            $_REQUEST['action']=null;
            new ControleurVisiteur();
        }
        else{
            $dVueEreur[] =	"Visiteur pas connecté";
            require ($rep.$vues['erreur']);
        }
    }

    private function updateMDP()
    {
        echo("coucou"); ////////////////////////////////////
        echo("coucou"); ////////////////////////////////////

        global $rep,$vues;
        if(isset($_REQUEST['login']) && isset($_REQUEST['oldPassword']) && isset($_REQUEST['newPassword']))
        {
           $this->MVisiteur->updatePassword($_REQUEST['login'],$_REQUEST['oldPassword'],$_REQUEST['newPassword']);
           $_REQUEST=array();
           $_REQUEST['action']=null;
           new ControleurSuperAdmin();
        }
        else{
            $dVueEreur[] =	"Modification password échoué";
            require ($rep.$vues['erreur']);
        }
    }

    private function addAdmin()
    {
        global $rep,$vues;
        if(isset($_REQUEST['login']) && isset($_REQUEST['password']) && isset($_REQUEST['mail']))
        {
            $this->MVisiteur->ajouterAdmin($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['mail']);
            $_REQUEST=array();
            $_REQUEST['action']=null;
            new ControleurVisiteur();
        }
        else{
            $dVueEreur[] =	"Ajout Admin échoué" ;
            require ($rep.$vues['erreur']);
        }
    }

}