<?php

namespace App\Models\Repositories;

use \PDO, \Core\Classes\App;
use PDOException;

abstract class TagsRepository
{
    /**
     * Trouve tout les tags correspondants à un post
     *
     * @param integer $postId id du post pour lequel on veut trouver les tags
     * @param string $message
     * @return Tag[] $obj Tableau d'objets Tag
     */
    public static function findAllByPost(int $postId, &$message = 'TagsRepository->findAllByPost: ')
    {
        try{
            $sql = "SELECT t.* 
                    FROM tags t
                    JOIN projets_has_tags pht on t.id = pht.tag
                    JOIN projets p on p.id = pht.projet
                    WHERE p.id = :postId;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":postId", $postId, PDO::PARAM_INT);
            $rs->execute();
            $rs->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Tag');
            $obj = $rs->fetchAll();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $obj;
    }
}