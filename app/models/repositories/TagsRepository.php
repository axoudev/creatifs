<?php

namespace App\Models\Repositories;

use \PDO, \Core\Classes\App;
use PDOException;

abstract class TagsRepository
{

    public static function findAll(&$message = 'TagsRepository->findAll: ')
    {
        try{
            $sql = "SELECT *
                    FROM tags
                    ORDER BY nom;";
            $rs = App::getConnexion()->query($sql);
            $rs->execute();
            $rs->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Tag');
            $obj = $rs->fetchAll();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $obj;
    }

    /**
     * Trouve tout les tags correspondants à un post
     *
     * @param integer $postId id du post pour lequel on veut trouver les tags
     * @param string $message
     * @return Tag[] $obj Tableau d'objets Tag
     */
    public static function findAllByPost(int $projectId, &$message = 'TagsRepository->findAllByPost: ')
    {
        try{
            $sql = "SELECT t.* 
                    FROM tags t
                    JOIN projets_has_tags pht on t.id = pht.tag
                    JOIN projets p on p.id = pht.projet
                    WHERE p.id = :projectId;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":projectId", $projectId, PDO::PARAM_INT);
            $rs->execute();
            $rs->setFetchMode(PDO::FETCH_CLASS, '\App\Models\Tag');
            $obj = $rs->fetchAll();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $obj;
    }

    /**
     * Supprime les liens en entre le projets et les tags
     *
     * @param integer $projectId id du projet pour lequel on supprime les tags
     * @param string $message
     * @return void
     */
    public static function removeLinkToProject(int $projectId, &$message = 'TagsRepository->removeLinkToProject: ')
    {
        try{
            $sql = "DELETE FROM projets_has_tags
                    WHERE projet = :projetId";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":projetId", $projectId, PDO::PARAM_INT);
            $executed = $rs->execute();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $executed;
    }
    
    /**
     * Crée le lien entre un tag et un projet
     *
     * @param integer $projectId id du projet
     * @param integer $tagId id du tag
     * @param string $message
     * @return void
     */
    public static function addTagsToProject(int $projectId, int $tagId, &$message = 'TagsRepository->addTagsToProject: ')
    {
        try{
            $sql = "INSERT INTO projets_has_tags
                    SET projet = :projectId,
                    tag = :tagId;";
            $rs = App::getConnexion()->prepare($sql);
            $rs->bindValue(":projectId", $projectId, PDO::PARAM_INT);
            $rs->bindValue(":tagId", $tagId, PDO::PARAM_INT);
            $executed = $rs->execute();
        }catch(PDOException $e){
            $message .= $e->getMessage()."<br>";
        }
        
        return $executed;
    }
    
}