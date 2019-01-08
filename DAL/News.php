<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 06/12/18
 * Time: 10:38
 */

class News
{
    private $titre;
    private $categorie;
    private $date;
    private $description;
    private $link;

    public function __construct($titre,$categorie,$date_publi,$description,$link)
    {
        $this->titre=$titre;
        $this->categorie=$categorie;
        $this->date_publi=$date_publi;
        $this->description=$description;
        $this->link=$link;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @param mixed $date_publi
     */
    public function setDatePubli($date)
    {
        $this->date = $date;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }
}