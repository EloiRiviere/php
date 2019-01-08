<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 20/12/18
 * Time: 08:07
 */

class FrontControleur
{
    private $listeAction_Admin=array('supprimer','ajouter','deconnexion');
    private $listeAction_SuperAdmin=array('ajouterAdmin','supprimerAdmin','modifierAdmin','deconnexion1','afficherNews');

    public function __construct()
    {
        global $rep,$vues;

        try
        {
            if(isset($_REQUEST['action']))
            {
                $action=Validation::validString($_REQUEST['action']);
            }
            else
            {
                $action = null;
            }

            if(in_array($action,$this->listeAction_Admin))
            {
                if(ModeleAdmin::isAdmin()!=null)
                {
                    new ControleurAdmin();
                }
                else
                {
                    require_once($rep.$vues['vueConnection']);
                }
            }
            if(in_array($action,$this->listeAction_SuperAdmin))
            {

                if(ModeleSuperAdmin::isSuperAdmin()!=null)
                {
                    new ControleurSuperAdmin();
                }
                else
                {
                    require_once($rep.$vues['vueConnection']);
                }
            }
            else
            {
                new ControleurVisiteur();
            }
        }

        catch (Exception $e)
        {
            $dVueEreur[] =	"Erreur FrontControleur ";
            require ($rep.$vues['erreur']);
        }
    }
}