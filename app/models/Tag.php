<?php
namespace App\Models;

class Tag extends \Core\Classes\Model{
    private $nom;


    //-------------------------------
    // GETTERS
    //-------------------------------

    /**
     * Retourne le nom du tag
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->nom;
    }


    //-------------------------------
    // SETTERS
    //-------------------------------

    /**
     * Modifie le nom du tag
     *
     * @param integer|null $data
     * @return void
     */
    public function setName(int $data = null)
    {
        if ($data) :
            $this->name = $data;
        endif;
    }
}
?>