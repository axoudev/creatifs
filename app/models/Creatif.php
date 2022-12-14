<?php
namespace App\Models;
class Creatif extends \Core\Classes\Model{
    private $pseudo, $bio, $image;

    //-------------------------------
    // GETTERS
    //-------------------------------
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

    /**
     * Retourne le nombre de projets liés au créatif
     *
     * @return integer
     */
    public function getNbProjects(): int
    {
        return \App\Models\Repositories\CreatifsRepository::findNbProjects($this->id);
    }

    //-------------------------------
    // SETTERS
    //-------------------------------

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