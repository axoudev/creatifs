<?php
namespace App\Models;

class Creatif{
    private $id, $pseudo, $bio, $image;

    //-------------------------------
    // GETTERS
    //-------------------------------

    /**
     * Retourne l'id du créatif
     *
     * @return integer 
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * retourne le pseudo du créatif
     *
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * Retourne la biographie du créatif
     *
     * @return string
     */
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * Retourne l'image du créatif
     *
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    //-------------------------------
    // SETTERS
    //-------------------------------
    
    /**
     * Modifie l'id du créatif
     *
     * @param integer|null $data
     * @return void
     */
    public function setId(int $data = null) :void
    {
        if ($data) :
            $this->id = $data;
        endif;
    }

    /**
     * Modifie le pseudo du créatif
     *
     * @param integer|null $data
     * @return void
     */
    public function setPseudo(int $data = null) :void
    {
        if ($data) :
            $this->pseudo = $data;
        endif;
    }

    /**
     * Modifie la biographie du créatif
     *
     * @param integer|null $data
     * @return void
     */
    public function setBio(int $data = null) :void
    {
        if ($data) :
            $this->bio = $data;
        endif;
    }

    /**
     * Modifie l'image du créatif
     *
     * @param integer|null $data
     * @return void
     */
    public function setImage(int $data = null) :void
    {
        if ($data) :
            $this->image = $data;
        endif;
    }
}
?>