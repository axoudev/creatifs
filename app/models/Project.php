<?php

namespace App\Models;

class Project implements ClassTemplate{
    private $id, $titre, $texte, $dateCreation, $image, $creatif;

    //-------------------------------
    // GETTERS
    //-------------------------------

    /**
     * Retourne l'id du projet
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * Retourne le titre du projet
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->titre;
    }
    /**
     * Retourne la description du projet
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->texte;
    }
    /**
     * Retourne la date de création du projet
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->dateCreation;
    }
    /**
     * Retourne l'image du projet
     *
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }
    /**
     * Retourne l'id du créatif à l'origine du projet
     *
     * @return string
     */
    public function getCreatif(): string
    {
        return $this->creatif;
    }


    //-------------------------------
    // SETTERS
    //-------------------------------

    /**
     * Modifie l'id du projet
     *
     * @param integer|null $data
     * @return void
     */
    public function setId(int $data = null)
    {
        if ($data) :
            $this->id = $data;
        endif;
    }

    /**
     * Modifie le titre du projet
     *
     * @param integer|null $data
     * @return void
     */
    public function setTitle(int $data = null)
    {
        if ($data) :
            $this->titre = $data;
        endif;
    }

    /**
     * Modifie la déscription du projet
     *
     * @param integer|null $data
     * @return void
     */
    public function setText(int $data = null)
    {
        if ($data) :
            $this->texte = $data;
        endif;
    }

    /**
     * Modifie la date de création du projet
     *
     * @param integer|null $data
     * @return void
     */
    public function setCreatedAt(int $data = null)
    {
        if ($data) :
            $this->dateCreation = $data;
        endif;
    }

    /**
     * Modifie l'image du projet
     *
     * @param integer|null $data
     * @return void
     */
    public function setImage(int $data = null)
    {
        if ($data) :
            $this->image = $data;
        endif;
    }

    /**
     * Modifie le créatif à l'origine du projet
     *
     * @param integer|null $data
     * @return void
     */
    public function setCreatif(int $data = null)
    {
        if ($data) :
            $this->creatif = $data;
        endif;
    }
}
?>