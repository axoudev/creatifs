<?php
namespace App\Models;

class Tag{
    private $id, $nom;


    //-------------------------------
    // GETTERS
    //-------------------------------

    /**
     * Retourne l'id du tag
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

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
     * Modifie l'id du tag
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