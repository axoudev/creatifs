<?php
namespace Core\Classes;
abstract class Model
{
    protected $id;

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
     * Modifie l'id du créatif
     *
     * @param integer|null $data
     * @return void
     */
    public function setId(int $data = null){
        if ($data) :
            $this->id = $data;
        endif;
    }
}
?>