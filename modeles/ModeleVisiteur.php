<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 06/12/18
 * Time: 08:39
 */

class ModeleVisiteur
{
    private $news;
    private $visiteur;

    public function __construct()
    {
        global $dsn,$login,$mdp;
        $this->con=new Connection($dsn,$login,$mdp);
        $this->news=new NewsGateway($this->con);
        $this->visiteur=new VisiteurGateway($this->con);
    }

    public function getNews($page,$nbNews):array
    {
        global $dsn, $login, $mdp;
        $page=Validation::validPage($page);
        if($page==false)
            return null;

        $g=new NewsGateway(new Connection($dsn,$login, $mdp));

        return $g->findNewsByPage($page,$nbNews);
    }

    public function getNumberOfNews():int
    {
         global $dsn, $login, $mdp;
         $g=new NewsGateway(new Connection($dsn,$login, $mdp));
         return $g->nbNewsTotal();
    }

    public function Ajouter($titre,$categ,$date,$desc,$lien)
    {
        $titre=Validation::validString($titre);
        $categ=Validation::validString($categ);
        $date=Validation::validString($date);
        $desc=Validation::validString($desc);
        $lien=Validation::validUrl($lien);

        if(!$titre or !$categ or !$date or !$desc or !$lien)
            return null;

        $this->news->ajouterNews($titre,$categ,$date,$desc,$lien);
        return true;
    }

    public function Supprimer($titre)
    {
        $titre=Validation::validString($titre);
        if(!$titre)
            return null;

        $this->news->supprimerNews($titre);
        return true;
    }

    public function updatePassword($login,$oldPassword,$newPassword)
    {
        $login=Validation::validString($login);
        $oldPassword=Validation::validString($oldPassword);
        $newPassword=Validation::validString($newPassword);
        echo("coucou"); ////////////////////////////////////

        $check=$this->visiteur->checkUser($login,$oldPassword);
        if($check!=true)
        {
            echo("coucou"); ////////////////////////////////////

            echo("Admin pas dans la base");
            return false;
        }
        else{
            echo("coucou"); ////////////////////////////////////
            $this->visiteur->updateMDPUser($login,$newPassword);
        }
    }

    public function ajouterAdmin($login,$password,$mail)
    {
        $login=Validation::validString($login);
        $password=Validation::validString($password);
        $mail=Validation::isEmail($mail);

        $this->visiteur->ajoutUtil($login,$password,$mail);
        return true;
    }
}
