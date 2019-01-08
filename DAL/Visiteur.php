<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 05/12/18
 * Time: 21:58
 */

class Visiteur
{
    private $login;
    private $password;
    private $mail;
    private $role;

    public function __construct($login,$password,$mail,$role)
    {
        $this->login=$login;
        $this->password=$password;
        $this->mail=$mail;
        $this->role=$role;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }
}