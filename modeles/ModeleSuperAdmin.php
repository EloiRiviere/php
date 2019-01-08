<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 03/01/19
 * Time: 21:23
 */

class ModeleSuperAdmin
{
    private $con;
    private $Visiteur;

    public function __construct()
    {
        global $dsn, $login, $mdp;
        $this->con=new Connection($dsn,$login, $mdp);
        $this->Visiteur=new VisiteurGateway($this->con);
    }

    public function connexion($login,$password)
    {
        $login=Validation::validString($login);
        $password=Validation::validString($password);
        $b = $this->Visiteur->checkSuperAdmin($login,$password);
        if($b==false)
        {
            return null;
        }
        else {
            $_SESSION['role'] = 'superAdmin';
            $_SESSION['login'] = 'login';
            return new Visiteur($login, $password, null, 'superAdmin');
        }
    }

    public static function deconnexion1()
    {
        session_unset();
        session_destroy();
        $_SESSION=array();
    }

    public static function isSuperAdmin()
    {
        if(isset($_SESSION['login']) && isset($_SESSION['role']) && $_SESSION['role']=='superAdmin')
        {
            $login=Validation::validString($_SESSION['login']);
            $role=Validation::validString($_SESSION['role']);
            return new Visiteur($login,null,null,$role);
        }
        else
        {
            return null;
        }
    }
}