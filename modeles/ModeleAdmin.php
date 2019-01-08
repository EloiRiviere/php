<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 27/12/18
 * Time: 21:57
 */

class ModeleAdmin
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
        $b=$this->Visiteur->checkUser($login,$password);

        if($b==false)
        {
            return null;
        }
        else{
            $_SESSION['role'] = 'admin';
            $_SESSION['login'] = 'login';
            return new Visiteur($login, $password, null, 'admin');
        }
    }

    public static function deconnexion()
    {
        session_unset();
        session_destroy();
        $_SESSION=array();
    }

    public static function isAdmin()
    {
        if(isset($_SESSION['login']) && isset($_SESSION['role']) && $_SESSION['role']=='admin')
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